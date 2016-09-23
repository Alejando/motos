<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNextPenaltyToAction extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::table('enrollments', function(Blueprint $table) {
            $table->dateTime("next_penalty");
        }); 
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::table('enrollments', function(Blueprint $table) {
            $table->dropColumn("next_penalty");
        });
    }
}
