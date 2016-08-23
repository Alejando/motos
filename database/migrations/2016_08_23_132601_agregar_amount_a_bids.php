<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AgregarAmountABids extends Migration {

   /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('bids', function(Blueprint $table){
            $table->decimal('amount');
        });
        Schema::table('auctions', function (Blueprint $table){
            $table->integer('min_bids');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('bids', function(Blueprint $table){
            $table->dropColumn('amount');
        });
        Schema::table('auctions', function(Blueprint $table){
            $table->dropColumn('min_bids');
        });
    }

}
