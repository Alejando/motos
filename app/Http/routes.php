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
Route::auth();

Route::get('/holamundo',function(){
    return view("holamundo");
});


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

Route::get('/home', 'HomeController@index');
Route::get('/login', function () {
    return view('public.pages.login');
});
Route::get('/tests/cron', 'TestsController@crons');
Route::post('/ofertar', [
    'as'=>'auction.place-bid',
    'uses'=>'AuctionController@placeBid'
]);
Route::get('cron/revision-faltas', [
    'as'=>'check.faults',
    'uses'=>'ProcessController@checkFaults'
]);
Route::get('cron/cerrar-subastas', [
    'as'=>'close.auctions',
    'uses'=>'ProcessController@closeAuctions'
]);
Route::get('cron/iniciar-subastas', [
    'as'=>'start.auctions',
    'uses'=>'ProcessController@startAuctions'
]);
Route::get('/pago-ganador/{code}', [
    'as'=>'payment.win',
    'uses'=>'AuctionController@paymentWin',
    'middleware' => 'auth'
]);
Route::get('/loginFacebook', [
    'as'=>'facebook.login',
    'uses'=>'FacebookController@login'
]);
Route::get('facebook-checkin/', [
    'as'=>'facebook.checkin',
    'uses'=>'FacebookController@checkin'
]);
// <editor-fold defaultstate="collapsed" desc="/api">
Route::group(['prefix' => 'api'], function () use (&$route){
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
    $route->get('auction/upcoming/{n?}',[
        'as' => 'auction.upcoming',
        'uses' =>  'Api\\AuctionController@getUpcoming'
    ]); 
    $route->get('auction/started/{n?}', [
        'as' => 'auction.started',
        'uses' => 'Api\\AuctionController@getStarted'
    ]);
    $route->get('auction/finished/{n?}', [
        'as' => 'auction.finished',
        'uses' => 'Api\\AuctionController@getFinished'
    ]);
    Route::get('auction/code/{code}',[
        'as' => 'auction.getByCode',
        'uses' => 'Api\\AuctionController@getByCode'
    ]);
    Route::get('content/slug/{slug}', [
        'as' => 'Content.slug',
        'uses' => 'Api\\ContentController@slug'
    ]);
    Route::get('auction/list-upcoming', [
        'as'    => 'auction.list-upcoming',
        'uses' => 'Api\\AuctionController@listUpcoming'
    ]);
    Route::get('auction/fancy/{code}',[
        'as' => 'auction.fancy',
        'uses' => 'Api\\AuctionController@fancy'
    ]);
    $addAPI('category','Category');
    $addAPI('preference','Preference');
    $addAPI('address','Address');
    $addAPI('auction','Auction');
    $addAPI('content','Content');
    Route::get('user/auth', [
        'as' => 'user.get-auth-user',
        'uses' => 'Api\\UserController@getAuth'
    ]);
    Route::post('user/update-avatar',[
        'as' => 'user.save-img-profile',
        'uses' => 'Api\\UserController@updateAvatar'
    ]);
    Route::get('user/{userId}/avatar/', [
        'as'   => 'user.img-avatar',
        'uses' => 'Api\\UserController@getAvatar'
    ]);
    Route::get('user/{userId}/fav',[
        'as' => 'user.get-fav',
        'uses' => 'Api\\UserController@getFav'
    ]);
    Route::get('user/{userId}/wins',[
        'as' => 'user.get-my-wins',
        'uses' => 'Api\\UserController@getWins'
    ]);
    Route::get('user/{userId}/enrollements',[
        'as' => 'user.get-my-enrollments',
        'uses' => 'Api\\UserController@enrollments'
    ]);
    Route::get('user/{userId}/auctions-info',[
        'as' => 'user.get-auctions-info',
        'uses' => 'Api\\UserController@auctionsInfo'
    ]);
    Route::get('user/{userId}/subasta-actual',[
        'as' => 'user.get-current-auction',
        'uses' => 'Api\\UserController@getCurrentAuction'
    ]);
    $addAPI('user','User');
    Route::get('user/add-fav/{code}', [
        'as' => 'user.add-fav',
        'uses' => 'Api\\UserController@addFav'
    ]);
    
    Route::get('user/remove-fav/{code}', [
        'as' => 'user.remove-fav',
        'uses' => 'Api\\UserController@removeFav'
    ]);
    Route::get('enrollment/iam-enrollment/{auctionCode}/', [
        'as' => 'enrollment.userIsEnrollment',
        'uses' => 'Api\\EnrollmentController@userIsEnrollment',        
    ]);
    Route::post('auction/{id}/addPhoto','Api\\AuctionController@addPhoto');
    Route::get('auction/{code}/photos', 'Api\\AuctionController@getPhotos'); 
    Route::get('auction/{id}/photo/{file}', 'Api\\AuctionController@getPhoto');
    Route::get('auction/{code}/thumbailn/{version}', [
        'uses' => 'Api\\AuctionController@getThumbnail',
        'as'   => 'auction.getCover'
    ])->where([
        'version'=> "(?:vertical|horizontal|slider-upcoming|now)"
    ]);
    Route::get('auction/{code}/photos/{version}/{photo}', [
        'uses' => 'Api\\AuctionController@getImg',
        'as' => 'auction.getImg'
    ])->where([
        'version' => "(?:fancy-box-small|fancy-box-zoom|fancy-box-thumbailn)"
    ]);
    
});
// </editor-fold
Route::get('mi-perfil/', [
    'as' => 'my-profile',
    'uses' => 'UserController@profile',
    'middleware' => 'auth'
]);

