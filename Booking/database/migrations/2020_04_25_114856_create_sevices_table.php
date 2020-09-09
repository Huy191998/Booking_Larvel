<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSevicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sevices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('Name_icon');
            $table->string('Name');
            $table->string('slug');
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
        Schema::dropIfExists('sevices');
    }
}
