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
        $this->call(UsersSeeder::class);
        $this->call(ProductsSeeder::class);
        $this->call(ColorProductSeeder::class);
        $this->call(StocksSeeder::class);
    }

}
