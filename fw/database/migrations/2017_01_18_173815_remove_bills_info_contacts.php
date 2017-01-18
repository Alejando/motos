<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveBillsInfoContacts extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('orders', function(Blueprint $table) {
            $table->dropForeign('orders_bills_info_id_foreign');
            $table->dropColumn('bills_info_id');
        });
        Schema::drop('bills_infos');
        Schema::drop('contacts');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        //
    }

}
