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
                'name'=>'Nike',
                'brand_code'=>'NNN04416OS'
            ],[//2
                'name'=>'Nike',
                'brand_code'=>'613967-010'
            ],[//3
                'name'=>'Nike',
                'brand_code'=>'613967-824'
            ],[//4
                'name'=>'Nike',
                'brand_code'=>'488144-105'
            ],[//5
                'name'=>'Addidas',
                'brand_code'=>'B40694'
            ],[//6
                'name'=>'Addidas',
                'brand_code'=>'S27226'
            ]
        ];
        foreach($items as $item){
            DwSetpoint\Models\Brand::create($item);
        }
    }

}
