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
            ['name' => 'Motos','slug'=>'motos', 'subs' => [
                ['name' => 'Motocross'],
                ['name' => 'Enduro'],
                ['name' => 'Freeride'],
                ['name' => 'Travel'],
                ['name' => 'Naked'],
                ['name' => 'Supersport'],
                ['name' => 'Semminuevas']
            ]],
            ['name'=> 'Boutique','slug'=>'boutique','subs'=> [
                ['name' => 'Poweparts'],
                ['name' => 'Powerwear']
                ]
            ]
        ];
        $this->createCategories($defualtCategories);
    }
    public function createCategories($categories, $parent = false) {
        foreach($categories as $i => $item) {
            $data = [
                'name' => $item['name'],
                'slug' => $item['slug']

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
