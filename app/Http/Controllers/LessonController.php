<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use PDF;

class LessonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('pages.timetable');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $teachers = DB::table('users')->select('*')->where('class','!=',0)->get();
        return view('pages.createLesson')->with(['teachers'=>$teachers]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        for ($i=1; $i <=13; $i++) {
            DB::table('lesson')->insert(['lesson_number' =>request()->get('lesson-number-'.$i),'description' =>request()->get('lesson-select-'.$i),
            'teacher' =>request()->get('lesson-teacher-'.$i),'day' =>request()->get('select-day'),'grade' =>request()->get('grade'),
            'lesson_time'=>request()->get('lesson-time-'.$i),'updated_at' => \Carbon\Carbon::now(),'created_at' => \Carbon\Carbon::now()
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
        //
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
        DB::table('lesson')->where('lesson_id',$id)->update(['description' => request()->get('new-lesson'),'teacher' => request()->get('lesson-teacher'),'updated_at' => \Carbon\Carbon::now()]);
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
    public function getTimeTable($grade){
        $monday = array("0"=>"Mon");
        $tuesday = array("0"=>"Tue");
        $wed = array("0"=>"Wed");
        $thursday = array("0"=>"Thur");
        $friday = array("0"=>"Sat");
        if($grade == 0){
            $grade = 1;
        }

        $timetable = DB::table('lesson')->select(DB::raw('CONCAT(users.first_name," ",users.surname )as name'),'description','day','lesson_number')->join('users', 'lesson.teacher', '=', 'users.user_id')->where('lesson.grade',$grade)->get();

        foreach ($timetable as $Lesson){
            if($Lesson->day == 1){
                $monday[$Lesson->lesson_number] = '<h5>'.$Lesson->description.'</h5><small>'.$Lesson->name.'</small>';
            }
            if($Lesson->day == 2){
                $tuesday[$Lesson->lesson_number] = '<h5>'.$Lesson->description.'</h5><small>'.$Lesson->name.'</small>';
            }
            if($Lesson->day == 3){
                $wed[$Lesson->lesson_number] = '<h5>'.$Lesson->description.'</h5><small>'.$Lesson->name.'</small>';
            }
            if($Lesson->day == 4){
                $thursday[$Lesson->lesson_number] = '<h5>'.$Lesson->description.'</h5><small>'.$Lesson->name.'</small>';
            }
            if($Lesson->day == 5){
                $friday[$Lesson->lesson_number] = '<h5>'.$Lesson->description.'</h5><small>'.$Lesson->name.'</small>';
            }
        }
        $data= array_merge([$monday],[$tuesday],[$wed],[$thursday],[$friday]);


        return response()->json(['data'=>$data]);
    }

    public function checkTableExist($grade){
        $timetable = DB::table('lesson')->select('created_at as time')->where('grade',$grade)->first();

        return response()->json(['data'=>$timetable]);
    }
    public function getLesson( $grade,$lesson_number,$day){
        $teachers = DB::table('users')->select('user_id',DB::raw('CONCAT(users.first_name," ",users.surname )as name'))->where('class','!=',0)->get();
        $timetable = DB::table('lesson')->join('users', 'lesson.teacher', '=', 'users.user_id')->select('lesson_id','description',DB::raw('CONCAT(users.first_name," ",users.surname )as name'))
        ->where('lesson_time',$lesson_number)->where('lesson.grade',$grade)->where('day',$day)->first();

        return response()->json(['data'=>$timetable, 'teacher'=>$teachers]);
    }
    public function checkTeacher($teacher,$day,$lesson_number){
        $teachers = DB::table('lesson')->select('description','grade')
        ->where('teacher',$teacher)->where('day',$day)->where('lesson_time',$lesson_number)->first();

        return response()->json(['teacher'=>$teachers]);

    }

    public function printTimeTable($grade){

        $monday = array("0"=>"Mon");
        $tuesday = array("0"=>"Tue");
        $wed = array("0"=>"Wed");
        $thursday = array("0"=>"Thur");
        $friday = array("0"=>"Sat");
        if($grade == 0){
            $grade = 1;
        }

        $timetable = DB::table('lesson')->select(DB::raw('CONCAT(users.first_name," ",users.surname )as name'),'description','day','lesson_number')->join('users', 'lesson.teacher', '=', 'users.user_id')->where('lesson.grade',$grade)->get();

        foreach ($timetable as $Lesson){
            if($Lesson->day == 1){
                $monday[$Lesson->lesson_number] = '<h4>'.$Lesson->description.'</h4><small>'.$Lesson->name.'</small>';
            }
            if($Lesson->day == 2){
                $tuesday[$Lesson->lesson_number] = '<h4>'.$Lesson->description.'</h4><small>'.$Lesson->name.'</small>';
            }
            if($Lesson->day == 3){
                $wed[$Lesson->lesson_number] = '<h4>'.$Lesson->description.'</h4><small>'.$Lesson->name.'</small>';
            }
            if($Lesson->day == 4){
                $thursday[$Lesson->lesson_number] = '<h4>'.$Lesson->description.'</h4><small>'.$Lesson->name.'</small>';
            }
            if($Lesson->day == 5){
                $friday[$Lesson->lesson_number] = '<h4>'.$Lesson->description.'</h4><small>'.$Lesson->name.'</small>';
            }
        }
        $data= array_merge([$monday],[$tuesday],[$wed],[$thursday],[$friday]);

        $output = [
            'grade' => $grade,
            'table' => $data,
        ];

        $pdf =  PDF::loadView('pages.pdf.timeTable', $output)->setPaper('a4','landscape');
        return $pdf->stream($grade,array('Attachment'=>false));


    }
}
