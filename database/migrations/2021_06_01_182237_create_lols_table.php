<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLolsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lols', function (Blueprint $table) {
            $table->id();

            $table->string('pseudo');
            $table->integer('lvl')->nullable();
            $table->boolean('hotstreak')->nullable();
            $table->integer('lp')->nullable();
            $table->string('rank')->nullable();
            $table->string('tier')->nullable();
            $table->string('id_sum')->nullable();
            $table->integer('wins')->nullable();
            $table->integer('loses')->nullable();
            


            $table->bigInteger('player_id')->unsigned();
            $table->foreign('player_id')->references('id')->on('players');

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
        Schema::dropIfExists('lols');
    }
}
