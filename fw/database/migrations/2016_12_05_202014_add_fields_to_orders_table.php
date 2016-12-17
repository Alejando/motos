<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsToOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->integer('status');
            $table->string('tracking_code');
            $table->datetime('estimated_date');
            $table->integer('address_id')->unsigned()->nullable();
            $table->integer('bills_info_id')->unsigned()->nullable();
            $table->foreign('address_id')->references('id')->on('addresses')->onDelete('cascade');
            $table->foreign('bills_info_id')->references('id')->on('bills_infos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            //
            $table->dropColumn('status');
            $table->dropColumn('tracking_code');
            $table->dropColumn('estimated_date');
            $table->dropColumn('address_id');
            $table->dropColumn('bills_info_id');
        });
    }
}
