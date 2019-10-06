<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;

class UpdateAttendance extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:attendance';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'update attendance of students';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
       $students =DB::table('student')->select('*')->get();

       foreach ($students as $student) {
        $id =  $student->student_id;
        if($student->attendance == 0){
            DB::table('attendance')->insert(['attendance_status' => 'missed','student_id' => $id,
            'updated_at' => \Carbon\Carbon::now(),'created_at' => \Carbon\Carbon::now(),
            ]);

        }else{
            DB::table('student')->where('student_id',$id)->update(['attendance' => 0]);
        }
       }
       $this->info('attendance updated successfully');
    }

}
