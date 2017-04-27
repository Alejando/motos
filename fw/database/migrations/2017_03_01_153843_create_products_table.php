<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_types', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('name');
        });

        Schema::table('products', function (Blueprint $table) {
            $table->boolean('favorite')->default(false);
            $table->integer('type_id')->unsigned();
            $table->foreign('type_id')
                ->references('id')
                ->on('product_types')
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
        Schema::drop('product_types');
        
        Schema::table('products', function(Blueprint $table){
            $table->dropForeign('products_type_id_foreign');
        });

    }
}
