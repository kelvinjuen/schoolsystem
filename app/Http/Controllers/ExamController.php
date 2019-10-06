<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use PDF;

class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $grade = 0 ;
        if(auth()->user()->class == 0){
            $grade = 1;
        }else{
            $grade = auth()->user()->class;
        }
        $exam = DB::table('exam')->select('student.grade','term','exam_type')->join('student',function($join){
            $join->on('exam.admission_no','=','student.admission_no');
        })->where('student.grade',$grade)->first();
        //echo $exam->term;
        if(isset($exam->exam_type)){
            if($exam->exam_type == 1){
                $exam->exam_type = 'openner';
            }
        }


        return view('pages.exam')->with(['exam'=>$exam]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.enterexam');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user_id = auth()->user()->user_id;
        for ($i=0; $i < request()->get('number'); $i++) {
            DB::table('exam')->insert(['admission_no' =>request()->get('admission-'.$i),'math' =>request()->get('math-'.$i),
            'english' =>request()->get('eng-'.$i),'composition' =>request()->get('comp-'.$i),'swahili' =>request()->get('swa-'.$i),
            'insha' =>request()->get('ins-'.$i),'science' =>request()->get('sce-'.$i),'social' =>request()->get('ss-'.$i),
            'cre' =>request()->get('cre-'.$i),'term' =>request()->get('term'),'exam_type' =>request()->get('exam-type'),
            'enter_by' => $user_id,'updated_at' => \Carbon\Carbon::now(),'created_at' => \Carbon\Carbon::now(),
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('pages.editExam');
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
        //
        $user_id = auth()->user()->user_id;
        for ($i=0; $i < request()->get('number'); $i++) {

            DB::table('exam')->where('exam_id',request()->get('id-'.$i))->update([
                'math' =>request()->get('math-'.$i),'english' =>request()->get('eng-'.$i),'composition' =>request()->get('comp-'.$i),
                'swahili' =>request()->get('swa-'.$i),'insha' =>request()->get('ins-'.$i),'science' =>request()->get('sce-'.$i),
                'social' =>request()->get('ss-'.$i),'cre' =>request()->get('cre-'.$i),'enter_by' => $user_id,
                'updated_at' => \Carbon\Carbon::now()
            ]);
        }
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

    public function createTable($grade){
        $students = DB::table('student')->select('student.admission_no as id','first_name','second_name','surname')->where('student.grade',$grade)->get();
        return response()->json(['students'=>$students]);

    }

    public function editTable($grade,$term,$type){
        $students = DB::table('student')->join('exam', 'student.admission_no', '=', 'exam.admission_no')->select('exam_id','student.admission_no as id','first_name','second_name','surname','math','english','composition','swahili','insha','science','social','cre')
        ->where('student.grade',$grade)->where('term',$term)->where('exam_type',$type)->get();
        return response()->json(['students'=>$students]);

    }

    public function setExamTable(){
        $grade = 0 ;
        if(auth()->user()->class == 0){
            $grade = 1;
        }else{
            $grade = auth()->user()->class;
        }
        $exam = DB::table('exam')->select('exam_id','exam.admission_no as Admission',DB::raw('CONCAT(student.first_name," ",student.surname )as name'),DB::raw('math + ((english + composition + swahili + insha) /2)+science + social + cre as total'),'exam.math','exam.english','exam.composition','exam.swahili','exam.insha','exam.science','exam.social','exam.cre','exam.term as position')->join('student',function($join){
            $join->on('exam.admission_no','=','student.admission_no');
        })->where('student.grade',$grade)->where('term',1)->where('exam_type',1)->orderBy('total', 'desc')->get();
        $x = 1;

        foreach ($exam as &$value) {
            $value->position = $x;
            $x++;
        }
        return response()->json(['data'=>$exam]);
    }

    public function getResult($grade,$term,$type){
        $exam = DB::table('exam')->select('exam_id','exam.admission_no as Admission',DB::raw('CONCAT(student.first_name," ",student.surname )as name'),DB::raw('math + ((english + composition + swahili + insha) /2)+science + social + cre as total'),'exam.math','exam.english','exam.composition','exam.swahili','exam.insha','exam.science','exam.social','exam.cre','exam.term as position')->join('student',function($join){
            $join->on('exam.admission_no','=','student.admission_no');
        })->where('student.grade',$grade)->where('term',$term)->where('exam_type',$type)->orderBy('total', 'desc')->get();

        $x = 1;

        foreach ($exam as &$value) {
            $value->position = $x;
            $x++;
        }
        return response()->json(['data'=>$exam]);
    }

    public function checkExamExist($grade,$term,$type){
        $exam = DB::table('exam')->select('exam.created_at as time')->join('student',function($join){
            $join->on('exam.admission_no','=','student.admission_no');
        })->where('student.grade',$grade)->where('term',$term)->where('exam_type',$type)->first();

        return response()->json(['data'=>$exam]);
    }

    public function pdf($id,$position){
        /*$pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($this->convert_customer_data_to_html($id));
        return $pdf->stream();*/
        $exam = DB::table('exam')->select('exam.admission_no as admission',DB::raw('CONCAT(student.first_name," ",student.surname )as name'),'exam.grade','term','exam_type','math','exam.english','exam.composition','exam.swahili','exam.insha','exam.science','exam.social','exam.cre','exam.term as total')->join('student',function($join){
            $join->on('exam.admission_no','=','student.admission_no');
        })->where('exam_id',$id)->first();

        $exam->total = $exam->math + (($exam->english + $exam->composition + $exam->swahili + $exam->insha) /2)+$exam->science + $exam->social + $exam->cre;

        $swahili_result = DB::table('exam')->select('exam_id','math','english','composition',DB::raw('((english + composition)/2) as eng_total,((swahili + insha)/2) as swa_total'),'swahili','insha','science','social','cre')
        ->where('grade',$exam->grade)->where('term',$exam->term)->where('exam_type',$exam->exam_type)->get();

        $math =[];
        $english =[];
        $composition =[];
        $english_total =[];
        $swahili = [];
        $swahili_total = [];
        $insha = [];
        $science = [];
        $social = [];
        $cre = [];
        $total_student = 0;
        foreach ($swahili_result as &$value) {
            $math[$value->exam_id] = $value->math;
            $english[$value->exam_id] = $value->english;
            $composition[$value->exam_id] = $value->composition;
            $english_total[$value->exam_id] = $value->eng_total;
            $swahili[$value->exam_id] = $value->swahili;
            $swahili_total[$value->exam_id] = $value->swa_total;
            $insha[$value->exam_id] = $value->insha;
            $science[$value->exam_id] = $value->science;
            $social[$value->exam_id] = $value->social;
            $cre[$value->exam_id] = $value->cre;

            $total_student++;
        }
        arsort($math);
        arsort($english);
        arsort($composition);
        arsort($english_total);
        arsort($swahili);
        arsort($swahili_total);
        arsort($insha);
        arsort($science);
        arsort($social);
        arsort($cre);

        $math_pos = array_search($id,array_keys($math)) + 1;
        $eng_pos = array_search($id,array_keys($english)) + 1;
        $comp_pos = array_search($id,array_keys($composition)) + 1;
        $eng_total_pos = array_search($id,array_keys($english_total)) + 1;
        $swa_pos = array_search($id,array_keys($swahili)) + 1;
        $swa_total_pos = array_search($id,array_keys($swahili_total)) + 1;
        $insha_pos = array_search($id,array_keys($insha)) + 1;
        $science_pos = array_search($id,array_keys($science)) + 1;
        $social_pos = array_search($id,array_keys($social)) + 1;
        $cre_pos = array_search($id,array_keys($cre)) + 1;




        $output = [
            'title' => 'REPORT CARD',
            'name' => $exam->name,
            'admission' => $exam->admission,
            'grade' => $exam->grade,
            'term' => $exam->term,
            'math' => $exam->math,
            'english' => $exam->english,
            'composition' => $exam->composition,
            'swahili' => $exam->swahili,
            'insha' => $exam->insha,
            'science' => $exam->science,
            'social' => $exam->social,
            'cre' => $exam->cre,

            'position_math'=>$math_pos,
            'math_grade'=>$this->resultGrade($exam->math),
            'math_comment'=>$this->resultComment($exam->math),

            'position_english'=>$eng_pos,
            'eng_grade'=>$this->resultGrade($exam->english),
            'english_comment'=>$this->resultComment($exam->english),


            'position_composition'=>$comp_pos,
            'comp_grade'=>$this->resultGrade($exam->composition),
            'composition_comment'=>$this->resultComment($exam->composition),

            'eng_total' =>round($english_total[$id]),
            'pos_eng_total'=>$eng_total_pos,
            'eng_grade_total'=>$this->resultGrade($english_total[$id]),
            'english_comment_total'=>$this->resultComment($english_total[$id]),


            'position_swahili'=>$swa_pos,
            'swa_grade'=>$this->resultGrade($exam->swahili),
            'swahili_comment'=>$this->resultComment($exam->swahili),

            'position_insha'=>$insha_pos,
            'insha_grade'=>$this->resultGrade($exam->insha),
            'insha_comment'=>$this->resultComment($exam->insha),

            'swa_total' =>round($swahili_total[$id]),
            'pos_swa_total'=>$swa_total_pos,
            'swa_grade_total'=>$this->resultGrade($swahili_total[$id]),
            'swahili_comment_total'=>$this->resultComment($swahili_total[$id]),

            'position_science'=>$science_pos,
            'science_grade'=>$this->resultGrade($exam->science),
            'science_comment'=>$this->resultComment($exam->science),

            'position_social'=>$social_pos,
            'social_grade'=>$this->resultGrade($exam->social),
            'social_comment'=>$this->resultComment($exam->social),

            'position_cre'=>$cre_pos,
            'cre_grade'=>$this->resultGrade($exam->cre),
            'cre_comment'=>$this->resultComment($exam->cre),


            'total' => $exam->total,
            'position'=> $position.' / '.$total_student,
            'total_grade'=>$this->resultGrade($exam->total/5),
            'total_comment'=>$this->resultComment($exam->total/5),

        ];

        $pdf =  PDF::loadView('pages.pdf_view', $output);
        return $pdf->stream($exam->name,array('Attachment'=>false));
    }

    public function resultGrade($request){
        if($request > 79){
            return 'A';
        }else if($request > 69 && $request < 80){
            return 'A-';
        }else if($request > 59 && $request < 70){
            return 'B';
        }else if($request > 49 && $request < 60){
            return 'C';
        }else if($request > 39 && $request < 50){
            return 'D';
        }else{
            return 'E';
        }
    }

    public function resultComment($request){
        if($request > 79){
            return 'Excellent';
        }else if($request > 69 && $request < 80){
            return 'Very Good';
        }else if($request > 59 && $request < 70){
            return 'Good';
        }else if($request > 49 && $request < 60){
            return 'Room for improvement';
        }else if($request > 39 && $request < 50){
            return 'Work hard';
        }else{
            return 'Make Extra Effort';
        }
    }

    public function examReport($grade,$term,$type){
        $exam = DB::table('exam')->select('exam_id','exam.admission_no as Admission',DB::raw('CONCAT(student.first_name," ",student.surname )as name'),DB::raw('math + ((english + composition + swahili + insha) /2)+science + social + cre as total'),'exam.math','exam.english','exam.composition','exam.swahili','exam.insha','exam.science','exam.social','exam.cre','exam.term as position')->join('student',function($join){
            $join->on('exam.admission_no','=','student.admission_no');
        })->where('student.grade',$grade)->where('term',$term)->where('exam_type',$type)->orderBy('total', 'desc')->get();

        $x = 1;
        foreach ($exam as &$value) {
            $value->position = $x;
            $x++;
        }

        $avg = DB::table('exam')->select(DB::raw('avg(math) as math, avg(english) as english, avg(composition) as comp, avg(swahili) as swahili, avg(insha) as insha, avg(science) as science, avg(social) as social, avg(cre) as cre'))
        ->where('grade',$grade)->where('term',$term)->where('exam_type',$type)->first();

        $avg_grades =[];
        foreach ($avg as $key =>  $value) {
            $avg_grades[$key] = $this->resultGrade($value);
        }

        $output = [
            'grade' => $grade,
            'term' => $term,
            'type' => $type,
            'exam' => $exam,
            'average' =>$avg,
            'average_grade' =>$avg_grades
        ];

        $pdf =  PDF::loadView('pages.pdf.examReport', $output)->setPaper('a4','landscape');
        return $pdf->stream($grade,array('Attachment'=>false));


    }


}
