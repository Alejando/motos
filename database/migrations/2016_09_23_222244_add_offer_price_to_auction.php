<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddOfferPriceToAuction extends Migration
{
   /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::table('auctions', function(Blueprint $table) {
            $table->decimal("offer_price");
            $table->boolean("offer_on");
        }); 
    }

    /**
     * Reverse the migrations. 
     *
     * @return void
     */
    public function down(){
        Schema::table('auctions', function(Blueprint $table) {
            $table->dropColumn("offer_price");
            $table->dropColumn("offer_on");
        });
    }
}
