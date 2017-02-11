<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddResponseInfoToConektaWebhookEvents extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('conekta_webhook_events', function(Blueprint $table){
            $table->longText('response_info');
            $table->timestamps();
            $table->string('type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('conekta_webhook_events', function(Blueprint $table){
            $table->dropColumn('response_info');
            $table->dropColumn('type');
            $table->dropTimestamps();
        });
    }

}
