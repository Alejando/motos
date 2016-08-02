<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreacionAuctions extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('auctions', function(Blueprint $table){
            $table->increments('id');
            $table->string('title');
            $table->longText('description');
            $table->integer('maxBid');
            $table->integer('minBid');
            $table->integer('maxOffer');
            $table->integer('userTop');
            $table->integer('delay');
            $table->integer('target');
            $table->dateTime('startDate');
            $table->dateTime('endDate');
            $table->boolean('published');
            $table->smallInteger('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('auctions');
    }

}
