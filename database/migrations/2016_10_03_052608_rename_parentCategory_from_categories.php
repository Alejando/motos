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
            $table->renameColumn('parentCategory', 'parent_category_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('categories', function (Blueprint $table) {
            $table->renameColumn('parent_category_id', 'parentCategory');
        });
    }

}
