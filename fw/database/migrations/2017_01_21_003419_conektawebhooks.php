<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Conektawebhooks extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('conekta_webhooks', function(Blueprint $table) {
            $table->increments('id');
            $table->char('charge_id',24)->index();
            $table->longText("changer_info");
            $table->boolean('processed');
            $table->integer('order_id')->unsigned();
            $table->dateTime('expire_at');
            $table->foreign('order_id')
                ->references('id')
                ->on('orders')
                ->onDelete('cascade');
        });
        
        Schema::create('conekta_webhook_events', function(Blueprint $table) {
            $table->increments('id');
            $table->char('event_id',24)->index();
//            $table->longText('response_info');
            $table->integer('order_id')->unsigned();
            $table->foreign('order_id')
                ->references('id')
                ->on('orders')
                ->onDelete('cascade');
            $table->char('charge_id', 24)->index();
            $table->foreign('charge_id')
                ->references('charge_id')
                ->on('conekta_webhooks')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('conekta_webhook_events');
        Schema::drop('conekta_webhooks');
    }

}
