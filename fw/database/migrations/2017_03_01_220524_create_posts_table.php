<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seos', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('description');
            $table->string('keywords');
            $table->string('robots');
            $table->string('title');
            $table->timestamps();
        });

        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('title');
            $table->longText('body');
            $table->string('slug');
            $table->boolean('favorite');
            $table->timestamps();
            $table->integer('seo_id')->unsigned()->nullable();
            $table->foreign('seo_id')
                ->references('id')
                ->on('seos')
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
        Schema::table('posts', function(Blueprint $table){
            $table->dropForeign('posts_seo_id_foreign');
        });
        Schema::drop('seos');

        Schema::drop('posts');
    }
}
