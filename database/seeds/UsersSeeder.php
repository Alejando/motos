<?php

use Illuminate\Database\Seeder;

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
            'email'      => 'ohernandez@estrasol.com.mx',
            'password'   =>  Hash::make('secret')
        ]);
        factory(DwSetpoint\Models\User::class,10)->create();
    }

}
