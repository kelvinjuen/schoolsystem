<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use DB;
use Gate;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth',['except'=>['create','store']]);
        if(Gate::allows('isAdmin')){
            return redirect('/')->with('error', 'unauthorised page');
        }



    }
    public function index()
    {

        $teachers = DB::table('users')->select('*')->get();
        return view('pages.teacher')->with(['teachers'=>$teachers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.addTeachers');
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
        $certTitle = "";
        $institution = "";
        $certType = "";

        $company = "";
        $position = "";
        $years = "";

        $validator = \Validator::make($request->all(),[
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'photo' => 'image|nullable|max:1999',
        ]);

        if($validator->fails()){
            return response()->json(['errors'=>$validator->errors()]);
        }
        //check Education
        for ($i=1; $i <=6; $i++) {
            global $certType;
            global $certTitle;
            global $institution;
            if($i == 1){
                if($request->has('degree-'.$i)){
                    $certType.=$request->input('degree-'.$i);
                    $certTitle.=$request->input('cert-title-'.$i);
                    $institution.=$request->input('institution-'.$i);
                }
            }else{
                if($request->has('degree-'.$i)){
                    $certType.=','.$request->input('degree-'.$i);
                    $certTitle.=','.$request->input('cert-title-'.$i);
                    $institution.=','.$request->input('institution-'.$i);
                }
            }
        }

        //check Experience
        for ($i=1; $i <=6; $i++) {
            global $company;
            global $position;
            global $years;
            if($i == 1){
                if($request->has('company-'.$i)){
                    $company.=$request->input('company-'.$i);
                    $position.=$request->input('position-'.$i);
                    $years.=$request->input('years-'.$i);
                }
            }else{
                if($request->has('company-'.$i)){
                    $company.=','.$request->input('company-'.$i);
                    $position.=','.$request->input('position-'.$i);
                    $years.=','.$request->input('years-'.$i);
                }
            }
        }


        //handle file upload
        if($request ->hasFile('photo')){
            global $fileNameToStore;
            //get filename with the ext
            $fileNameWithExt = $request ->file('photo')->getClientOriginalName();
            //get just filename
            $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            //get just extension
            $extension = $request->file('photo')->getClientOriginalExtension();
            //Filename to store
            $fileNameToStore = $request ->get('firstname').'_'.time().'.'.$extension;
            //upload image
            $path = $request->file('photo')->storeAs('public/teacher_images', $fileNameToStore);
        }else{
            $fileNameToStore='noimage.jpg';
        }

        //create new student
        DB::table('users')->insert([
            'first_name' => request()->get('firstname'),'second_name' => request()->get('secondname'),'surname' => request()->get('surname'),
            'id_no' => request()->get('id_no'),'tsc_no' => request()->get('tsc_no'),'gender' => request()->get('gender'),'lesson_combo' => request()->get('combo'),
            'class' => request()->get('grade'),'cert_type' => $certType,'cert_title' => $certTitle,'institution' => $institution,'user_type' =>request()->get('access-level'),
            'phone_no' => request()->get('phone_no'),'photo' => $fileNameToStore,'email' =>request()->get('email'),'password' =>Hash::make(request()->get('password')),
            'dob' => request()->get('dob'),'company' => $company,'position' => $position,'years' => $years,'updated_at' => \Carbon\Carbon::now(),'created_at' => \Carbon\Carbon::now(),
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = DB::table('users')->select('*')->where('user_id',$id)->first();
        return response()->json(['user'=>$user]);
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

        return view('pages.editTeacher');
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
        $certTitle = "";
        $institution = "";
        $certType = "";

        $company = "";
        $position = "";
        $years = "";

        $validator = \Validator::make($request->all(),[
            'email' => 'required|string|email|max:255|unique:users,email,'.$id.',user_id',
            'photo' => 'image|nullable|max:1999',
        ]);

        if($validator->fails()){
            return response()->json(['errors'=>$validator->errors()]);
        }
        //check Education
        for ($i=1; $i <=6; $i++) {
            global $certType;
            global $certTitle;
            global $institution;
            if($i == 1){
                if($request->has('degree-'.$i)){
                    $certType.=$request->input('degree-'.$i);
                    $certTitle.=$request->input('cert-title-'.$i);
                    $institution.=$request->input('institution-'.$i);
                }
            }else{
                if($request->has('degree-'.$i)){
                    $certType.=','.$request->input('degree-'.$i);
                    $certTitle.=','.$request->input('cert-title-'.$i);
                    $institution.=','.$request->input('institution-'.$i);
                }
            }
        }

        //check Experience
        for ($i=1; $i <=6; $i++) {
            global $company;
            global $position;
            global $years;
            if($i == 1){
                if($request->has('company-'.$i)){
                    $company.=$request->input('company-'.$i);
                    $position.=$request->input('position-'.$i);
                    $years.=$request->input('years-'.$i);
                }
            }else{
                if($request->has('company-'.$i)){
                    $company.=','.$request->input('company-'.$i);
                    $position.=','.$request->input('position-'.$i);
                    $years.=','.$request->input('years-'.$i);
                }
            }
        }


        //handle file upload
        if($request ->hasFile('photo')){
            global $fileNameToStore;
            //get filename with the ext
            $fileNameWithExt = $request ->file('photo')->getClientOriginalName();
            //get just filename
            $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            //get just extension
            $extension = $request->file('photo')->getClientOriginalExtension();
            //Filename to store
            $fileNameToStore = $request ->get('firstname').'_'.time().'.'.$extension;
            //upload image
            $path = $request->file('photo')->storeAs('public/teacher_images', $fileNameToStore);
        }else{
            $file = DB::table('users')->select('photo')->where('user_id',$id)->first();
            $fileNameToStore =$file->photo;
        }

        // Update User
        DB::table('users')->where('user_id',$id)->update(['first_name' => request()->get('firstname'),'second_name' => request()->get('secondname'),'surname' => request()->get('surname'),
            'id_no' => request()->get('id_no'),'tsc_no' => request()->get('tsc_no'),'gender' => request()->get('gender'),'lesson_combo' => request()->get('combo'),
            'class' => request()->get('grade'),'cert_type' => $certType,'cert_title' => $certTitle,'institution' => $institution,'user_type' =>request()->get('access-level'),
            'phone_no' => request()->get('phone_no'),'photo' => $fileNameToStore,'email' =>request()->get('email'),'dob' => request()->get('dob'),'company' => $company,
            'position' => $position,'years' => $years,'updated_at' => \Carbon\Carbon::now()]);
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

    public function dataTable(){
        $teachers = DB::table('users')->select('user_id','photo',DB::raw('CONCAT(first_name," ",surname )as name'),'class','tsc_no','lesson_combo','cert_type','phone_no','user_type')->get();
        return response()->json(['data'=>$teachers]);
    }

    public function editTeacher($id){
        $user = DB::table('users')->select('*')->where('user_id',$id)->first();

        return response()->json(['user'=>$user]);

    }
}
