<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateColorsColorName extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('colors', function(Blueprint $table) {
            $table->renameColumn('color', 'name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('colors', function(Blueprint $table){
            $table->renameColumn('name','color');
        });
    }

}
