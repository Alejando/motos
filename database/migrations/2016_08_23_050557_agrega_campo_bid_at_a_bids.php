<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AgregaCampoBidAtABids extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('bids', function(Blueprint $table){
            $table->dateTime('bid_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('bids', function(Blueprint $table){
            $table->dropColumn('bid_at');
        });
    }

}
