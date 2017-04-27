<?php

use Illuminate\Database\Seeder;

class BrandsSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        //factory(DwSetpoint\Models\Brand::class,10)->create();
        $items = [
            [//1
                'name'=>'KTM',
                'brand_code'=>'KTM'
            ]
        ];
        
        foreach($items as $item) {
            $brand = DwSetpoint\Models\Brand::create($item);
            
        }
    }

}
