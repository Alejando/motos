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
        Schema::create('conekta_webhooks', function(Blueprint $table){
            $table->increments('id');
            $table->longText("response_info");
            $table->boolean('processed');
            $table->integer('order_id')->unsigned();
            $table->dateTime('expire_at');
            $table->foreign('order_id')
                ->references('id')
                ->on('orders')
                ->onDelete('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('conekta_webhooks');
    }

}
