<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AgregaCampoNumBidsAAuctions extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('auctions', function(Blueprint $table){
            $table->integer('num_bids');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('auctions', function(Blueprint $table){
            $table->dropColumn('num_bids');
        });
    }

}
