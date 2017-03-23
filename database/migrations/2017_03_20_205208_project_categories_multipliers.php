<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ProjectCategoriesMultipliers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_vote_categories_multipliers',function(Blueprint $table){
            $table->integer('project_id')->unsigned();
            $table->integer('vote_category_id')->unsigned();
            $table->decimal('multiplier',5,2);

            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
            $table->foreign('vote_category_id')->references('id')->on('vote_categories')->onDelete('cascade');
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
