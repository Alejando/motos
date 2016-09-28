<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContents extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('contents', function(Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('name');
            $table->string('slug');
            $table->string('content');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('contents');
    }

}
