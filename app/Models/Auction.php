<?php

namespace GlimGlam\Models;

class Auction extends \GlimGlam\Libs\CoreUtils\ModelBase{
    
    public $timestamps = true;
    
    const STATUS_FINISHED = 2;
    const STATUS_STARTED = 1;
    const STATUS_STAND_BY = 0;
    const STATUS_CANCELED = 3;
    
    protected $dateFormat = 'Y-m-d H:i:s';
    public $dates = ['start_date','end_date'];
    
    const READY = 1;
    const COVER_HORIZONTAL = "horizontal";
    const COVER_VERTICAL = "vertical";
    const COVER_SLIDER_UPCOMING = "slider-upcoming"; 
    const COVER_NOW = "now";
    
    protected $hidden = ['created_at', 'updated_at'];
    
    // <editor-fold defaultstate="collapsed" desc="isStarted">
    public function isStarted(){
        return  $this->status == self::STATUS_STARTED;
    }
    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="isFinished">
    public function isFinished() {
        return $this->status == self::STATUS_FINISHED;
    }
    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="isStandBy">
    public function isStandBy() {
        return $this->status == self::STATUS_STAND_BY;
    }
    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="isBuyable">
    public function isBuyable() {
        $utcMx = new \DateTimeZone("America/Mexico_City");
        $now = new \DateTime(null, $utcMx);
        $start_date = new \DateTime($this->start_date);
        $start_date->setTimezone($utcMx);
        $now->setTimezone($utcMx);
        $thuBefore = date("Y-m-d 00:00", strtotime("last ".Config('app.presaleday'), $start_date->getTimestamp()));
        $lastThursday = new \DateTime($thuBefore, $utcMx);
        $afterPreSale = $lastThursday <= $now;
        $dieHr = clone $start_date;
        $dieHr->sub(new \DateInterval('PT1H'));
        $inTime  = $now<=$dieHr;
        $cupo = $this->total_enrollments<$this->users_limit;
        return $inTime && $afterPreSale && $cupo;
    }
    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="isEnrolled">
    public function isEnrolled ($user){
        $enrol = Enrollment::where('user', '=', $user->id)
                ->where('auction', '=', $this->id)
                ->get()->count();
        return $enrol > 0;
    }
    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="getBuyables">
    public static function getBuyables($user, $returnQuery = false){
        $timeLimit = new \DateTime;
        $timeLimit->add(new \DateInterval('PT1H'));
        $idAcutionsErrolmented = $user->enrolmensAuntionsIds();
        $auctions = self::whereNotIn('id', $idAcutionsErrolmented)
                ->where('ready','=', self::READY)
                ->where('status','=', self::STATUS_STAND_BY)
                ->where('start_date', '>', $timeLimit)
                ->orderBy('start_date', 'asc');
        return $returnQuery ? $auctions : $auctions->get();
    }
    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="getTotalEnrollments">
    public function getTotalEnrolments(){
        return Enrollment::where('auction','=', $this->id)->get()->count();
    }
    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="getTotalBids">
    public function getTotalBids() {
        return rand(20, 50);
    }
    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="getOfferType">
    public function getOfferType() {
        return 'oferta-verde';
//        return ['oferta-verde','oferta-naranja','oferta-rojo'][rand(0, 2)];
    }
    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="getStartDateAttribute">
    public function getStartDateAttribute() {
        return $this->datetimeFormat('start_date');
    }
    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="getEndDateAttribute">
    public function getEndDateAttribute(){
        return $this->datetimeFormat('end_date');
    }
    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="getStarted">
    public static function getStarted( ) {
        return self::where('ready',"=",1)
            ->where('status','=', self::STATUS_STARTED);
    }
    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="getFinished">
    public static function getFinished() {
        return self::where('status', '=', self::STATUS_FINISHED)
            ->where('ready','=', self::READY)
            ->orderBy('start_date','desc');
    }
    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="getUpcoming">
    public static function getUpcoming() {
        $now = new \DateTime(); 
        /* @var $query \Illuminate\Database\Eloquent\Builder */
        $query = Auction::where('start_date', '>', $now)
            ->where('status', '=', self::STATUS_STAND_BY)
            ->where('ready', '=', self::READY)
            ->orderBy('start_date','asc');
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
    // <editor-fold defaultstate="collapsed" desc="getCoverAttribute">
    public function getCoverAttribute() {
        if( $this->isPreSaleDay()){
            return $this->attributes['preorder_cover'];
        }
        return $this->attributes['cover'];
    }
    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="isPreventDay">
    public function isPreSaleDay(){
        $utcMx = new \DateTimeZone("America/Mexico_City");
        $now = new \DateTime(null, $utcMx);
        $now->setTimezone($utcMx);
        $presaleDay = $this->getPreSaleDate($utcMx);
        $endPresaleDay = clone $presaleDay;
        $endPresaleDay->setTime(23, 59, 59);
        return ($now<$endPresaleDay) && ($now>$presaleDay);
    }
    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="getPreSaleDate">
    public function getPreSaleDate($timeZone){
        $start_date = new \DateTime($this->start_date);
        $start_date->setTimezone($timeZone);
        $thuBefore = date("Y-m-d 00:00", strtotime("last ".Config('app.presaleday'), $start_date->getTimestamp()));
        return new \DateTime($thuBefore, $timeZone);
    }
    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="getOriginalCover">
    public function getOriginalCover(){
        return $this->attributes['cover'];
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
        $coverJpg = $pathBase."01.jpg";
        $coverPng = $pathBase."01.png";
        if(file_exists ($coverPng)){
            $type = "png";
            $img = $coverPng;
        } 
        if(file_exists($coverJpg)){
            $type = 'jpg';
            $img = $coverJpg;
        }
        $thumbnailPath = $pathBase."thumbnail/";
        
        $thumbnail = $thumbnailPath.$version.".".$type;
        if(!file_exists($thumbnail)) {
            $source = $img;
            if(!file_exists($thumbnailPath)) {
                $oldmask = umask(0);
                mkdir($thumbnailPath, 0777, true);
                umask($oldmask);
            }
            switch ($version) {
                case 'fancy-box-small':
                    $width = 224;
                    $height = 337;
                    break;
                case 'now' :
                    $width = 450;
                    $height = 300;
                    break;
                case 'horizontal' :
                    $width = 240;
                    $height = 182;
                    break;
                case 'slider-upcoming':
                    $width = 980;
                    $height = 500;
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
            if($widthR < $width) {
                $startX = ($width - $widthR) / 2;
            }
            if($heightR < $height) {
                $startY = ($height - $heightR)/2;
            }
            if($img != $defaultImg) {
                $preverse->paste($resizeImg, new \Imagine\Image\Point($startX, $startY));
                $oldmask = umask(0);
                $preverse->save($thumbnail);
                chmod($thumbnail, 0777);
                umask($oldmask);
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
    // <editor-fold defaultstate="collapsed" desc="getPhotos">
    public static function getPhotos($code) {
        $path = public_path()."/upload/auctions/$code/";
        if(!file_exists($path)){
           $umask= umask(0);
           mkdir($path, 0777, true);
           umask($umask);
        }
        $files = scandir($path);
        $photos = [];        
        foreach($files as $file){
            if( $file != '.DS_Store' && $file != 'thumbnail' && $file!='photos' && $file != '.' && $file!='..'){
                $photos[] = $file;
            }
        }
        return $photos;
    }
    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="resizeImg">
    private static function resizeImg($source, $width, $height, $pathCache, $returnData) {
        $img = new \Imagine\Gd\Imagine();
        $size = new \Imagine\Image\Box($width, $height);
        $mode = \Imagine\Image\ImageInterface::THUMBNAIL_INSET;
        $reziceImg = $img->open($source)->thumbnail($size, $mode);
        $sizeR = $reziceImg->getSize();
        $widthR = $sizeR->getWidth();
        $heightR = $sizeR->getHeight();
        $type =  pathinfo($source)['extension'];
        if($type==='png'){
            $palete = new \Imagine\Image\Palette\RGB();
            $color = $palete->color('#000',0);
            $out = $img->create($size, $color);
        } else {
            $out = $img->create($size);
        }
        $startX = $startY = 0;
        if($widthR<$width){
            $startX = ($width - $widthR)/2;
        }
        if($heightR <$height ){
            $startY = ($height - $heightR) / 2;
        }
        $out->paste($reziceImg, new \Imagine\Image\Point($startX, $startY));
        return $out->get($type);
    }
    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="getMime">
    private static function getMime ($source) {
        $type = pathinfo($source)['extension'];
        switch($type) {
            case 'jpg' : return 'image/jpg';
            case 'png' : return 'image/png';
        } 
        return false;
    }
    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="getSizeByVersion">
    private static function getSizeByVersion($version) {
        $sizes = config('app.img-sizes.'.$version);
        if(!$sizes) {
            abort(404);
        }
        return [
            'width'  => $sizes['width'],
            'height' => $sizes['height']
        ];
    }
    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="getImg">
    public static function getImg($code, $version, $photo){
        //@Todo falta el manejo de cache
        $pathBase = self::getAuctionFilesPath($code);
        $source = $pathBase.$photo;                       
        if(!file_exists($source)){
            abort(404);
        }        
        $v = self::getSizeByVersion($version);
        $data = self::resizeImg($source, $v['width'], $v['height'], $version, false, true);
        return (new \Illuminate\Http\Response($data))->header('Content-type', self::getMime($source));
    }
    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="getUrlImg">
    public function getUrlImg($versions = ["fancy-box-small","fancy-box-thumbailn","fancy-box-zoom"]) {
        $imgs = $this->getPhotos($this->code);
        $rImgs = [];
        foreach($versions as $version){
            $rImgs[$version] = [];
            foreach($imgs as $img){
                $rImgs[$version][] = route('auction.getImg',[
                    'version' => $version,
                    'code' => $this->code,
                    'photos' => $img
                ]);
            }
        }
        return $rImgs;
    }
    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="startAuctions">
    public static function startAuctions(){
        $auctions = self::where('status','=',self::STATUS_STAND_BY)
                ->where('ready','=',self::READY)
                ->where('start_date','<', new \DateTime)
                ->update(['status'=>self::STATUS_STARTED]);
        return $auctions;
    }
    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="closeAuctions">
    public static function closeAuctions(){
        $auctions = self::where('status','=',self::STATUS_STARTED)
                ->where('end_date','<', new \DateTime)
                ->update(['status'=>self::STATUS_FINISHED]);
        return $auctions;
    }
    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="getRelated">
    public static function getRelated($code, $returnQuery = false){
        //Se obtendran 4 productos relacionados a partir del codigo de producto
        $query = \GlimGlam\Models\Auction::getRandom(4, true);
        $query->where('status','=',  Auction::STATUS_STAND_BY)->where('ready','=',  Auction::READY);
        if($returnQuery){
            return $query;
        }
        return $query->get();
    }
    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="placeBid">
    public static function placeBid($user_id, $code, $bid) {
        $user = User::getById($user_id);
        $auction = self::getByCode($code);
        $enrollment = $auction->getEnrollment($user_id,$auction->id);
        //dd($enrollment);
        if(!$enrollment){
            throw new Exception("No se enctro el enrrollment");
        }
        $close = false;
        $auction->last_offer += $bid;
        $auction->num_bids++;
        $auction->sold_for = $auction->last_offer;
        $auction->winner = $user_id;
        $auction->winnername = $user->getPublicName();
        if($auction->last_offer > $auction->max_price){
           $auction->last_offer = $auction->max_price; 
           $close = true;
        }
        $now = new \DateTime();
        \GlimGlam\Models\Bid::create([ 
            'offer' => $auction->last_offer, 
            'user' => $user_id,
            'auction'=>$auction->id,
            'enrollment'=>$enrollment->id,
            'bid_at' => $now
        ]);   
        $enrollment->last_bid_date = $now;
        $enrollment->save();
        $auction->save();
        if($close) {
            $auction->close();
        }
        return true;
    }
    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="close">
    public function close() {
        $this->status=self::STATUS_FINISHED;
        $this->save();
    }
    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="getInfoBid">
    public function getInfoBid($id_user){
        $c = Bid::where('user','=', $id_user)
             ->where('auction','=', $this->id)
            ->orderBy('bid_at','desc');
        $res = $c->get();
        $total  = count($res);
        $bid = $res->get(0);
        dd($total);
        if($total) {
            $nextbid = $bid->bid_at;
            $nextbid = new \DateTime($nextbid);
            $nextbid->add(new \DateInterval('PT'.$this->delay.'S'));
            $enrollment = Enrollment::getById($bid->enrollment);
            return [
                'unqualified'=> $enrollment->unqualified,
                'faults' => $enrollment->faults,
                'totalbids' => $total,
                'nextbid' => $nextbid->format(DATE_ISO8601)
            ];
        }
        return [
            'unqualified'=> $enrollment->unqualified,
            'faults' => $enrollment->faults,
            'nextbid' => (new \DateTime())->format(DATE_ISO8601),
            'totalbids' => 0
        ];
    }
    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="getEnrollment">
    public function getEnrollment($user_id, $auction){
        return Enrollment::getEnrollments($user_id, $auction)->get(0);
    }
    // </editor-fold>

}
