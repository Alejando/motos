<?php
namespace GlimGlam\Http\Controllers\Api;
class UserController extends \GlimGlam\Libs\CoreUtils\ApiRestController{
    protected static $model = \GlimGlam\Models\User::class;
    public function getAuth() {
        return \Auth::user();
    }
    public function addFav($code){
        $user = \Auth::user();
        $auction = \GlimGlam\Models\Auction::getByCode($code);
        $user->addFav($auction);
        return ['success' => true];
    }
    public function removeFav($code){
        $user = \Auth::user();
        $auction = \GlimGlam\Models\Auction::getByCode($code);
        $user->removeFav($auction);
        return ['success' => true];
    }
}