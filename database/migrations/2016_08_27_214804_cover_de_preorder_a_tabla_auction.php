<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CoverDePreorderATablaAuction extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::table('auctions', function(Blueprint $table){
           $table->decimal('preorder_cover');           
       } );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::table('auctions', function(Blueprint $table){
            $table->dropColumn('preorder_cover');
        });
    }
}
