<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsPostCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts_post_categories', function (Blueprint $table) {
            $table->integer('post_id')->unsigned();
            $table->foreign('post_id')
                ->references('id')
                ->on('posts')
                ->onDelete('cascade');
            $table->integer('post_category_id')->unsigned();
            $table->foreign('post_category_id')
                ->references('id')
                ->on('post_categories')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts_post_categories', function(Blueprint $table){
            $table->dropForeign('posts_post_categories_post_id_foreign');
        });
        Schema::table('posts_post_categories', function(Blueprint $table){
            $table->dropForeign('posts_post_categories_post_category_id_foreign');
        });
        Schema::drop('posts_post_categories');
    }
}
