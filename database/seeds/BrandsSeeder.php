<?php

use Illuminate\Database\Seeder;

class BrandsSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        factory(DwSetpoint\Models\Brand::class,10)->create();
    }

}
