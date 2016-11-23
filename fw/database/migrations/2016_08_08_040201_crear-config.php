<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearConfig extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('contacts', function(Blueprint $table) {
            $table->increments('id');
            $table->string('email');
            $table->string('latLon');
            $table->string('schedule');
            $table->string('address');
            $table->integer('zoomMap');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('contacts');
    }

}
