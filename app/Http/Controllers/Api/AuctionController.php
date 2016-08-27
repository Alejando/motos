<?php

namespace GlimGlam\Http\Controllers\Api;

class AuctionController extends \GlimGlam\Libs\CoreUtils\ApiRestController {

    protected static $model = \GlimGlam\Models\Auction::class;

    // <editor-fold defaultstate="collapsed" desc="addPhoto">
    public function addPhoto($id) {
        $path = public_path() . "/upload/auctions/$id/photos/";
        if (!file_exists($path)) {
            try {
                @mkdir($path, 0777, true);
            } catch (\Exception $e) {
                
            }
        }
        $file = $_FILES['file'];
        $file['tmp_name'];
        $name = $path . $file['name'];
        if (file_exists($name)) {
            $pathInfo = pathinfo($name);
            $name = $path . $pathInfo['filename'] . '-' . time() . '.' . $pathInfo['extension'];
        }
        move_uploaded_file($file['tmp_name'], $name);
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="getPhoto">
    public function getPhoto($id, $file) {
        $path = public_path() . "/upload/auctions/$id/photos/$file";
        $info = pathinfo($path);
        switch ($info['extension']) {
            case 'png' :
                header('Content-type:image/png');
                break;
            case 'jpg' :
                header('Content-type:image/jpg');
                break;
            default :
                abort(404);
        }
        if (file_exists($path)) {
            echo file_get_contents($path);
            die();
        }
        abort(404);
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="getPhotos">
    public function getPhotos($code) {
        return \GlimGlam\Models\Auction::getPhotos($code);
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="getByCode">
    public function getByCode($code) {
        $auction = \GlimGlam\Models\Auction::getByCode($code);
        return $auction != null ? $auction : abort(404);
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="getThumbnail">
    public function getThumbnail($code, $version) {
        $thum = \GlimGlam\Models\Auction::getThumbnailByCode($code, $version);
        return response($thum['data'])->header('Content-type', $thum['type']);
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="getUpcoming">
    public function getUpcoming($n = 5) {
        return \GlimGlam\Models\Auction::getUpcoming()->paginate((int) $n);
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="getFinished">
    public function getFinished($n = 5) {
        return \GlimGlam\Models\Auction::getFinished()->paginate((int) $n);
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="getStarted()">
    public function getStarted($n = 5) {
        return \GlimGlam\Models\Auction::getStarted()->paginate((int) $n);
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="listUpcoming">
    public function listUpcoming() {
        $auctions = \GlimGlam\Models\Auction::getUpcoming()->paginate(13);
       
        $favs = \Auth::check() ? \Auth::user()->fav()->getRelatedIds()->toArray() : [];
        
        
        if ($auctions->count()) {
            return view('public.blocks.auctions-list', [
                'auctions' => $auctions,
                'favs' => $favs
            ]);
        }
        return "false";
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="fancy">
    public function fancy($code) {
        $auction = \GlimGlam\Models\Auction::getByCode($code);
        if ($auction) {
            return view('public.blocks.fancy-product', [
                'auction' => $auction
            ]);
        }
        abort(404);
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="getImg">
    function getImg($code, $version, $photo) {
        return \GlimGlam\Models\Auction::getImg($code, $version, $photo);
    }

    // </editor-fold>
}
