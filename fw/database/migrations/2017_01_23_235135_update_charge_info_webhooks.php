<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateChargeInfoWebhooks extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('conekta_webhooks', function (Blueprint $table) {
            $table->renameColumn('changer_info', 'charge_info');
            $table->string('type',40);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('conekta_webhooks', function (Blueprint $table) {
            $table->renameColumn('charge_info', 'changer_info');
            $table->dropColumn('type');
        });
    }

}
