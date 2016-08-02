<?php

use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        
        factory(\GlimGlam\Models\Category::class, 5)
            ->create()
            ->each(function($category){
                factory(\GlimGlam\Models\Category::class, rand(3, 5))
                    ->create([
                    'parentCategory' => $category->id
                ]);
            });
    }

}
