<?php

/*--------------------INICIO RUTAS SETPOINT----------------------------------------------*/
Route::get('sitemap.xml', 'SiteMapCtrl@getXML');
Route::get("{msj}/holamundo/", "HomeController@holamundo");

Route::post('process/conekta/webhook/40949bfc19feaefa27b64737d28b3ea5aa49ca461f8ea08a1637c705e69fade4', [
    'as' => 'cart.success',
    'uses' => 'ConektaController@webhook'
]);

Route::get('/carrito/conekta-oxxo/order-{order}.{format}', [
    'as' => 'cart.conecta-oxxo-format',
    'uses' => 'ConektaController@getOxxoFormat'
]);

Route::get('/carrito/conekta-oxxo/order-{order}', [
    'as' => 'cart.conecta-oxxo',
    'uses' => 'ConektaController@oxxoConfirm'
]);

Route::get('carrito/success', [
    'as' => 'cart.success',
    'uses' => 'CartController@success'
]);
Route::get('/detalle', function() {
    return view('public.pages.detail', [
        'showOffert' => false,
        'showBannerBottom' => false
    ]);
});
Route::get('/carrito', [
    'as' => 'cart.list',
    'uses' => 'CartController@listItems'
]);

Route::get('/contacto', function() {
    return view('public.pages.contact', [
        'showOffert' => false,
        'showBannerBottom' => false
    ]);
});

Route::get('/carrito/envio', [
    'as'=> 'cart.shiping',
    'uses' => 'CartController@shippingForm'
]);
Route::get('/carrito/registro', [
    'as'=> 'cart.registration-form',
    'uses' => 'CartController@registrationForm'

]);
Route::get('/carrito/pago', [
    'as' => 'cart.confirmCheckout',
    'uses' =>  'CartController@confirmCheckout'
]);
Route::post('carrito/checkout', [
    'as' => 'cart.checkout',
    'uses' => 'CartController@checkout'
]);
Route::get('/marcas/{id}/logo', 'Api\\BrandController@getImg');

Route::get('/marcas/{id}/{slugSEO}logo-{width}x{heigth}.png', [
        'as' => 'brand.getLogo',
        'uses' => 'Api\\BrandController@fitToSize'
    ]
);

Route::get('/categorias/tree',[
    'as' => 'categories.tree',
    'uses' => 'Api\\CategoryController@tree'
]);

