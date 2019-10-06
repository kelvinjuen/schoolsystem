<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;
use DB;
use Gate;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
        if(Gate::allows('isAdmin')){
            abort(404,'You do not have permission to this page');
        }
    }
    public function index()
    {
        return view('pages.student');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.addstudent');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $fileNameToStore = 'noimage.jpg';
        $validator = \Validator::make($request->all(),[
            'firstname'=> 'required',
            'secondname'=> 'required',
            'surname'=> 'required',
            'dob'=> 'required',
            'grade'=> 'required',
            'niims' => 'required',
            'previous' => 'required',
            'passport' => 'image|nullable|max:1999',
        ]);

        if($validator->fails()){
            return response()->json(['errors'=>$validator->errors()]);
        }

        //handle file upload
        if($request ->hasFile('passport')){
            global $fileNameToStore;
            //get filename with the ext
            $fileNameWithExt = $request ->file('passport')->getClientOriginalName();
            //get just filename
            $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            //get just extension
            $extension = $request->file('passport')->getClientOriginalExtension();
            //Filename to store
            $fileNameToStore = $request ->get('firstname').'_'.time().'.'.$extension;
            //upload image
            $path = $request->file('passport')->storeAs('public/student_images', $fileNameToStore);
        }else{
            $fileNameToStore='noimage.jpg';
        }

        //create new student
        DB::transaction(function () {
            global $fileNameToStore;
            $id = DB::table('student')->insertGetId([
                'first_name' => request()->get('firstname'),'second_name' => request()->get('secondname'),'surname' => request()->get('surname'),
                'grade' => request()->get('grade'),'gender' => request()->get('gender'),'niims' => request()->get('niims'),'dob' => request()->get('dob'),
                'previous_school' => request()->get('previous'),'admission_no' => request()->get('admission'),'special_needs' => request()->get('special'),
                'photo' => $fileNameToStore,'updated_at' => \Carbon\Carbon::now(),'created_at' => \Carbon\Carbon::now(),
             ]);

            DB::table('parents')->insertGetId([
                'father_names' => request()->get('fathernames'),'father_contact' => request()->get('fathercontact'),'father_email' => request()->get('fatheremail'),
                'mother_names' => request()->get('mothernames'),'mother_contact' => request()->get('mothercontact'),'mother_email' => request()->get('motheremail'),
                'guardian_names' => request()->get('guardiannames'),'guardian_contact' => request()->get('guardiancontact'),'guardian_email' => request()->get('guardianemail'),
                'student_id' => $id,'updated_at' => \Carbon\Carbon::now(),'created_at' => \Carbon\Carbon::now(),
            ]);
        });
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($admission)
    {
        $date_query = DB::table('exam')->select(DB::raw('max(created_at) as max'),DB::raw('min(created_at) as min'))->first();
        $date_max = strtotime($date_query->max);
        $date_min = strtotime($date_query->min);
        $date = Date("Y",$date_max) - Date("Y",$date_min);
        $exams = array();

        for ($i=0; $i <= $date; $i++) {
            $terms = 0;
            for ($j=1; $j <= 3; $j++) {
                $term_total = 0;
                for ($k=1; $k <= 3; $k++) {
                    $exam = DB::table('exam')->where('term', $j)->where('admission_no',$admission)->where('exam_type',$k)->select('math','english','composition','swahili','insha','science','social','cre')->first();
                    if(!is_null($exam)){
                        if($k === 3){
                            $ttl =  ($exam->math + (($exam->english + $exam->composition + $exam->swahili + $exam->insha) /2)+$exam->science + $exam->social + $exam->cre)* 0.6;
                        }else{
                            $ttl =  ($exam->math + (($exam->english + $exam->composition + $exam->swahili + $exam->insha) /2)+$exam->science + $exam->social + $exam->cre)* 0.2;
                        }

                        $term_total += $ttl;
                    }

                }


                if($term_total > 0){
                    $terms++;
                    $exams[$terms] = $term_total;

                }

            }
        }

        $student = DB::table('student')->join('parents', 'student.student_id', '=', 'parents.student_id')->where('student.admission_no','=', $admission)->first();
        return response()->json(['student'=>$student,'exam'=>$exams,'total'=>$terms]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(auth()->user()->user_type !== 'admin'){
            return redirect('/')->with('error', 'unauthorised page');
        }

        return view('pages.editStudent');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $fileNameToStore = 'noimage.jpg';
        $validator = \Validator::make($request->all(),[
            'firstname'=> 'required',
            'secondname'=> 'required',
            'surname'=> 'required',
            'dob'=> 'required',
            'grade'=> 'required',
            'niims' => 'required',
            'previous' => 'required',
            'passport' => 'image|nullable|max:1999',
        ]);

        if($validator->fails()){
            return response()->json(['errors'=>$validator->errors()]);
        }

        //handle file upload
        if($request ->hasFile('passport')){

            global $fileNameToStore;
            //get filename with the ext
            $fileNameWithExt = $request ->file('passport')->getClientOriginalName();
            //get just filename
            $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            //get just extension
            $extension = $request->file('passport')->getClientOriginalExtension();
            //Filename to store
            $fileNameToStore = $request ->get('firstname').'_'.time().'.'.$extension;
            //upload image
            $path = $request->file('passport')->storeAs('public/student_images', $fileNameToStore);
        }else{

            $file = DB::table('student')->select('photo')->where('student_id',$id)->first();
            $fileNameToStore =$file->photo;

        }



        //create new student
        DB::transaction(function () use ($id,$fileNameToStore){
            DB::table('student')->where('student_id',$id)->update([
                'first_name' => request()->get('firstname'),'second_name' => request()->get('secondname'),'surname' => request()->get('surname'),
                'grade' => request()->get('grade'),'gender' => request()->get('gender'),'niims' => request()->get('niims'),'dob' => request()->get('dob'),
                'previous_school' => request()->get('previous'),'admission_no' => request()->get('admission'),'special_needs' => request()->get('special'),
                'photo' => $fileNameToStore,'updated_at' => \Carbon\Carbon::now()
             ]);

            DB::table('parents')->where('student_id',$id)->update([
                'father_names' => request()->get('fathernames'),'father_contact' => request()->get('fathercontact'),'father_email' => request()->get('fatheremail'),
                'mother_names' => request()->get('mothernames'),'mother_contact' => request()->get('mothercontact'),'mother_email' => request()->get('motheremail'),
                'guardian_names' => request()->get('guardiannames'),'guardian_contact' => request()->get('guardiancontact'),'guardian_email' => request()->get('guardianemail'),
                'updated_at' => \Carbon\Carbon::now()
            ]);
        });

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function setStudentTable($grade){
        if($grade == 0){
            $grade = 1;
        }
        $students = DB::table('student')->select('student_id','admission_no','photo',DB::raw('CONCAT(student.first_name," ",student.surname )as name'),'niims','special_needs','attendance')->where('grade',$grade)->get();
        foreach ($students as &$value) {
            if($value->attendance == 0){
                $value->attendance = 'present';
            }else{
                $value->attendance = 'absent';
            }
        }
        return response()->json(['data'=>$students]);
    }
    public function editStudent($id){
        $user = DB::table('student')->join('parents', 'student.student_id', '=', 'parents.student_id')->where('student.student_id','=',$id)->first();

        return response()->json(['user'=>$user]);

    }

    public function saveRegister(Request $request){

        for ($i=1; $i <= request()->get('total'); $i++) {
            //return request()->get('student-'.$i);
            $id = $request->input('student-'.$i);

            DB::table('attendance')->insert(['student_id' => $id ,'updated_at' => \Carbon\Carbon::now(),'created_at' => \Carbon\Carbon::now()]);
        }
    }
}
