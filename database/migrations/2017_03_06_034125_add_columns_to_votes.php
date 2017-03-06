<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToVotes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users_projects_votes',function(Blueprint $table){
            $table->integer('creativity');
            $table->integer('theme_connection');
            $table->integer('ability');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users_projects_votes',function(Blueprint $table){
            $table->dropColumn('creativity');
            $table->dropColumn('theme_connection');
            $table->dropColumn('ability');
        });
    }
}
