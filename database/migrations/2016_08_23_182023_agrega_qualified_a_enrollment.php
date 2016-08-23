<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AgregaQualifiedAEnrollment extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up() {
       Schema::table('enrollments', function(Blueprint $table){
           $table->boolean('unqualified');           
       } );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('enrollments', function(Blueprint $table){
            $table->dropColumn('unqualified');
        });
    }
}
