<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAuctionFav extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('auctions_fav', function(Blueprint $table) {
            $table->integer('user_id')->unsigned();
            $table->integer('auction_id')->unsigned();
            $table->foreign('auction_id')->references('id')->on('auctions');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('auctions_fav');
    }

}
