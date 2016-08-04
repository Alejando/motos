<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaInscripciones extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('enrollments', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('user')->unsigned();
            $table->integer('auction')->unsigned();
            $table->decimal('cover');
            $table->integer('totalbids');
            $table->integer('bids');
            $table->integer('offer');
            $table->foreign('user')->references('id')->on('users');
            $table->foreign('auction')->references('id')->on('auctions');
        });
    }

    /**
     * Reverse the migrations.

     * @return void
     */
    public function down() {
        Schema::drop('enrollments');
    }

}
