<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearRelacionCategoriaCategoriaPadre extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('categories', function(Blueprint $table){
            $table->foreign('parentCategory')
                ->references('id')
                ->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('categories', function(Blueprint $table){
            $table->dropForeign('categories_parentcategory_foreign');
        });
    }

}
