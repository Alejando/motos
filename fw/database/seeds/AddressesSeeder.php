<?php

use Illuminate\Database\Seeder;

class AddressesSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        //factory(DwSetpoint\Models\Brand::class,10)->create();
        $items = [
            [//1
                'street'=>'Justo Sierra',
                'street_number'=>'2579',
                'suite_number'=>'B',
                'neighborhood'=>'Ladron de guevara',
                'postal_code'=>'44600',
                'city'=>'Guadalajara',
                'instructions'=>'Porton Azul',
                'user_id'=>3,
                'country_id'=>1,
                'state_id'=>14
            ],[//2
                'street'=>'Ignacio Vallarta',
                'street_number'=>'3329',
                'suite_number'=>'Z',
                'neighborhood'=>'Arcos',
                'postal_code'=>'44601',
                'city'=>'Guadalajara',
                'instructions'=>'Piso 4',
                'user_id'=>5,
                'country_id'=>1,
                'state_id'=>14
            ]
        ];
        foreach($items as $item){
            DwSetpoint\Models\Address::create($item);
        }
    }

}