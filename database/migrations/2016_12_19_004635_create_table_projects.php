<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableProjects extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects',function(Blueprint $table){
            $table->increments('id');
            $table->integer('author_id')->unsigned();
            $table->integer('contest_id')->unsigned();

            $table->string('filename');
            $table->boolean('approved')->default(0);

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('author_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('contest_id')->references('id')->on('contests')->onDelete('cascade');
        });

        Schema::create('users_projects_votes',function(Blueprint $table){
            $table->integer('user_id')->unsigned();
            $table->integer('contest_id')->unsigned();
            $table->integer('project_id')->unsigned();
            $table->timestamps();

            $table->primary(['user_id','contest_id']);

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('contest_id')->references('id')->on('contests')->onDelete('cascade');
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users_projects_votes');

        Schema::drop('projects');
    }
}
