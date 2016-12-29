<?php

use Illuminate\Database\Seeder;

class ProfilesSeeder extends Seeder {
        /**
     * Run the database seeds.
     
     * @return void
     */
    public function run() {
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
    }
}
