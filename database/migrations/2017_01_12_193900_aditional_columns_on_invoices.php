<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AditionalColumnsOnInvoices extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('invoices',function(Blueprint $table){
            $table->string('transaction_id')->unique()->nullable();
            $table->integer('status')->nullable();
            $table->integer('payment_method')->nullable();
            $table->decimal('amount')->nullable();
            $table->decimal('net_amount')->nullable();
            $table->timestamp('payed_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('invoices',function(Blueprint $table){
            $table->dropColumn('status');
            $table->dropColumn('payment_method');
            $table->dropColumn('amount');
            $table->dropColumn('payed_at');
            $table->dropColumn('net_amount');
        });
    }
}
