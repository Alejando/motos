<?php

use Illuminate\Database\Migrations\Migration;

class AgregaCampoPerfilAUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
       Schema::table('users', function($table){
           $table->integer('profile');
       });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('users', function($table){
            $table->dropColumn('profile');
        });
    }
}
