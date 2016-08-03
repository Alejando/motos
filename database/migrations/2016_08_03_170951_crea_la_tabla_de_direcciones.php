<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreaLaTablaDeDirecciones extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('addresses', function(Blueprint $table){
            $table->increments('id');
            $table->string('country');//pais
            $table->string('city');//ciudad
            $table->string('state');//estado
            $table->string('street');//caññe
            $table->string('streetNumber');//numero
            $table->string('suiteNumber');//interior
            $table->string('neighborhood');//colonia
            $table->string('postalcode');//codigo postal
            $table->integer('user')->unsigned();
            $table->foreign('user')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('addresses');
    }

}
