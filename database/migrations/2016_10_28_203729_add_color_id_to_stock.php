<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColorIdToStock extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('stocks', function(Blueprint $table) {
            $table->integer('color_id')->unsigned()->nullable();
            $table->foreign('color_id')->nullable()->references('id')->on('colors')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('stocks', function(Blueprint $table) {
            $table->dropForeign('stocks_color_id_foreign');
            $table->dropColumn('color_id');
        });
    }

}
