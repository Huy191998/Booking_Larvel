<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookroomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookrooms', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->dateTime('book_at');
            $table->dateTime('in_at');
            $table->dateTime('out_at');
            $table->string('total');
            //tien cọc
            $table->string('Deposit');
            $table->integer('payment_status');
            $table->boolean('Isdelete');
            $table->bigInteger('hotels_id')->unsigned();
            $table->foreign('hotels_id')->references('id')->on('hotels')->onUpdate('cascade')->onDelete('cascade');
            $table->bigInteger('rooms_id')->unsigned();
            $table->foreign('rooms_id')->references('id')->on('rooms')->onUpdate('cascade')->onDelete('cascade');
            $table->bigInteger('peoples_id')->unsigned();
            $table->foreign('peoples_id')->references('id')->on('peoples')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('bookrooms');
    }
}
