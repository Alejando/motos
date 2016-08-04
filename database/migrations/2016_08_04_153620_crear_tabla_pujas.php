<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaPujas extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('bids', function(Blueprint $table){
            $table->increments('id');
            $table->decimal('offer');
            $table->integer('user')->unsigned();
            $table->integer('auction')->unsigned();
            $table->integer('enrollment')->unsigned();
            $table->foreign('auction')->references('id')->on('auctions');
            $table->foreign('user')->references('id')->on('users');
            $table->foreign('enrollment')->references('id')->on('enrollments');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('bids');
    }

}
