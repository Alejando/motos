<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $this->call(BrandsSeeder::class);
        $this->call(ProfilesSeeder::class);
        $this->call(UsersSeeder::class);
        $this->call(CategoriesSeeder::class);
        $this->call(ProductTypesSeeder::class);
        $this->call(ProductsSeeder::class);
        $this->call(SlidersSeeder::class);
        $this->call(SliderItemsSeeder::class);
        $this->call(TypeProductFeatureSeeder::class);
        $this->call(ProductFeatureSeeder::class);
        $this->call(PostCategoriesSeeder::class);
        $this->call(PostSeeder::class);
        $this->call(BoutiqueSeeder::class);

    }

}
