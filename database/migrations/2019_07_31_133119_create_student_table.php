<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student', function (Blueprint $table) {
            $table->bigIncrements('student_id');
            $table->integer('admission_no')->unsigned();
            $table->string('first_name');
            $table->string('second_name');
            $table->string('surname');
            $table->integer('grade')->unsigned();
            $table->string('gender', 20);
            $table->integer('niims')->unsigned()->nullable();
            $table->date('dob');
            $table->string('previous_school', 100)->nullable();
            $table->mediumText('special_needs', 100)->nullable();
            $table->string('photo', 100)->nullable()->default('no_image.jpg');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student');
    }
}
