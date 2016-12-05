<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class StocksSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        //factory(DwSetpoint\Models\Brand::class,10)->create();
        $items = [
            [//1
                'quantity'=>'3',
                'product_id'=>'1',
                'size_id'=>'1',
                'price'=>'169.00',
                'code'=>'010302090001',
                'codebar'=>'845840057995',
            ],[//2
                'quantity'=>'3',
                'product_id'=>'2',
                'size_id'=>'1',
                'price'=>'299.00',
                'code'=>'010102050001',
                'codebar'=>'676556495678',
            ],[//3
                'quantity'=>'3',
                'product_id'=>'3',
                'size_id'=>'1',
                'price'=>'299.00',
                'code'=>'010102050002',
                'codebar'=>'676556495791',
            ],[//4 - Response aspire STR w
                'quantity'=>'1',
                'product_id'=>'4',
                'size_id'=>'13',
                'price'=>'1099.00',
                'code'=>'010101100001',
                'codebar'=>'4055013991100',
            ],[//5
                'quantity'=>'2',
                'product_id'=>'4',
                'size_id'=>'14',
                'price'=>'1099.00',
                'code'=>'010101100001',
                'codebar'=>'4055013991230',
            ],[//6
                'quantity'=>'2',
                'product_id'=>'4',
                'size_id'=>'15',
                'price'=>'1099.00',
                'code'=>'010101100001',
                'codebar'=>'4055013991209',
            ],[//7
                'quantity'=>'2',
                'product_id'=>'4',
                'size_id'=>'16',
                'price'=>'1099.00',
                'code'=>'010101100001',
                'codebar'=>'4055013991148',
            ],[//8
                'quantity'=>'2',
                'product_id'=>'4',
                'size_id'=>'17',
                'price'=>'1099.00',
                'code'=>'010101100001',
                'codebar'=>'4055013991155',
            ],[//9
                'quantity'=>'2',
                'product_id'=>'4',
                'size_id'=>'18',
                'price'=>'1099.00',
                'code'=>'010101100001',
                'codebar'=>'4055013991131',
            ],[//10 - End of Response Aspire STR W
                'quantity'=>'1',
                'product_id'=>'4',
                'size_id'=>'19',
                'price'=>'1099.00',
                'code'=>'010101100001',
                'codebar'=>'4055013991216',
            ],[//10 - Air Courtballistec 4.1
                'quantity'=>'1',
                'product_id'=>'5',
                'size_id'=>'19',
                'price'=>'1699.00',
                'code'=>'010202100001',
                'codebar'=>'',
            ],[//11
                'quantity'=>'3',
                'product_id'=>'5',
                'size_id'=>'21',
                'price'=>'1699.00',
                'code'=>'010202100001',
                'codebar'=>'88691648324915',
            ],[//12
                'quantity'=>'1',
                'product_id'=>'5',
                'size_id'=>'23',
                'price'=>'1699.00',
                'code'=>'010202100001',
                'codebar'=>'88691648326315',
            ],[//13 - End of Air Courtballistec 4.1
                'quantity'=>'2',
                'product_id'=>'5',
                'size_id'=>'24',
                'price'=>'1699.00',
                'code'=>'010202100001',
                'codebar'=>'88691648327015',
            ],[//13 - Uncontrol Climachill Polo Shirt
                'quantity'=>'1',
                'product_id'=>'6',
                'size_id'=>'3',
                'price'=>'799.00',
                'code'=>'010201040001',
                'codebar'=>'4054714175024',
            ]
        ];

        $faker = Faker::create();
        for($i=0; $i<2000; $i++)
        { 
            $array_item = [
                'quantity'=>rand(1,9),
                'product_id'=>rand(1,56),
                'size_id'=>rand(1,25),
                'price'=>rand(100,1000),
                'code'=>$faker->ean8(),
                'codebar'=>$faker->ean13(),
            ];
            array_push($items, $array_item);
        }


        foreach($items as $item){
            DwSetpoint\Models\Stock::create($item);
        }
    }

}
