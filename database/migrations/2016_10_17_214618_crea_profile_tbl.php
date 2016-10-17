<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreaProfileTbl extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('profiles',function(Blueprint $table) {
            $table->increments('id');
            $table->string('profile',40);
        });
        Schema::table('users', function(Blueprint $table) {
            $table->renameColumn('profile', 'profile_id');
        });
        Schema::table('users', function(Blueprint $table) { 
            $table->integer('profile_id')->unsigned()->nullable()->change();
        });
        Schema::table('users', function(Blueprint $table) {
            $table->foreign('profile_id')
                ->references('id')
                ->on('profiles')
                ->onDelete('cascade')
            ;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('users', function(Blueprint $table){
            $table->dropForeign('users_profile_id_foreign');
        });
        Schema::table('users', function(Blueprint $table){
            $table->integer('profile_id')->change();
        });
        Schema::table('users', function(Blueprint $table) {
            $table->renameColumn('profile_id', 'profile');
        });
        Schema::drop('profiles');
    }

}
