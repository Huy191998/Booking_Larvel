<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('RoomCategory', function (Blueprint $table) {
             $table->bigIncrements('id');
            $table->string('RoomCategory');
            $table->string('AmountPeople');
            $table->string('Describe');
            $table->boolean('Isdelete');
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
        Schema::dropIfExists('RoomCategory');
    }
}
