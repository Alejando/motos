<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColorDefaultToProducts extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('products', function(Blueprint $table) {
            $table->integer('default_color_id')->unsigned()->nullable();
            $table->foreign('default_color_id')->nullable()->references('id')->on('colors')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('products', function(Blueprint $table) {
            $table->dropForeign('products_default_color_id_foreign');
            $table->dropColumn('default_color_id');
        });
    }

}
