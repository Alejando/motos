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
            $table->integer('psp')->nullable();
            $table->longText('pspinfo')->nullable();
            $table->boolean('paid')->nullable();
            $table->boolean('sent')->nullable();
            $table->mediumText('urlguia')->nullable();
            $table->string('guia')->nullable();
            $table->string('bill_number', 20)->nullable();
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
            $table->dropColumn('paid');
            $table->dropColumn('sent');
            $table->dropColumn('urlguia');
            $table->dropColumn('guia');
            $table->dropColumn('bill_number');
        });
        Schema::table('items', function(Blueprint $table) {
            $table->dropColumn('order_id');
        });
    }

}
