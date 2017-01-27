<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use DwSetpoint\Models\User;
class CreateUsersDefault extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        \DwSetpoint\Models\Profile::create([
            'id' => 1,
            'profile' => 'Administrador',
            'code' => 'ADMIN'
        ]);
        \DwSetpoint\Models\Profile::create([
            'id' => 2,
            'profile' => 'Cliente',
            'code' => 'CLIENT'
        ]);
        User::create([
            'name' => 'Admin',
            'email'      => 'admin@setpoint.com.mx',
            'password'   =>  'secret',
            'profile_id' => 1
        ]);
        User::create([
            'name' => 'Admin Estrasol',
            'email'      => 'admin.dev@estrasol.com.mx',
            'password'   => 'secret',
            'profile_id' => 1
        ]);
        User::create([
            'name' => 'Cliente Estrasol',
            'email'      => 'cliente.dev@estrasol.com.mx',
            'password'   => 'secret',
            'profile_id' => 2
        ]);
    }

    public function down() {

    }
}
