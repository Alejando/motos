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
        $ok = $user->addBookmark($id_product);
        return ['success' => $ok];
    }
    
    public function deleteBookmark() {
        $id_product = Input::get('id_product');
        /* @var $user User */
        $user = \Auth::user();
        $user->deleteBookmark($id_product);
        return ['success' => true];
    }

    public function getBookmarks() {
        $products = \Auth::user()->bookmarks;
        $idsBookmark = [];
        foreach($products as $product)
        {
            $idsBookmark[] = $product->id;
        }
        return $idsBookmark;
    }

    public function getOrdersUser() {
        $orders = \Auth::user()->orders;
        return $orders;
    }

    public function getAddressesUser() {
        $addresses = \Auth::user()->addresses;
        foreach ($addresses as $address){ 
            $address->state;
            $address->country;
        }
        return $addresses;
    }

    public function validateUser() {//productValid
        $user = Input::get('value');
        // Log::info('Showing user profile for user: '.$category);
        return [
            'isValid' => !\DwSetpoint\Models\User::existsUser($user),
            'value' => $user
        ];
    }
}