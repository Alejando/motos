<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreaPayments extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('payments', function(Blueprint $table){
            $table->increments('id');
            $table->decimal('amount');
            $table->integer('user')->unsigned();
            $table->string('folio');
            $table->string('subtotal');
            $table->string('iva');
            $table->string('date_at');
            $table->string('description');
            $table->integer('auction')->unsigned();
            $table->integer('type');
            $table->integer('provider');
            $table->boolean('approved')->nullable();
            $table->longText('api_info');
            $table->foreign('auction')->references('id')->on('auctions');
            $table->foreign('user')->references('id')->on('users');
        });
    }

   /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('payments');
    }

}
