<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContestThemeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('contest_theme', function (Blueprint $table){
          $table->integer('contest_id')->unsigned();
          $table->integer('theme_id')->unsigned();

          $table->foreign('contest_id')->references('id')->on('contests');
          $table->foreign('theme_id')->references('id')->on('themes');

       });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
