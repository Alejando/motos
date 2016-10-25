<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSlugToProduct extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('products', function (Blueprint $table) {
            $table->string('slug');
        });
        Schema::table('products', function (Blueprint $table) {
            DwSetpoint\Models\Product::get()->each(function($product) {
                $product->slug = str_slug($product->name);
                $product->save();
            });
            $table->string('slug')
                ->unique()
                ->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
    }

}