//Formulario de checkout de lugar  en la subasta
Route::get('subastas/asiento-checkout/{code}', [ 
    'as' => 'auction.enrollment-form',
    'uses' =>  'AuctionController@enrollmentPayment',
    'middleware' => 'auth'
]);
//Proceso de redireccion a PayPal para la compra de los lugares en la subasta
Route::get('subastas/asientos-solicitud-pay-pal/{code}/{bill}', [
    'as' => 'auction.checkout',
    'uses' => 'PaypalController@checkoutEnrollment',
    'middleware' => 'auth'
]);   
Route::get('subastas/finish/{code}', [
    'as' => 'auction.finish-payment',
    'uses' => 'AuctionController@confirmPayment',
    'middleware' => ['auth', 'enrolled']
]);
//Callback de pago de lugar en subasata con paypal
Route::get('subastas/lugares/estatus-pago', [
    'as' => 'enrollment.payment',
    'uses' => 'PaypalController@enrrolmentPaymentStatus'
]);

Route::get('subastas/lugar/error-pago',[ //Pagina de error si paypal no aprueva el pago del lugar
    'as' => 'acution.payment.reject',
    'uses' => 'AuctionController@paymentEnrrolmentReject',
    'middleware' => 'auth'
]);

Route::get('subastas/confirmacion-pago', [ //Pagna de confirmación de pago de lugar
    'as' => 'auction.payment.approvated',
    'uses' => 'AuctionController@paymentApprovated',
    'middleware' => 'auth'
]);

Route::get('subastas/error-en-pago', [ //Si ubo un error en el pago
    'as' => 'auction.payment.failed',
    'uses' => 'AuctionController@paymentFailed'
]);

Route::get('subastas/juego/{code}', [ //Room de Juego
    'as' => 'auction.room',
    'uses' => 'AuctionController@room',
    'middleware' => ['auth', 'enrolled:false']
]);
Route::get('subastas/juego/info/{code}', [
    'as' => 'auction.get-info-bid',
    'uses' => 'AuctionController@getInfoBid',
    'middleware' => 'auth'
]);



$route->get('tests/mail/{format}/{type}', 'TestsController@mail')->where([
    'format' => "(?:txt|html)"
]);

$route->get('{slug}',[ //Contenido general
    'as'=>'content',
    'uses'=>'PublicController@content'
]);

Route::get('usuario/info-facturacion', [
    'as'=>'user.bills-info',
    'uses'=>'BillsInfoCtrl@getInfo',
    'middleware' => 'auth'
]);

Route::post('usuario/info-facturacion', [
    'as'=>'user.bills-info',
    'uses'=>'BillsInfoCtrl@setInfo',
    'middleware' => 'auth'
]);


