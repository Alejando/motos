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
//

//Route::get('/', function () {
//    return view('welcome');
//});
/* @var $route \Illuminate\Routing\Router */
$route = \Illuminate\Support\Facades\Route::getFacadeRoot();
$route->controller('tests/pako','TestPakoCtrl');
$route->controller('tests/jared', 'TestJaredCtrl');
Route::auth();
Route::get('/home', 'HomeController@index');
Route::get('/login', function () {
    return view('public.pages.login');
});
$route->get('api/auction/upcoming/{n?}',[
    'as'=> 'auction.upcoming',
    'uses' =>  'Api\\AuctionController@getUpcoming'
]);  
// <editor-fold defaultstate="collapsed" desc="/api">
Route::group(['prefix' => 'api'], function () {
    // <editor-fold defaultstate="collapsed" desc="$getNames">
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
    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="$addAPI">
    $addAPI = function ($name, $controller){      
//        echo "Api\\{$controller}Controller";
//        die();
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
//                echo $name.'/all-for-datatables';
                
    };
    // </editor-fold>
    Route::get('auction/code/{code}',[
        'as' => 'auction.getByCode',
        'uses' => 'Api\\AuctionController@getByCode'
    ]);
    Route::get('content/slug/{slug}', [
        'as' => 'Content.slug',
        'uses' => 'Api\\ContentController@slug'
    ]);
    $addAPI('category','Category');
    $addAPI('preference','Preference');
    $addAPI('address','Address');
    $addAPI('auction','Auction');
    $addAPI('content','Content');
    $addAPI('user','User');
});
// </editor-fold>
Route::get('mi-perfil/', 'UserController@profile' );
Route::post('api/auction/{id}/addPhoto','Api\\AuctionController@addPhoto');
Route::get('api/auction/{id}/photos', 'Api\\AuctionController@getPhotos'); 
Route::get('api/auction/{id}/photo/{file}', 'Api\\AuctionController@getPhoto');
Route::get('api/auction/{code}/thumbailn/{version}', [
    'uses' => 'Api\\AuctionController@getThumbnail',
    'as'   => 'auction.getCover'
])->where([
    'version'=> "(?:vertical|horizontal|slider-upcoming)"
]);

$route->get('tests/mail/{type}', 'TestsController@mail');
$route->get('{slug}','PublicController@content');