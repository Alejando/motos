<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCpsElSalto extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {

            $arrCps = [
                '45680',
                '45680',
                '45683',
                '45686',
                '45687',
                '45690',
                '45692',
                '45696',
                '45685',
                '45693',
                '45694'
            ];
            // </editor-fold>
        $acp = [];
        foreach ($arrCps as $c) {
            $acp[]= [
                'code' => $c,
                'postal_code_group_id' => 1
            ];    
        }
        DB::table('postal_codes')
            ->insert($acp);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
