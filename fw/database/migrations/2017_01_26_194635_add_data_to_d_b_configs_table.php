<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDataToDBConfigsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       
            DB::table('d_b_configs')
                ->insert([
                            [
                            'code' => 'tel-whatsapp',
                            'name' => 'Whatsapp',
                            'value' => '34-543-35-445',
                            'type' => 'string'
                            ]
                        ]);
 
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('d_b_configs', function (Blueprint $table) {
            //
        });
    }
}
