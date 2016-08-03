<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserPreferences extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('user_preferences', function(Blueprint $table){
            $table->integer('user')->unsigned();
            $table->integer('preference')->unsigned();
            $table->foreign('user')->references('id')->on('users');
            $table->foreign('preference')->references('id')->on('preferences');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('user_preferences');
    }

}
