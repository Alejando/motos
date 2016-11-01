<?php

use Illuminate\Database\Seeder;

class ProductsSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        //factory(DwSetpoint\Models\Brand::class,10)->create();
        $items = [
            [//1
                'name'=>'Nike - Banda para muñeca',
                'brand_id'=>'1',
                'description'=>'Absorción eficaz del sudor 
Las muñequeras Swoosh Wristbands (en pack de dos)de Nike son un complemento ideal para cualquier jugador de tenis. Se adaptan perfectamente a la muñeca gracias a su tejido, con un ajuste muy cómodo. El material con el que están fabricadas absorbe el incómodo sudor, permitiéndote centrarte solamente en el juego.

Deportivas y coloridas 
La muñequeras Swoosh Wristbands (en pack de dos)de Nike están disponibles en verde y lima y llevan el famoso logotipo de Nike, el Swoosh, bordado en un llamativo color en contraste. Son perfectas tanto para jugar con libertad, como para lucir a la última en la cancha, con un aspecto totalmente deportivo. 
',
                'multi_galeries'=>'0',
                'slug'=>  str_slug('Nike - Banda para muñeca'),
                'code'=>'010302090001',
                'serial_number'=>'0',
                'price_from'=>'169.00',
                'default_color_id'=>'8'
            ],[//2
                'name'=>'Nike - Featherlight 2.0 Visor para mujer',
                'brand_id'=>'2',
                'description'=>'"Comodidad, elasticidad y ligereza
La visera de tenis Nike Featherlight para mujer es ligera y elástica para ofrecer una comodidad total en las gradas, en la pista o en cualquier lugar bajo el sol.
Ventajas
Tecnología Dri-FIT que ayuda a mantenerte seco y cómodo
Diseño cómodo que ofrece una cobertura holgada
Ribete elástico que ofrece un ajuste cómodo"',
                'multi_galeries'=>'0',
                'slug'=> str_slug('Nike - Featherlight 2.0 Visor para mujer'),
                'code'=>'010102050001',
                'serial_number'=>'0',
                'price_from'=>'299.00',
                'default_color_id'=>'8'
            ],[//3
                'name'=>'Nike - Featherlight 2.0 Visor',
                'brand_id'=>'3',
                'description'=>'Comodidad, elasticidad y ligereza
La visera de tenis Nike Featherlight para mujer es ligera y elástica para ofrecer una comodidad total en las gradas, en la pista o en cualquier lugar bajo el sol.
Ventajas
Tecnología Dri-FIT que ayuda a mantenerte seco y cómodo
Diseño cómodo que ofrece una cobertura holgada
Ribete elástico que ofrece un ajuste cómodo',
                'multi_galeries'=>'0',
                'slug'=>str_slug('Nike - Featherlight 2.0 Visor'),
                'code'=>'010102050002',
                'serial_number'=>'0',
                'price_from'=>'299.00',
                'default_color_id'=>'10'
            ],[//4
                'name'=>'Adidas - Response Aspire STR W',
                'brand_id'=>'5',
                'description'=>'"Adidas - Response Aspire STR W
Enfrentá a tu rival con velocidad y estabilidad con estas sólidas zapatillas de alto rendimiento. Las Response Aspire STR para mujer presentan un diseño con perforaciones de ventilación en forma de las 3 Tiras en contraste, y suela resistente adiwear™ diseñada para todo tipo de superficies.
Detalles
Suave parte superior suave muy resistente al desgaste con revestimiento de PU para un rendimiento más duradero
Forro de malla transpirable
Parte superior perforada para una mayor ventilación
La suela con tecnología ADIWEAR™ ofrece la máxima resistencia en las zonas de mayor desgaste; suela de goma NON MARKING que protege la pista porque no deja marcas"',
                'multi_galeries'=>'0',
                'slug'=>'adidas-response-aspire-str-w',
                'code'=>'010101100001',
                'serial_number'=>'0',
                'price_from'=>'1099.00',
                'default_color_id'=>'9'
            ],[//5
                'name'=>'Nike - Air Courtballistec 4.1',
                'brand_id'=>'4',
                'description'=>'"Nike Air Courtballistec 4.1 Zapatillas para hombre: durabilidad y amortiguación mullida
Las zapatillas de tenis para hombre Nike Air Courtballistec 4.1 ofrecen una resistencia máxima sin sacrificar la comodidad. Las numerosas perforaciones aumentan el flujo de aire, mientras que la amortiguación Nike Air ofrece un ajuste cómodo que ayuda a absorber los impactos.
Detalles
Parte superior de piel sintética para una durabilidad ligera y una mayor comodidad.
Revestimiento moldeado en el empeine para una mayor durabilidad.
Unidad Nike Air en el talón para una amortiguación ligera.
Enfranque intermedio para una mayor sujeción y estabilidad durante los movimientos rápidos y cambios de dirección.
Surcos de flexión en la suela exterior para aportar flexibilidad y una mayor amplitud de movimiento.
La suela exterior se extiende sobre la parte superior para conseguir una mayor durabilidad.
Mediasuela de Phylon para aportar una amortiguación con poco peso.
Diseño que ofrece tracción sobre múltiples superficies para aportar versatilidad.
Incorpora tecnología Max Air
Amortiguación de máximo impacto. La brutal y repetitiva fuerza descendente que se ejerce al realizar deporte puede causar estragos en el cuerpo, y en el rendimiento. El sistema de amortiguación Max Air está especialmente diseñado para soportar estos impactos y proporcionar protección. Max Air es aire a lo grande, preparado para soportar cualquier paliza."',
                'multi_galeries'=>'0',
                'slug'=>  str_slug('Nike - Air Courtballistec 4.1'),
                'code'=>'010202100001',
                'serial_number'=>'0',
                'price_from'=>'1699.00',
                'default_color_id'=>'9'
            ],[//6
                'name'=>'Adidas - Uncontrol Climachill Polo Shirt',
                'brand_id'=>'6',
                'description'=>'"Baja la temperatura corporal y eleva tu nivel de rendimiento
Este polo de tenis para hombre está pensado para los jugadores que rematan cada punto subiendo a la red. Se ha confeccionado en un tejido de malla transpirable que incorpora la tecnología climachill™ con microesferas de aluminio que te ofrecen un increíble efecto frescor durante todo el partido.
Detalles
La tecnología climachill™ ayuda a bajar la temperatura corporal para que suba tu nivel de rendimiento gracias a su tejido similar a la malla con microesferas de aluminio que expulsan el calor del cuerpo
Cuello de polo con cuatro botones
Mangas con ribete
Corte holgado"',
                'multi_galeries'=>'0',
                'slug'=> str_slug('Adidas - Uncontrol Climachill Polo Shirt'),
                'code'=>'010201040001',
                'serial_number'=>'0',
                'price_from'=>'799.00',
                'default_color_id'=>'7'
            ]
        ];
        $colors = DwSetpoint\Models\Color::getAll();
        foreach($items as $item) {
            $item['slug'] = uniqid();
            $item['code'] = uniqid();
            $product = DwSetpoint\Models\Product::create($item);
            DwSetpoint\Models\Color::getRandom();
            $product->makeImgPath();
            $path = $product->getImgPath();
            if(rand(0,2000) > 1000) {
                $nColors = rand(0, $colors->count()-1);
                $productsColor = DwSetpoint\Models\Color::getRandom($nColors);            
                foreach($productsColor as $c){
                        $product->colors()->attach($c);
                        $nImgs = rand(0, 9);
                        for($i=0; $i < $nImgs; $i++) {
                            $img = file_get_contents('https://dummyimage.com/1024x1024/'
                                   .(str_replace('#', "", $c->rgb)).'/002B53,jpg?text=' . "0$i - . {$c->name}");
                            file_put_contents($path. "{$c->pref} - 0$i - {$product->slug}.jpg", $img);
                        }
                }
                $product->multi_galeries = $product->colors()->count() > 0;
            } else {
                $img = file_get_contents('https://dummyimage.com/1024x1024/ECECEC/002B53,jpg?text=' . "0$i");
                            file_put_contents($path. "{$c->pref} - 0$i - {$product->slug}.jpg", $img);
            }
            $sizes = DwSetpoint\Models\Size::getAll();
            if(rand(0, 2000) > 1000) {//Agregar tallas
                $nSizes = rand(0, $sizes->count()-1);
                $sizes = DwSetpoint\Models\Size::getRandom($nSizes);
                foreach ($sizes as  $size) {
                    $product->sizes()->attach($size);
                }
            }
        }
    }

}
