<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
class AddSlugToCategoriesTbl extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table("categories", function(Blueprint $table) {
            $table->string('slug');            
        });
        \DwSetpoint\Models\Category::each(function($item){
            $item->slug = str_slug($item->name);
            $item->save();
        });
    }

//
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table("categories", function(Blueprint $table) {
            $table->dropColumn('slug');
        });
    }

}
