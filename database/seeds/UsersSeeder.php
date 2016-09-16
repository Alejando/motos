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
        factory(DwSetpoint\Models\Brand::class,10)->create();
    }

}
