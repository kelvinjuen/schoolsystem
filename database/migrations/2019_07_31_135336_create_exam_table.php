<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExamTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exam', function (Blueprint $table) {
            $table->bigIncrements('exam_id');
            $table->integer('admission_no')->unsigned();
            $table->integer('math')->unsigned();
            $table->integer('english')->unsigned();
            $table->integer('composition')->unsigned();
            $table->integer('swahili')->unsigned();
            $table->integer('insha')->unsigned();
            $table->integer('science')->unsigned();
            $table->integer('social')->unsigned();
            $table->integer('cre')->unsigned();
            $table->integer('enter_by')->unsigned();
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
        Schema::dropIfExists('exam');
    }
}
