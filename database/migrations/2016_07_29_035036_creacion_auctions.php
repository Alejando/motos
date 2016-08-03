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
            
            $table->integer('category');
            $table->integer('subCategory');
            $table->integer('target');
            $table->string('code',15);
            $table->string('barcode',50);
            $table->string('title',150);
            $table->integer('realPrice');
            $table->integer('cover');
            $table->integer('minOffer');
            $table->integer('maxOffer');
            $table->integer('bids');
            $table->integer('maxPrice');
            $table->integer('userQuota');
            $table->integer('usersLimit');
            $table->integer('delay');
            $table->integer('maxUserQuiet');
            $table->integer('deathTime');
            $table->longText('description');
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
