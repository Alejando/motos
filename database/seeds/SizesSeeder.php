<?php

use Illuminate\Database\Seeder;

class SizesSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
//        $this->call(DwSetpoint\Models\Brand::class);
        factory(DwSetpoint\Models\Size::class,10)->create();
    }

}
