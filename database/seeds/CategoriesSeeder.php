<?php

use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $defualtCategory = [
            ['name'=> 'Damas'],
            ['name'=> 'Caballeros'],
            ['name'=> 'Zapatos'],
            ['name'=> 'Raquetas'],
            ['name'=> 'Bolsas'],
            ['name'=> 'Pelotas'],
        ];
        foreach($defualtCategory as $item){
            DwSetpoint\Models\Category::create($item);
        }
    }

}
