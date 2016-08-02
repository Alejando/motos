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

Route::get('/',"Home@index");
Route::get('/admin',"AdminController@index");
Route::get('/pages/admin/{view}.html','PagesCtrl@admin');

Route::post('/file-upload', function () {
    print_r($_FILES);
});


//Route::get('/', function () {
//    return view('welcome');
//});
Route::auth();
Route::get('/home', 'HomeController@index');
Route::get('/login', function () {
    return view('public.pages.login');
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
    $addAPI = function ($url, $controller, $name){                
                Route::resource($url, $controller, [ 'names' => [
                        'index'   => $name.'',
                        'create'  => $name.'.create',
                        'store'   => $name.'.store',
                        'show'    => $name.'.show',
                        'edit'    => $name.'.edit',
                        'update'  => $name.'.update',
                        'destroy' => $name.'.destroy'
                    ]
                ]);
                Route::get($url.'/{id}/relation/{relation}',[                  
                    'as' => $name.'.relation',
                    'uses' => $controller.'@relation']
                );
    };
    
    Route::resource('auction', 'Api\\AuctionController', $getNames('auction'));
});
// Route::resource('api/auction','Api\\AuctionController');
Route::post('api/auction/{id}/addPhoto','Api\\AuctionController@addPhoto');
Route::get('api/auction/{id}/photos', 'Api\\AuctionController@getPhotos'); 
Route::get('api/auction/{id}/photo/{file}', 'Api\\AuctionController@getPhoto');