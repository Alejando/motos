<?php

use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $items = [
            ['Bolsas', []],
            ['Cinturones', []],
            ['Joyería', ['Aretes/Pulseras']],
            ['Tarjeteros', []],
            ['Billeteras', []],
            ['Lentes de sol', []],
            ['Carteras', []],
            ['Textiles', ['Corbatas', 'Corbatas/Pañuelos/Mancuernas']]
        ];
        foreach ($items as $item) {
            $parent = \GlimGlam\Models\Category::create([
                        'name' => $item[0]
            ]);
            foreach ($item[1] as $i) {
                \GlimGlam\Models\Category::create([
                    'name' => $i,
                    'parentCategory' => $parent->id
                ]);
            }
        }





//        factory(\GlimGlam\Models\Category::class, 5)
//            ->create()
//            ->each(function($category){
//                factory(\GlimGlam\Models\Category::class, rand(3, 5))
//                    ->create([
//                    'parentCategory' => $category->id
//                ]);
//            });
    }

}