Route::group(['prefix'=>'dev'], function () {
    Route::get('cmd', function() {
        header("Content-type:text/plain");
        $r = \Artisan::call('migrate:refresh');
        echo Artisan::output();
        if($r==0){
            $r = \Artisan::call('db:seed');
        }
        echo Artisan::output();
    });
});
Route::group(['prefix' => 'api'], function () {
    $getNames = function ($name) {
        return [ 'names' => [
                'index'   => $name.'',
                'create'  => $name.'.create',
                'store'   => $name.'.store',
                'show'    => $name.'.show',
                'edit'    => $name.'.edit',
                'update'  => $name.'.update',
                'destroy' => $name.'.destroy'
            ]
        ];
    };
    $addAPI = function ($name, $controller){
                Route::get($name.'/all-for-datatables',[
                    'as' => $name.'.all-for-datatables',
                    'uses' => 'Api\\'.$controller.'Controller@getAllForDatatables'
                ]);
                Route::resource($name, "Api\\{$controller}Controller", [ 'names' => [
                        'index'   => $name.'',
                        'create'  => $name.'.create',
                        'store'   => $name.'.store',
                        'show'    => $name.'.show',
                        'edit'    => $name.'.edit',
                        'update'  => $name.'.update',
                        'destroy' => $name.'.destroy'
                    ]
                ]);
                Route::get($name.'/{id}/relation/{relation}',[
                    'as' => $name.'.relation',
                    'uses' => 'Api\\'.$controller.'Controller@relation']
                );
    };

    Route::get('content/slug/{slug}', [
        'as' => 'Content.slug',
        'uses' => 'Api\\ContentController@slug'
    ]);

    Route::put('content/update/', [
        'as' => 'Content.update',
        'uses' => 'Api\\ContentController@updateContent'
    ]);

    $addAPI('brand','Brand');
    Route::get('stock/get-stocks',[
        'as' => 'stock.getStocks',
        'uses' => 'Api\\StockController@getStocks'
    ]);
    Route::get('coupon/validate-code/{code}',[
        'as' => 'coupon.getValdateByCode',
        'uses' => 'Api\\CouponController@getValdateByCode'
    ]);
    $addAPI('stock','Stock');
    $addAPI('color','Color');
    $addAPI('size','Size');
    $addAPI('category','Category');
    $addAPI('product','Product');
    $addAPI('content','Content');
    $addAPI('coupon','Coupon');
    $addAPI('billingInformation','BillingInformation');
    //Catalogo de Paises, Estados, Direcciones
    $addAPI('country','Country');
    $addAPI('state','State');
    $addAPI('configuration','Configuration');

    Route::get('address/{address_id}/shipping-rules', [
        'as' => 'address.get-shipping-rules',
        'uses' => 'Api\\AddressController@getShippingRules'
    ]);
     $addAPI('address','Address');
    $addAPI('postalCode','PostalCode');
    $addAPI('order','Order');
    $addAPI('dbconfig','DBConfig');
    $addAPI('postalCodeGroup','PostalCodeGroup');
    Route::put('order/{order}/send',[
        'as' => 'order.send',
        'uses' => 'Api\\OrderController@send'
    ]);
    Route::put('order/{order}/cancel',[
        'as' => 'order.cancel',
        'uses' => 'Api\\OrderController@cancel'
    ]);
    Route::put('order/{order}/set-bill',[
        'as' => 'order.set-bill-number',
        'uses' => 'Api\\OrderController@setBillNumber'
    ]);
    Route::post('coupon/validate-code', [
        'as' => 'coupon.validateCode',
        'uses' => 'Api\\CouponController@validateCode'
    ]);

    Route::get('postalCode/by-group/{id}', [
        'as' => 'postalCode.by-group',
        'uses' => 'Api\\PostalCodeController@byCpGroup'
    ]);

    Route::post('postalCode/save-group', [
        'as' => 'postalCode.saveGroup',
        'uses' => 'Api\\PostalCodeController@saveGroup'
    ]);

    Route::post('user/validate-user', [
        'as' => 'user.validateUser',
        'uses' => 'Api\\UserController@validateUser'
    ]);

    Route::post('category/validate-category', [
        'as' => 'category.validateCategory',
        'uses' => 'Api\\CategoryController@validateCategory'
    ]);

    Route::post('brand/validate-brand', [
        'as' => 'brand.validateBrand',
        'uses' => 'Api\\BrandController@validateBrand'
    ]);

    Route::post('color/validate-color', [
        'as' => 'color.validateColor',
        'uses' => 'Api\\ColorController@validateColor'
    ]);

    Route::post('color/validate-pref', [
        'as' => 'color.validatePref',
        'uses' => 'Api\\ColorController@validatePref'
    ]);

    Route::post('color/validate-rgb', [
        'as' => 'color.validateRgb',
        'uses' => 'Api\\ColorController@validateRgb'
    ]);

    Route::post('size/validate-size', [
        'as' => 'size.validateSize',
        'uses' => 'Api\\SizeController@validateSize'
    ]);

    Route::post('product/validate-code', [
        'as' => 'product.validateCode',
        'uses' => 'Api\\ProductController@validateCode'
    ]);
    Route::post('product/validate-slug/{edit?}',[
        'as' => 'product.validateSlug',
        'uses' => 'Api\\ProductController@validateSlug'
    ]);
    Route::get('product/{id}/images', [
        'as' => 'product.getImgs',
        'uses' => 'Api\\ProductController@getImgs'
    ]);
    Route::delete('product/{id}/images/{img}',[
        'as' => 'product.img.remove',
        'uses' => 'Api\\ProductController@deleteImg'
    ]);
    route::put('product/{product}/images/{img}', [
        'as' => 'product.img.edit',
        'uses' => 'Api\\ProductController@editImg'
    ]);
    Route::get('product/{id}/images/{width}x{height}/{img}',[
        'as' => 'product.img',
        'uses' => 'Api\\ProductController@img'
    ]);

    Route::post('product/{id}/checkstock', [
        'as' => 'product.checkstock',
        'uses' => 'Api\\ProductController@checkStock'
    ]);

    Route::post('user/bookmark/',[
        'as'=>'user.addBookmark',
        'uses'=>'Api\\UserController@addBookmark'
    ]);
    Route::delete('user/bookmark',[
        'as'=>'user.deleteBookmark',
        'uses'=>'Api\\UserController@deleteBookmark'
    ]);
    Route::get('user/bookmarks',[
        'as'=>'user.getBookmarks',
        'uses'=>'Api\\UserController@getBookmarks'
    ]);
    $addAPI('user','User');
});
Route::get('/home', 'HomeController@index');
Route::get('/regitro', 'CartController@registrationForm');

