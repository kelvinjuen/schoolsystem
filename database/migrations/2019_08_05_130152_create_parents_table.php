<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parents', function (Blueprint $table) {
            $table->bigIncrements('parent_id');
            $table->string('father_names', 100)->nullable()->default('N/A');
            $table->string('father_contact', 100)->nullable()->default('N/A');
            $table->string('father_email', 100)->nullable()->default('N/A');
            $table->string('mother_names', 100)->nullable()->default('N/A');
            $table->string('mother_contact', 100)->nullable()->default('N/A');
            $table->string('mother_email', 100)->nullable()->default('N/A');
            $table->string('guardian_names', 100)->nullable()->default('N/A');
            $table->string('guardian_contact', 100)->nullable()->default('N/A');
            $table->string('guardian_email', 100)->nullable()->default('N/A');
            $table->integer('student_id')->unsigned();
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
        Schema::dropIfExists('parents');
    }
}
