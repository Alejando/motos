<?php

use Illuminate\Database\Seeder;

class PostalCodesSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        //factory(DwSetpoint\Models\Brand::class,10)->create();
        $items = [
            [//
                'code'=> 44600,
                'postal_code_group_id'=> 1
            ],
            [//1
                'code'=> 14970,
                'postal_code_group_id'=> 1
            ],
            [//1
                'code'=> 77960,
                'postal_code_group_id'=> 1
            ],
            [//1
                'code'=> 44790,
                'postal_code_group_id'=> 1
            ],
            [//1
                'code'=> 44399,
                'postal_code_group_id'=> 1
            ],
            [//1
                'code'=> 44980,
                'postal_code_group_id'=> 1
            ]
        ];
        foreach($items as $item){
            DwSetpoint\Models\PostalCode::create($item);
        }
    }

}