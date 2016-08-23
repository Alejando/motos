<?php

use Illuminate\Database\Seeder;

class AuctionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    
    //Genero: 1 hombre, 0 mujer
    public function run() {
        /*
         * //Definición de time zone y UTC
         * $tzMx = new DateTimeZone('America/Mexico_City');
         * $utc = new DateTimeZone('UTC');
         * $date = new DateTime('2016-07-19 15:01:19', $tzMx);
         * //echo $date->format('Y-m-d H:i:s');
         * //echo "\n";
         * $date->setTimezone($utc);
         * //echo $date->format('Y-m-d H:i:s');
         * (new DateTime('2016-07-19T15:01:19+0000'))->format('Y-m-d H:i:s');
         * $dates = [];
         */
        $items = [
            [//1
                'category'=>  GlimGlam\Models\Category::getByName('Bolsas')->id,
                'sub_category'=>null,
                'target'=>0,
                'code'=>'SUB001',
                'barcode'=>'',
                'title'=>'Coach - Bolsa TEA coleción 1941',
                'real_price'=>14000.01,
                'cover'=>646.00,
                'min_offer'=>5.08,
                'max_offer'=>5.70,
                'bids'=>18,
                'min_bids'=>12,
                'max_price'=>2975.24,
                'user_quota'=>30,
                'users_limit'=>100,
                'delay'=>15,
                'max_user_quiet'=>2,
                'death_time'=>0,
                'description'=>'Bolsa artesanal de piel con adorno de flores en cuero colocados a mano sobre una pequeña silueta. 
Correa de cadena tejida a través de una cinta delgada de cuero. Monedero Francés en el interior.
Color: Negro/Latón antiguo
Forro: Cuero
Medidas: 22.86x14x5.70 cm.
Correa : 56 cm.',
                'start_date'=>'2016-08-25 00:00:00',
                'end_date'=>'2016-08-26 00:00:00',
                'ready'=>1,
                'status'=>  GlimGlam\Models\Auction::STATUS_STAND_BY
            ],[//2
                'category'=>GlimGlam\Models\Category::getByName('Cinturones')->id,
                'sub_category'=>null,
                'target'=>1,
                'code'=>'SUB002',
                'barcode'=>'679311',
                'title'=>'Ferragamo - Cinturón con hebilla de doble Gancini',
                'real_price'=>5399.80,
                'cover'=>249.00,
                'min_offer'=>1.96,
                'max_offer'=>2.20,
                'bids'=>18,
                'min_bids'=>12,
                'max_price'=>1147.55,
                'user_quota'=>30,
                'users_limit'=>100,
                'delay'=>15,
                'max_user_quiet'=>2,
                'death_time'=>0,
                'description'=>'Cinturón en piel de becerro con grano, reversible, con una hebilla de doble Gancini en gris plomo. 
Es un cinturón ajustable y se puede cortar a medida para un ajuste personalizado.
Hecho en Italia',
                'start_date'=>'2016-09-19 00:00:00',
                'end_date'=>'2016-10-12 00:00:00',
                'ready'=>1,
                'status'=>  GlimGlam\Models\Auction::STATUS_STAND_BY
            ],[//3
                'category'=>GlimGlam\Models\Category::getByName('Joyería')->id,
                'sub_category'=>null,
                'target'=>0,
                'code'=>'SUB003',
                'barcode'=>'',
                'title'=>'Ferragamo - Juego de aretes y pulsera de Gancino',
                'real_price'=>5445.04,
                'cover'=>251.00,
                'min_offer'=>1.98,
                'max_offer'=>2.22,
                'bids'=>18,
                'min_bids'=>12,
                'max_price'=>1157.17,
                'user_quota'=>30,
                'users_limit'=>100,
                'delay'=>15,
                'max_user_quiet'=>2,
                'death_time'=>0,
                'description'=>'Aretes de Gancino en Latón y Pulsera reversible con Gancino en color Negro/Camel.
Hecho en Italia',
                'start_date'=>'2016-10-01 00:00:00',
                'end_date'=>'2016-10-10 00:00:00',
                'ready'=>1,
                'status'=>  GlimGlam\Models\Auction::STATUS_STAND_BY
            ],[//2 - 1
                'category'=>GlimGlam\Models\Category::getByName('Bolsas')->id,
                'sub_category'=>null,
                'target'=>0,
                'code'=>'SUB004',
                'barcode'=>'',
                'title'=>'Tous - Bolsa bandolera Rene',
                'real_price'=>3199.9992,
                'cover'=>148.00,
                'min_offer'=>1.16,
                'max_offer'=>1.30,
                'bids'=>18,
                'min_bids'=>12,
                'max_price'=>680.06,
                'user_quota'=>30,
                'users_limit'=>100,
                'delay'=>15,
                'max_user_quiet'=>2,
                'death_time'=>0,
                'description'=>'Bolsa de piel color azul. 
Cierre con botón imantado.
Asa de cadena bandolera.
Medidas: 17x23x7.5cm.',
                'start_date'=>'2016-09-20 15:01:19',
                'end_date'=>'2016-09-25 04:00:04',
                'ready'=>1,
                'status'=>  GlimGlam\Models\Auction::STATUS_STAND_BY
            ],[//2 - 2
                'category'=>GlimGlam\Models\Category::getByName('Joyería')->id,
                'sub_category'=>GlimGlam\Models\Category::getByName('Aretes/Pulseras')->id,
                'target'=>1,
                'code'=>'SUB005',
                'barcode'=>'',
                'title'=>'Carolina Herrera - Juego de aretes y pulsera',
                'real_price'=>6100.44,
                'cover'=>282.00,
                'min_offer'=>2.21,
                'max_offer'=>2.48,
                'bids'=>18,
                'min_bids'=>12,
                'max_price'=>1296.45,
                'user_quota'=>30,
                'users_limit'=>100,
                'delay'=>15,
                'max_user_quiet'=>2,
                'death_time'=>0,
                'description'=>'Juego de Aretes y pulsera CH de latón bañado en oro, color dorado.',
                'start_date'=>'2016-10-19 00:00:00',
                'end_date'=>'2016-10-25 00:00:00',
                'ready'=>1,
                'status'=>  GlimGlam\Models\Auction::STATUS_STAND_BY
            ],[//2 - 3
                'category'=>GlimGlam\Models\Category::getByName('Tarjeteros')->id,
                'sub_category'=>null,
                'target'=>1,
                'code'=>'SUB006',
                'barcode'=>'1000187316016',
                'title'=>'Zegna - Tarjetero en piel negro',
                'real_price'=>3600.00,
                'cover'=>166.00,
                'min_offer'=>1.31,
                'max_offer'=>1.47,
                'bids'=>18,
                'min_bids'=>12,
                'max_price'=>765.06,
                'user_quota'=>30,
                'users_limit'=>100,
                'delay'=>15,
                'max_user_quiet'=>2,
                'death_time'=>0,
                'description'=>'Tarjetero metálico con forro sintético y cobertura en piel negra',
                'start_date'=>'2016-11-01 00:00:00',
                'end_date'=>'2016-11-11 00:00:00',
                'ready'=>1,
                'status'=>  GlimGlam\Models\Auction::STATUS_STAND_BY
            ],[//3 - 1
                'category'=>GlimGlam\Models\Category::getByName('Carteras')->id,
                'sub_category'=>null,
                'target'=>0,
                'code'=>'SUB007',
                'barcode'=>'39928941',
                'title'=>'Burberry - Cartera House Check',
                'real_price'=>8590.00,
                'cover'=>397.00,
                'min_offer'=>3.12,
                'max_offer'=>3.50,
                'bids'=>18,
                'min_bids'=>12,
                'max_price'=>1825.52,
                'user_quota'=>30,
                'users_limit'=>100,
                'delay'=>15,
                'max_user_quiet'=>2,
                'death_time'=>0,
                'description'=>'Cartera en piel granulada (House check), diseño clásico. 100 % algodón con piel de becerro y forro interior 100 % poliamida. Cierre de boton de presión.
Medidas: 19x4x10cm.',
                'start_date'=>'2016-08-25 15:01:19',
                'end_date'=>'2016-08-30 04:00:04',
                'ready'=>1,
                'status'=>  GlimGlam\Models\Auction::STATUS_STAND_BY
            ],[//3 - 2
                'category'=>GlimGlam\Models\Category::getByName('Billeteras')->id,
                'sub_category'=>null,
                'target'=>1,
                'code'=>'SUB008',
                'barcode'=>'807181158',
                'title'=>'Gucci - Billetera piel negra',
                'real_price'=>5900.00,
                'cover'=>272.00,
                'min_offer'=>2.14,
                'max_offer'=>2.40,
                'bids'=>18,
                'min_bids'=>12,
                'max_price'=>1253.85,
                'user_quota'=>30,
                'users_limit'=>100,
                'delay'=>15,
                'max_user_quiet'=>2,
                'death_time'=>0,
                'description'=>'Billetera de piel con etiqueta Gucci en relieve y detalle de tribanda verde/rojo/verde. De piel de becerro estampada, de apariencia texturada.
Medidas: 11x9 cm
Hecho en Italia',
                'start_date'=>'2016-09-03 00:00:00',
                'end_date'=>'2016-09-11 00:00:00',
                'ready'=>1,
                'status'=>  GlimGlam\Models\Auction::STATUS_STAND_BY
            ],[//3 - 3
                'category'=>GlimGlam\Models\Category::getByName('Lentes de sol')->id,
                'sub_category'=>null,
                'target'=>0,
                'code'=>'SUB009',
                'barcode'=>'',
                'title'=>'Fendi - Lentes de sol Orquídea ojo de gato',
                'real_price'=>5500.00,
                'cover'=>254.00,
                'min_offer'=>2.00,
                'max_offer'=>2.24,
                'bids'=>18,
                'min_bids'=>12,
                'max_price'=>1168.85,
                'user_quota'=>30,
                'users_limit'=>100,
                'delay'=>15,
                'max_user_quiet'=>2,
                'death_time'=>0,
                'description'=>'Lentes ojo de gato, montura de acetato negro y puntas de color verde claro.
Hecho en Italia',
                'start_date'=>'2016-10-04 00:00:00',
                'end_date'=>'2016-10-15 00:00:00',
                'ready'=>1,
                'status'=>  GlimGlam\Models\Auction::STATUS_STAND_BY
            ],[//4 - 1
                'category'=>GlimGlam\Models\Category::getByName('Textiles')->id,
                'sub_category'=>GlimGlam\Models\Category::getByName('Corbatas')->id,
                'target'=>1,
                'code'=>'SUB010',
                'barcode'=>'',
                'title'=>'Thomas Pink - Juego corbata y tirantes',
                'real_price'=>5880.04,
                'cover'=>271.00,
                'min_offer'=>2.13,
                'max_offer'=>2.39,
                'bids'=>18,
                'min_bids'=>12,
                'max_price'=>1249.61,
                'user_quota'=>30,
                'users_limit'=>100,
                'delay'=>15,
                'max_user_quiet'=>2,
                'death_time'=>0,
                'description'=>'Corbata delgada corte moderno, 100% seda. 
Medida: 145x6.5 cm.
Tirantes elásticos negros de 3.80 cm de ancho y cierre de clip. Ajustables.
Hecho en Reino Unido',
                'start_date'=>'2016-09-24 15:01:19',
                'end_date'=>'2016-09-25 04:00:04',
                'ready'=>1,
                'status'=>  GlimGlam\Models\Auction::STATUS_STAND_BY
            ],[//4 - 2
                'category'=>GlimGlam\Models\Category::getByName('Lentes de sol')->id,
                'sub_category'=>null,
                'target'=>1,
                'code'=>'SUB011',
                'barcode'=>'Boss 0777s',
                'title'=>'Hugo Boss - Lentes de sol',
                'real_price'=>4399.98,
                'cover'=>203.00,
                'min_offer'=>1.60,
                'max_offer'=>1.79,
                'bids'=>18,
                'min_bids'=>12,
                'max_price'=>935.07,
                'user_quota'=>30,
                'users_limit'=>100,
                'delay'=>15,
                'max_user_quiet'=>2,
                'death_time'=>0,
                'description'=>'Lentes de sol en azul oscuro con montura integral redondeada y patillas de madera. Cristales de tono marrón.',
                'start_date'=>'2016-10-17 00:00:00',
                'end_date'=>'2016-10-19 00:00:00',
                'ready'=>1,
                'status'=>  GlimGlam\Models\Auction::STATUS_STAND_BY
            ],[//4 - 3
                'category'=>GlimGlam\Models\Category::getByName('Textiles')->id,
                'sub_category'=>GlimGlam\Models\Category::getByName('Corbatas/Pañuelos/Mancuernas')->id,
                'target'=>1,
                'code'=>'SUB012',
                'barcode'=>'',
                'title'=>'Hugo Boss - Juego Corbata, pañuelo y gemelos',
                'real_price'=>4470.64,
                'cover'=>207.00,
                'min_offer'=>1.62,
                'max_offer'=>1.82,
                'bids'=>18,
                'min_bids'=>12,
                'max_price'=>950.09,
                'user_quota'=>30,
                'users_limit'=>100,
                'delay'=>15,
                'max_user_quiet'=>2,
                'death_time'=>0,
                'description'=>'Corbata de cachemir en tonos azules brillantes, con 7.5 cm de ancho.
Pañuelo cuadrado 33x33 cm estampado en seda.
Gemelos de latón color plata con apliques color azul oscuros.',
                'start_date'=>'2016-11-11 00:00:00',
                'end_date'=>'2016-11-13 00:00:00',
                'ready'=>1,
                'status'=>  GlimGlam\Models\Auction::STATUS_STAND_BY
            ]
        ];
        
        foreach($items as $item){
            \GlimGlam\Models\Auction::create($item);
        }
    }

}