Route::get('/admin',  [
    'as' => 'admin.index',
    'uses' => 'AdminCtrl@index'
])->middleware('auth')
->middleware('admin');

Route::get('/pages/admin/{view}.html', [
    'as' => 'page',
    'uses' => 'PagesCtrl@admin'
]);
Route::get('/pages/users/{view}.html', [
    'as' => 'user.pages',
    'uses' => 'PagesCtrl@user'
]);
Route::get('/contacto', 'ContactCtrl@index');
Route::get('/home', 'HomeCtrl@index');
Route::get('/', 'HomeCtrl@index');
Route::get('/nuevos', 'HomeCtrl@newProducts');
Route::get('/descuentos', 'HomeCtrl@discountedProducts');


Route::get('/categorias/{slugs?}/pagina', [ //Muestra las categorias
    'as' => 'product.getCategoryPage',
    'uses' => 'ProductCtrl@showCategory'
])->where('slugs', '(.*)');

Route::get('categorias/{categorySlug?}/productos/{productSlug}',[
    'as' => 'product.showDetails',
    'uses' => 'ProductCtrl@showDetails'
])->where('categorySlug', '(.*)');

Route::get('/categorias/{slugs?}', [ //Muestra las categorias
    'as' => 'product.getCategory',
    'uses' => 'ProductCtrl@showCategory'
])->where('slugs', '(.*)');


Route::get('/productos/covers/{slug}_{width}x{height}.{ext}',[
    'as' => 'product.getURLCoverSize',
    'uses' => 'Api\\ProductController@getCoverSize'
]);


Route::get('/productos/covers/{slug}.{ext}',[
    'as' => 'product.getCover',
    'uses' => 'Api\\ProductController@getCover'
]);
Route::get('/productos/nuevos',[
        'as' => 'products.getNews',
        'uses' => 'Api\\ProductController@getNews'
    ]);
Route::get('/productos/descuentos',[
        'as' => 'products.getDiscounts',
        'uses' => 'Api\\ProductController@getDiscounts'
    ]);


Route::get('tests/mail/{format}/{type}', [
        'uses' => 'TestsController@mail',
        'as' => 'test.mails'
    ])->where([
    'format' => "(?:txt|html)"
]);

Route::get('tests/mails',  'TestsController@listmails')->where([
    'format' => "(?:txt|html)"
]);
Route::auth();

Route::get('contenidos/{slug}', [
    'as' => 'Content.slug',
    'uses' => 'ContentCtrl@slug'
]);

 Route::get('parent/{id}', function ($id) {
    $result = \DwSetpoint\Models\Category::find($id)->parent;
    return ($result);
 });

Route::get('user/pedidos',[
        'as'=>'user.getOrders',
        'uses'=>'UserController@getOrders'
    ])->middleware('auth')
    ->middleware('client');

Route::get('user/direcciones',[
        'as'=>'user.getAddresses',
        'uses'=>'UserController@getAddresses'
    ])->middleware('auth')
    ->middleware('client');

