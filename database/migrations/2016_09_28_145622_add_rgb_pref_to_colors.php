<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRgbPrefToColors extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('colors', function($table) {
            $table->string('rgb', 7);
            $table->string('pref', 5);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('colors', function($table) {
            $table->dropColumn('rgb');
            $table->dropColumn('pref');
        });
    }

}
