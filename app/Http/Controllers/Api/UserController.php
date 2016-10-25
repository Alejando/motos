<?php

namespace DwSetpoint\Http\Controllers\Api;
use DwSetpoint\Models\User; 
use Illuminate\Support\Facades\Input;
class UserController extends \DevTics\LaravelHelpers\Rest\ApiRestController {
    protected static $model = \DwSetpoint\Models\User::class;
    
    public function addBookmark() {
        $id_product = Input::get('id_product');
        /* @var $user User */
        $user = \Auth::user();
        $user = User::getRandom();
        $ok = $user->addBookmark($id_product);
        return ['success' => $ok];
    }
    
    public function deleteBookmark() {
        $id_product = Input::get('id_product');
        /* @var $user User */
        $user = \Auth::user();
        $user = User::getRandom();
        $user->deleteBookmark($id_product);
        return ['success' => true];
    }
}