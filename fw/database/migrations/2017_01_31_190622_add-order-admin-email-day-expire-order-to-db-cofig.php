<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddOrderAdminEmailDayExpireOrderToDbCofig extends Migration
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
                            'code' => 'order-email',
                            'name' => 'Email ordenes',
                            'value' => 'jdiaz@estrasol.com.mx',
                            'type' => 'email'
                        ], [
                            'code' => 'days-to-expire-order',
                            'name' => 'Días para expirar una orden',
                            'value' => '3',
                            'type' => 'integer'
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
        //
    }
}
