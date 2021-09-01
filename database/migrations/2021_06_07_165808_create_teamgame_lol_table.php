<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeamgameLolTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teamgame_lol', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('teamgame_id');
            $table->bigInteger('lol_id');
            $table->integer('golds');
            $table->integer('damages');
            $table->string('champion');
            $table->string('position');
            $table->tinyInteger('kills');
            $table->tinyInteger('deaths');
            $table->tinyInteger('assists');
            $table->tinyInteger('largestmultikill');
            $table->tinyInteger('visionscore');
            $table->tinyInteger('cs');
            $table->integer('damagetaken')->nullable();
            $table->integer('wardsplaced')->nullable();
            $table->integer('visionwards')->nullable();
            $table->integer('cc')->nullable();

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
        Schema::dropIfExists('teamgame_lol');
    }
}
