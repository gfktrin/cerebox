<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses',function(Blueprint $table){
            $table->integer('user_id')->unsigned();

            $table->string('zipcode');
            $table->string('address');
            $table->string('number');
            $table->string('complement');//complemento
            $table->string('neighborhood');
            $table->string('city');
            $table->string('state');


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
        Schema::drop('addresses');
    }
}
