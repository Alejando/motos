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
Route::get('/carrito', function() { 
    return view('public.pages.shoppingcart', [
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
    $addAPI('brand','Brand');
    $addAPI('color','Color');
    $addAPI('size','Size');
    $addAPI('category','Category');
    $addAPI('product','Product');
    Route::get('product/{id}/images', [
        'as' => 'product.getImgs',
        'uses' => 'Api\\ProductController@getImgs'
    ]);
    Route::get('product/{id}/images/{width}x{height}/{img}',[
        'as' => 'product.img',
        'uses' => 'Api\\ProductController@img'
    ]);
    $addAPI('content','Content');
    $addAPI('user','User');
});

Route::get('/home', 'HomeController@index');
Route::get('/admin',  'AdminCtrl@index'); 
Route::get('/pages/admin/{view}.html', [
    'as' => 'page',
    'uses' => 'PagesCtrl@admin'
]);
Route::get('/contacto', 'ContactCtrl@index');
Route::get('/home', 'HomeCtrl@index');
Route::get('/', 'HomeCtrl@index');
Route::auth();
