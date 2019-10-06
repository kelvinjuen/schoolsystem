<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFinanceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('finance', function (Blueprint $table) {
            $table->bigIncrements('transaction_id');
            $table->integer('amount')->unsigned();
            $table->integer('requested_by')->unsigned();
            $table->string('status', 100)->default('pedding');
            $table->integer('approved_by')->unsigned();
            $table->string('department', 100);
            $table->string('description', 100)->default('n/a');
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
        Schema::dropIfExists('finance');
    }
}
