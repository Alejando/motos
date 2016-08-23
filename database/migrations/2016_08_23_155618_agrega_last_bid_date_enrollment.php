<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AgregaLastBidDateEnrollment extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
       Schema::table('enrollments', function(Blueprint $table){
           $table->dateTime('last_bid_date');
       } );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('enrollments', function(Blueprint $table){
            $table->dropColumn('last_bid_date');
        });
    }

}
