<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMmrsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mmrs', function (Blueprint $table) {
            $table->id();

            $table->date('date_moment');
            $table->integer('mmr_soloq')->nullable();
            $table->integer('mmr_flexq')->nullable();
            
            $table->bigInteger('lol_id')->unsigned();
            $table->foreign('lol_id')->references('id')->on('lols');

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
        Schema::dropIfExists('mmrs');
    }
}
