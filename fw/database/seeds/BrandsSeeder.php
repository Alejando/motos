<?php

use Illuminate\Database\Seeder;

class BrandsSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        //factory(DwSetpoint\Models\Brand::class,10)->create();
        $items = [
            [//1
                'name'=>'Nike',
                'brand_code'=>'NNN04416OS'
            ],[//2
                'name'=>'Puma',
                'brand_code'=>'613967-010'
            ],[//3
                'name'=>'Cleveland',
                'brand_code'=>'613967-824'
            ],[//4
                'name'=>'Spalding',
                'brand_code'=>'488144-105'
            ],[//5
                'name'=>'Bridgestone',
                'brand_code'=>'B40694'
            ],[//6
                'name'=>'Addidas',
                'brand_code'=>'S27226'
            ],[//7
                'name'=>'Wilson',
                'brand_code'=>'S27226'
            ],[//8
                'name'=>'Kings of tennis',
                'brand_code'=>'S27226'
            ],[//8
                'name'=>'Tenis Addvisor',
                'brand_code'=>'S27226'
            ]
        ];
        
        foreach($items as $item) {
            $brand = DwSetpoint\Models\Brand::create($item);
            $imgDefault = __DIR__ . "/../../resources/imgs-default/brands/{$brand->name}.png";
            if(file_exists($imgDefault)) {
                $img = file_get_contents($imgDefault);
            } else {
                $img = file_get_contents('https://dummyimage.com/1024x1024/ECECEC/002B53.png?text=' . $brand->name);
            }
            $fileName = Config('app.paths.brads') . "{$brand->id}.png";
            file_put_contents($fileName, $img);
            chmod($fileName, Config('app.permissionFiles'));
        }
    }

}
