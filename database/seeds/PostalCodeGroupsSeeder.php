<?php

use Illuminate\Database\Seeder;

class PostalCodeGroupsSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        //factory(DwSetpoint\Models\Brand::class,10)->create();
        $items = [
            [//1
            	'id'=> 1,
                'name'=> 'ZMG'
            ]
        ];
        foreach($items as $item){
            DwSetpoint\Models\PostalCodeGroup::create($item);
        }
    }

}