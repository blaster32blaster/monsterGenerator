<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Torso extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('torsos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('creature_id')->unsigned();
            $table->string('color');
            $table->string('covering');
            $table->string('pattern');
            $table->timestamps();
        });

        Schema::table('torsos', function($table) {
            $table->foreign('creature_id')->references('id')->on('creatures');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('torsos');
    }
}
