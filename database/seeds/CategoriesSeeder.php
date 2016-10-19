<?php

use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $defualtCategories = [
            ['name'=> 'Damas', 'subs'=> [
                    ['name' => 'Marcas', 'subs' => [
                        ['name' => 'Nike'],
                        ['name' => 'Adidas'],
                        ['name' => 'Wilson']
                    ]],
                    ['name' => 'Ropa', 'subs' => [
                            ['name' => 'Blusas'],
                            ['name' => 'Chamarras'],
                            ['name' => 'Faldas'],
                            ['name' => 'Gorras'],
                            ['name' => 'Ropa interior'],
                            ['name' => 'Short'],
                            ['name' => 'Vestidos']
                        ]
                    ]
                ]
            ],
            ['name'=> 'Caballeros'],
            ['name'=> 'Zapatos'],
            ['name'=> 'Raquetas'],
            ['name'=> 'Bolsas'],
            ['name'=> 'Pelotas']
        ];
        $this->createCategories($defualtCategories);
    }
    public function createCategories($categories, $parent = false) {
        foreach($categories as $i => $item) {
            $data = [
                'name' => $item['name']
            ];
            if($parent) {
                $data['parent_category_id'] = $parent->id;
            }
            $category = DwSetpoint\Models\Category::create($data);
            if(isset($item['subs'])) {
                $this->createCategories($item['subs'],  $category);
            }
        }
    }

}
