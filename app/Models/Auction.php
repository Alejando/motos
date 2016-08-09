<?php

namespace GlimGlam\Models;


class Auction extends \GlimGlam\Libs\CoreUtils\ModelBase{
    
    public $timestamps = true;

    const STATUS_FINISHED = 2;
    const STATUS_STARTED = 1;
    const STATUS_STAND_BY = 0;
    const STATUS_CANCELED = 3;

    const READY = 1;
    const COVER_HORIZONTAL = "horizontal";
    const COVER_VERTICAL = "vertical";
    const COVER_SLIDER_UPCOMING = "slider-upcoming"; 
    
    public static function getLastStarted() {
        
    }
    
    public static function getStarted(){
        
    }
    
    public static function getFinished(){
        
    }

    // <editor-fold defaultstate="collapsed" desc="getUpcoming">
    public static function getUpcoming($n) {
        $now = new \DateTime();    
        /* @var $query \Illuminate\Database\Eloquent\Builder */
        $query = Auction::where('startDate','>',$now)
            ->where('status', '!=', self::STATUS_CANCELED)
            ->where('ready', '=', self::READY)
            ->orderBy('startDate','asc')
            ->take($n);
        return $query;
    }
    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="generateThumbnail">
    public static function generateThumbnail($code,$version) {
        return self::getThumbnailByCode($code, $version, false);
    }
    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="getAuctionFilesPath">
    private static function getAuctionFilesPath ($code) {
        $path = public_path()."/upload/auctions/$code/";
        return $path;
    }
    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="getCovers">
    public function getCovers(){
        return [
            'horizotal' => $this->getUrlCover(self::COVER_HORIZONTAL),
            'vertical' => $this->getUrlCover(self::COVER_VERTICAL),
            'slider-upcoming' => $this->getUrlCover(self::COVER_SLIDER_UPCOMING)
        ];
    }
    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="getUrlCover">
    public function getUrlCover($version){
        return route('auction.getCover',['code'=>$this->code,'version'=>$version]);
    }
    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="getThumbnailByCode">
    public static function getThumbnailByCode($code, $version, $returnData = true) {
        $data = false;
        $type = "png";
        $pathBase = self::getAuctionFilesPath($code);
        $defaultImg =  public_path()."/img/edit-perfil-gg.png";
        $img = $defaultImg;
        $coverJpg = $pathBase."covers/$version.jpg";
        $coverPng = $pathBase."covers/$version.png";
        if(file_exists ($coverPng)){
            $type = "png";
            $img = $coverPng;
        } 
        if(file_exists($coverJpg)){
            $type = 'jpg';
            $img = $coverJpg;
        }
        $thumbnail = $pathBase."thumbnail/".$version.".".$type;
        if(!file_exists($thumbnail)) {
            $source = $img;
            switch ($version) {
                case 'horizontal' :
                    $width = 240;
                    $height = 182;
                    break;
                case 'slider-upcoming':
                    $width = 504;
                    $height = 372;
                    break;
                case 'vertical':
                default :
                    $width = 250;
                    $height = 350;
            }
            $imagine = new \Imagine\Gd\Imagine();
            $size = new \Imagine\Image\Box($width, $height);
            $mode = \Imagine\Image\ImageInterface::THUMBNAIL_INSET;
            $resizeImg = $imagine->open($source)->thumbnail($size,$mode);
            $sizeR  = $resizeImg->getSize();
            $widthR = $sizeR->getWidth();
            $heightR = $sizeR->getHeight();
            if($type === 'png') {
                $palette = new \Imagine\Image\Palette\RGB();
                $color = $palette->color('#000', 0);
                $preverse = $imagine->create($size, $color);
            } else {
                $preverse = $imagine->create($size);
            }
            $startX = $startY = 0;
            if($widthR<$width) {
                $startX = ($width - $widthR) / 2;
            }
            if($heightR<$height) {
                $startY = ($height - $heightR)/2;
            }
            if($img != $defaultImg) {
                $preverse->paste($resizeImg, new \Imagine\Image\Point($startX, $startY));
                $preverse->save($thumbnail);
            } else {
                $preverse->paste($resizeImg, new \Imagine\Image\Point($startX, $startY));
            }
            $data = $preverse->get($type);
        } 
        
        if(!$data) {
            $data = file_get_contents($thumbnail);
        }
        
        $result = [
            'exists' => $img!=$defaultImg,
            'path' => $thumbnail,
            'type' => $type == 'jgp'? 'image/jpg': 'image/png'
        ];
        
        if($returnData) {
            $result['data'] = $data;
        }
        return $result;
    }
    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="getByCode">
    public static function getByCode($code) {
        $auctions = self::where('code',$code)->get();
        if(count($auctions)) {
            return $auctions[0];
        }
        return null;
    }
    // </editor-fold>
}