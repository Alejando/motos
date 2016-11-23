<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameParentCategoryFromCategories extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('categories', function (Blueprint $table) {
            $table->dropForeign('categories_parentcategory_foreign');
            $table->renameColumn('parentCategory', 'parent_category_id');
            $table->foreign('parent_category_id')
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
        Schema::table('categories', function (Blueprint $table) {
            $table->dropForeign('categories_parent_category_id_foreign');
            $table->renameColumn('parent_category_id', 'parentCategory');
            $table->foreign('parentCategory')
                ->references('id')
                ->on('categories');
        });
    }

}
