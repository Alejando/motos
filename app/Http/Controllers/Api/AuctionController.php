<?php
namespace GlimGlam\Http\Controllers\Api;
class AuctionController extends \GlimGlam\Libs\CoreUtils\ApiRestController{
    protected static $model = \GlimGlam\Models\Auction::class;
    public function addPhoto($id){
        $path = public_path()."/upload/auctions/$id/photos/";
        if(!file_exists($path)){
            try{
                @mkdir($path, 0777, true);
            }catch(\Exception $e){
                
            }
        }
        $file = $_FILES['file'];
        $file['tmp_name'] ;
        $name = $path . $file['name'];        
        if(file_exists($name)) {
            $pathInfo = pathinfo($name);
            $name = $path.$pathInfo['filename'].'-'.time().'.'.$pathInfo['extension'];
        }
        move_uploaded_file($file['tmp_name'], $name);
    }
    public function getPhoto($id, $file){
        $path = public_path()."/upload/auctions/$id/photos/$file";
        $info = pathinfo($path);
        switch ($info['extension']){
            case 'png' : 
                header('Content-type:image/png');
                break;
            case 'jpg' :
                header('Content-type:image/jpg');
                break;
            default :
                abort(404);
        }
        if(file_exists($path)){
            echo file_get_contents($path);
            die();
        }
        abort(404);
    }
    public function getPhotos($id){
        $path = public_path()."/upload/auctions/$id/photos/";
        $files = scandir($path);
        $base_url = route('auction').'/'.$id.'/photo/';
        $photos = [];
        foreach($files as $file){
            if($file!='.' && $file!='..'){
                $photos[] = $base_url.$file;
            }
        }
        return $photos;
    }
}