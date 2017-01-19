<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDiscountItems extends Migration
{
    public function up() {
        Schema::table('orders', function(Blueprint $table) {
            $table->decimal('discount');
        });
    }
    
    public function down() {
       Schema::table('orders', function(Blueprint $table) {
            $table->dropColumn('discount');
        });
    }
}
