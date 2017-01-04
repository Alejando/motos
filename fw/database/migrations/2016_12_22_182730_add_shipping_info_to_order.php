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
            $table->integer('billing_information_id')->unsigned()->nullable();
            $table->integer('psp');
            $table->longText('pspinfo');
            $table->boolean('paid');
//            $table->foreign('billing_information_id')->references('id')->on('billing_information')->onDelete('cascade');
        });
        Schema::table('items', function(Blueprint $table) {
            $table->integer('order_id')->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('orders', function(Blueprint $table) {
            $table->dropColumn('billing_information_id');
            $table->dropColumn('psp');
            $table->dropColumn('pspinfo');
            $table->boolean('paid');
        });
        Schema::table('items', function(Blueprint $table) {
            $table->dropColumn('order_id');
        });
    }

}
