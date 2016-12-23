<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddShippingInfoToOrder extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('orders', function(Blueprint $table) {
//            $table->dropForeign('');
//            $table->dropColumn('bills_info_id');
            $table->integer('b_info_id')->unsigned();
        });
        Schema::table('orders', function(Blueprint $table) {
             $table->foreign('b_info_id')->references('id')->on('billing_information')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        
    }

}
