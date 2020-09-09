<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('rates');
            $table->string('acreage');
            $table->string('AmountPeople');
            $table->string('image');
            $table->string('surcharge');
            $table->string('description');
            $table->boolean('Isdelete');
            $table->bigInteger('kindrooms_id')->unsigned();
            $table->foreign('kindrooms_id')->references('id')->on('kindrooms')->onUpdate('cascade')->onDelete('cascade');
            $table->bigInteger('roomcategory_id')->unsigned();
            $table->foreign('roomcategory_id')->references('id')->on('RoomCategory')->onUpdate('cascade')->onDelete('cascade');
            $table->bigInteger('hotels_id')->unsigned();
            $table->foreign('hotels_id')->references('id')->on('hotels')->onUpdate('cascade')->onDelete('cascade');

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
        Schema::dropIfExists('rooms');
    }
}
