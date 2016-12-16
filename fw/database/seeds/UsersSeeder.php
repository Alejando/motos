<?php

use Illuminate\Database\Seeder;
use DwSetpoint\Models\User;

class UsersSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
//        $this->call(DwSetpoint\Models\Brand::class);
        User::create([
            'name' => 'Admin',
            'email'      => 'admin@setpoint.com.mx',
            'password'   =>  'secret'
        ]);
        User::create([
            'name' => 'Admin 2',
            'email'      => 'admin2@setpoint.com.mx',
            'password'   => 'secret'
        ]);
        User::create([
            'name' => 'Admin Estrasol',
            'email'      => 'dev.administrador@estrasol.com.mx',
            'password'   => 'secret'
        ]);
        factory(DwSetpoint\Models\User::class,10)->create();
    }

}
