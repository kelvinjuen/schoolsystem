<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('user_id');
            $table->string('first_name');
            $table->string('second_name');
            $table->string('surname');
            $table->integer('id_no')->unsigned();
            $table->string('phone_no', 20)->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('user_type', 50)->default('teacher');
            $table->string('gender', 10);
            $table->string('lesson_combo', 100)->nullable()->default('n/a');
            $table->integer('class')->unsigned()->nullable()->default(0);
            $table->string('cert_type', 100)->nullable()->default('n/a');
            $table->string('cert_title', 100)->nullable()->default('n/a');
            $table->string('institution', 100)->nullable()->default('n/a');
            $table->string('photo', 100)->nullable()->default('no_image.jpg');
            $table->date('delete_at')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
