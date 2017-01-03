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
        $this->call(ColorsSeeder::class);
        $this->call(SizesSeeder::class);
        $this->call(ProfilesSeeder::class);
        $this->call(UsersSeeder::class);
        $this->call(StocksSeeder::class);
        $this->call(CategoriesSeeder::class);
        $this->call(AddressesSeeder::class);
        $this->call(PostalCodeGroupsSeeder::class);
        $this->call(PostalCodesSeeder::class);
        $this->call(CategoriesProductsSeeder::class);
        $this->call(ProductsSeeder::class);
        $this->call(ColorProductSeeder::class);
    }

}
