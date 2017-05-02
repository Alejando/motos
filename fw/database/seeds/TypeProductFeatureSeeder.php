<?php

use Illuminate\Database\Seeder;

class TypeProductFeatureSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        //factory(DwSetpoint\Models\Brand::class,10)->create();
        $items = [
            [//1
                'name'=>'Principales',
            ],
             [//1
                'name'=>'Chasis',
            ],
             [//1
                'name'=>'Motor',
            ],
             [//1
                'name'=>'Carroceria',
            ],
             [//1
                'name'=>'Suspención',
            ]

        ];
        
        foreach($items as $item) {
            DwSetpoint\Models\TypeProductFeature::create($item);
            
        }
    }

}