Route::get('user/orders',[
        'as'=>'user.getOrdersUser',
        'uses'=>'Api\\UserController@getOrdersUser'
    ]);

Route::get('user/addresses',[
        'as'=>'user.getAddressesUser',
        'uses'=>'Api\\UserController@getAddressesUser'
    ]);

Route::get('order/details',[
        'as'=>'order.getDetails',
        'uses'=>'Api\\OrderController@getDetails'
    ]);

Route::get('mi-perfil/compras',[
    'as' => 'user.getOrder',
    'uses' => function (){
        echo "Destalle de la orden";
    }
]);
Route::get('user/perfil',[
        'as'=>'user.profile',
        'uses'=>'UserController@profile'
    ])->middleware('auth')
    ->middleware('client');

Route::get('/loginFacebook', [
    'as'=>'facebook.login',
    'uses'=>'FacebookController@login'
]);
Route::get('facebook-checkin/', [
    'as'=>'facebook.checkin',
    'uses'=>'FacebookController@checkin'
]);
Route::post('busqueda/personalizada/',[
        'as'=>'search.custom',
        'uses'=>'ProductCtrl@getSearch'
    ]);
Route::post('request/contact',[
    'as' => 'contact.request',
    'uses' => 'ContactCtrl@sendInfoContact'
]);

Route::get('vista/info_contacto',[
    'as' => 'vista.info_contacto',
    'uses' => 'ContactCtrl@get_info_contacto'
]);


Route::post('reset/password',[
    'as' => 'reset.password',
    'uses'=>'UserController@resetPassword'
]);

Route::get('restablecer/password',[
    'as' => 'restablecer.password',
    'uses'=>'UserController@getFormReset'
]);

Route::get('/categoria/{id}/{name}_{width}x{heigth}.png', [
        'as' => 'estrella.getImage',
        'uses' => 'Api\\CategoryController@getImage'
    ]
);

Route::get('test/ocultas', [
        'as' => 'test.ocultas',
        'uses' => 'Api\\CategoryController@subcategories'
    ]
);

Route::get('/marca/{id}/marca-{width}x{heigth}.png', [
        'as' => 'marca.getImage',
        'uses' => 'Api\\BrandController@getImage'
    ]
);


Route::get('/zoom-mobile/{product}/{img}', [
    'as' => 'zoom-mobile',
    'uses' => function($product, $img) {
        return view("public.zoom-mobile",['product'=>$product, 'img' => $img]);
    }
]);
/*--------------------FIN RUTAS SETPOINT-----------------------------------------------*/

/*---------------------INICIO RUTAS DE MAQUETACION (TEST)------------------------------*/
Route::get('/', function () {
    return view('public/pages/home');
});

Route::get('aviso-de-privacidad', function () {
    return view('public/pages/notice-privacy');
});

Route::get('acerca-de', function () {
    return view('public/pages/about-ktm');
});

Route::get('filosofia', function () {
    return view('public/pages/about-ktm');
});

Route::get('vision', function () {
    return view('public/pages/about-ktm');
});

Route::get('compromiso', function () {
    return view('public/pages/about-ktm');
});
Route::get('detalles-de-producto', function () {
    return view('public/pages/product-details');
});
Route::get('contacto', function () {
    return view('public/pages/contact');
});

// Route::get('motos', function () {
//     return view('public/pages/motos');
// });
//------------Rutas Motos-----------------//
Route::get('motos','ProductCtrl@getAllMotos');
Route::get('motos/{category}','ProductCtrl@getCategoryMotos');
Route::get('detalle-de-moto/{product}',['as'=>'details-moto', 'uses'=> 'ProductCtrl@getMoto']);


///

Route::get('servicio', function () {
    return view('public/pages/service');
});

Route::get('confirmacion-servicio', function () {
    return view('public/pages/confirmation-service');
});
Route::get('noticias', function () {
    return view('public/pages/news');
});
Route::get('detalle-de-noticia/{post}',['as'=>'details-news', 'uses'=> 'PostController@getPost']);
/*---------------------FIN RUTAS DE MAQUETACION (TEST)-------------------------------------*/
