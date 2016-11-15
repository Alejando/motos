<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::get("{msj}/holamundo/", "HomeController@holamundo");
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

Route::get('/direccion', function() {
    return view('public.pages.location', [
        'showOffert' => false,
        'showBannerBottom' => false
    ]);
});
Route::get('/envio', function() {
    return view('public.pages.shipping', [
        'showOffert' => false,
        'showBannerBottom' => false
    ]); });
Route::get('/pago', function() {
    return view('public.pages.checkout', [
        'showOffert' => false,
        'showBannerBottom' => false
    ]);
});
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
    
    Route::post('coupon/validate-code', [
        'as' => 'coupon.validateCode',
        'uses' => 'Api\\CouponController@validateCode'
    ]);
    
    
    Route::get('product/{id}/images', [
        'as' => 'product.getImgs',
        'uses' => 'Api\\ProductController@getImgs'
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
    $addAPI('user','User');


});

Route::get('/home', 'HomeController@index');

Route::get('/admin',  [
    'as' => 'admin.index',
    'uses' => 'AdminCtrl@index'
])->middleware('auth');

Route::get('/pages/admin/{view}.html', [
    'as' => 'page',
    'uses' => 'PagesCtrl@admin'
]);

Route::get('/contacto', 'ContactCtrl@index');
Route::get('/home', 'HomeCtrl@index');
Route::get('/', 'HomeCtrl@index');



Route::get('/categorias/{slugs?}/paginas/{page}', [ //Muestra las categorias
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
Route::get('/productos/{id}/cover-{width}x{height}',[
    'as' => 'product.getURLCoverSize',
    'uses' => 'Api\\ProductController@getCoverSize'
]);
Route::get('/productos/{id}/cover',[
    'as' => 'product.getCover',
    'uses' => 'Api\\ProductController@getCover'
]);

//Route::get('/producto/{producto}/categoria/{slugs?}', [ //Muestra las categorias y el detalle del producto
//    'as' => 'product.getInfo',
//    'uses' => 'ProductCtrl@showProduct'
//])->where('slugs', '(.*)');

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
