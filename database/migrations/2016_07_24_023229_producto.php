<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Producto extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('photo');
            $table->integer('brand_id')->unsigned()->nullable();
            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade');
        });
        Schema::create('products_colors', function (Blueprint $table){
            $table->integer('color_id')->unsigned()->nullable();
            $table->foreign('color_id')->references('id')->on('colors')->onDelete('cascade');
            $table->integer('products_id')->unsigned()->nullable();
            $table->foreign('products_id')->references('id')->on('products')->onDelete('cascade');
        });
        Schema::create('products_sizes', function(Blueprint $table){
            $table->integer('size_id')->unsigned()->nullable();
            $table->integer('products_id')->unsigned()->nullable();
            $table->foreign('size_id')->references('id')->on('sizes')->onDelete('cascade');
            $table->foreign('products_id')->references('id')->on('products')->onDelete('cascade');
        });
        Schema::create('products_categories', function(Blueprint $table){
            $table->integer('categories_id')->unsigned()->nullable();
            $table->integer('products_id')->unsigned()->nullable();
            $table->foreign('categories_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('products_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {

        Schema::table('products', function(Blueprint $table){
            $table->dropForeign('products_brand_id_foreign');
        });
        Schema::table('products_colors', function(Blueprint $table){
            $table->dropForeign('products_colors_products_id_foreign');
            $table->dropForeign('products_colors_color_id_foreign');
        });
        Schema::table('products_categories', function(Blueprint $table){
            $table->dropForeign('category_product_categories_id_foreign');
            $table->dropForeign('category_product_products_id_foreign');
        });
        Schema::table('products_sizes', function(Blueprint $table){
            $table->dropForeign('products_sizes_products_id_foreign');
            $table->dropForeign('products_sizes_size_id_foreign');
        });
        Schema::drop('products_sizes');
        Schema::drop('products_categories');
        Schema::drop('products_colors');        
        Schema::drop('products');
    }
}
