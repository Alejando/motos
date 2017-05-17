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
                ['name' => 'Motocross','slug'=>''],
                ['name' => 'Enduro','slug'=>''],
                ['name' => 'Freeride','slug'=>''],
                ['name' => 'Travel','slug'=>''],
                ['name' => 'Naked','slug'=>''],
                ['name' => 'Supersport','slug'=>''],
                ['name' => 'Semminuevas','slug'=>'']
            ]],
            ['name'=> 'Boutique','slug'=>'boutique','subs'=> [
                ['name' => 'Poweparts','slug'=>''],
                ['name' => 'Powerwear','slug'=>'']
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
