<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnTickets extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users',function(Blueprint $table){
            $table->integer('tickets')->default(0);
        });

        Schema::create('user_ticket_log',function(Blueprint $table){
            $table->integer('user_id')->unsigned();
            $table->text('message');
            $table->timestamps();
            
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('user_ticket_log');

        Schema::table('users',function(Blueprint $table){
            $table->dropColumn('tickets');
        });
    }
}
