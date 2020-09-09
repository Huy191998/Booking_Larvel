<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeoplesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peoples', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('first_name');
            $table->string('lats_name');
            $table->string('phone');
            $table->string('Idcard');
            $table->date('Birthday');
            $table->string('Sex');
            $table->boolean('Isdelete');
            $table->string('Address');
            $table->rememberToken();
            $table->timestamps();
            $table->bigInteger('users_id')->unsigned();
            $table->foreign('users_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->bigInteger('cyti_id')->unsigned();
            $table->foreign('cyti_id')->references('id')->on('cities')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('peoples');
    }
}
