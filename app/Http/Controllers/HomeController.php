<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Date;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('pages.home');
    }
    public function Lessons(){
        $d = date('l');
        $day = 0;
        if($d === 'Monday'){
            $day = 1;
        }else if($d === 'Tuesday'){
            $day = 2;
        }else if($d === 'Wednesday'){
            $day = 3;
        }else if($d === 'Thursday'){
            $day = 4;
        }else if($d === 'Friday'){
            $day = 5;
        }
        $lessons = DB::table('lesson')->select('lesson_time','description','grade')->where('teacher', auth()->user()->user_id)->where('day', $day)->get();
        $student = DB::table('attendance')->select(DB::raw('CONCAT(first_name," ",surname )as name'))
        ->join('student', 'attendance.student_id', '=', 'student.student_id')->where('attendance.created_at','>=',date('Y-m-d').' 00:00:00')->get();
        return response()->json(['lessons'=>$lessons,'attendance'=>$student]);
    }

    public function subjectChart($type){
        $exam = DB::table('exam')->where('grade',auth()->user()->class)->where('exam_type',$type)->select(DB::raw('avg(math) as math'),DB::raw('avg(english) as english'),DB::raw('avg(composition) as composition'),
        DB::raw('avg(swahili) as swahili'),DB::raw('avg(insha) as insha'),DB::raw('avg(science) as science'),DB::raw('avg(social) as social'),DB::raw('avg(cre) as cre'))->first();

        return response()->json(['exam'=>$exam]);
    }
    public function examChart( ){
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
                    $exam = DB::table('exam')->where('grade',auth()->user()->class)->where('exam_type',$k)->where('term',$j)->select(DB::raw('avg(math) as math'),DB::raw('avg(english) as english'),DB::raw('avg(composition) as composition'),
                    DB::raw('avg(swahili) as swahili'),DB::raw('avg(insha) as insha'),DB::raw('avg(science) as science'),DB::raw('avg(social) as social'),DB::raw('avg(cre) as cre'))->first();
                    if($k === 3){
                        $ttl =  ($exam->math + (($exam->english + $exam->composition + $exam->swahili + $exam->insha) /2)+$exam->science + $exam->social + $exam->cre)* 0.6;
                    }else{
                        $ttl =  ($exam->math + (($exam->english + $exam->composition + $exam->swahili + $exam->insha) /2)+$exam->science + $exam->social + $exam->cre)* 0.2;
                    }

                    $term_total += $ttl;
                }


                if($term_total > 0){
                    $terms++;
                    $exams[$terms] = $term_total;

                }

            }
        }

        return response()->json(['terms'=>$exams,'total'=>$terms]);

    }
}
