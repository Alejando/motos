<?php

use Illuminate\Database\Seeder;

class PostCategoriesSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        //factory(DwSetpoint\Models\Brand::class,10)->create();
        $items = [
            [//1
                'name'=>'Actualidad',
            ],
            [//1
                'name'=>'Motos',
            ],
            [//1
                'name'=>'Evento',
            ],
            [//1
                'name'=>'Cultura',
            ],
            [//1
                'name'=>'Travel',
            ]

        ];

        foreach($items as $item) {
            $brand = DwSetpoint\Models\PostCategory::create($item);

        }
    }

}
