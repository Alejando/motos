<?php

namespace GlimGlam\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable {
    use \GlimGlam\Libs\CoreUtils\traits\MethodsModelBase;
    protected $guarded = ['id'];    
    public $timestamps = true;
    
    
    const PROFILE_CLIENT = 1;
    const PROFILE_ADMIN = 2;
    const GENDER_MALE = 1;
    const GENDER_FEMALE = 0;
    public function checkinRoom($auction){
        $now = new \DateTime;
        /* @var $startDate \DateTime */
        $startDate = $auction->getStartDateDateTime(); 
        $startDate->sub(new \DateInterval("PT10S"));
        if($now >$startDate) {
            $enrollments = Enrollment::getEnrollments($this->id, $auction->id);
            if(count($enrollments) && ($enrollment = $enrollments[0]) && $enrollment->checkin_room ==="0000-00-00 00:00:00") { //si compre entrada
                $enrollment->checkin_room = $now;
                $enrollment->last_fault_date_aux =$now;
                $enrollment->save();
            }
        }
        return $this;
    }
    public function sendMailWelcome($rawPassword = false){
        \GlimGlam\Libs\Helpers\Mail::welcome([
            'user' => $this,
            'to' => $this->email,
            'rawPassword' => $rawPassword
        ]);
    }
    public function avatarFile(){
        return public_path('upload/avatars/'.$this->id.'.jpg');
    }
    
    public function existsAvatar(){
        return file_exists($this->avatarFile());
    }
    
    public function getAvatar() {               
        return \GlimGlam\Libs\Helpers\Img::resizeImgOutbound($this->avatarFile(), 190, 190, false , true);
    }
    
    public function isMale(){
        return $this->gender == self::GENDER_MALE;
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'gender','birthday'
    ];
    protected $visible = array('id','name', 'email', 'profile', 'birthday','gender');
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    // <editor-fold defaultstate="collapsed" desc="fav">
    public function fav(){
        return $this->belongsToMany(\GlimGlam\Models\Auction::class, 'auctions_fav');
    }
    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="removeFav">
    public function removeFav($auction) {
        return $this->fav()->detach($auction);
        
    }
    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="addFav">
    public function addFav($auction) {
        if(!$this->fav->contains($auction)){
            $this->fav()->save($auction);
            return true;
        }
        return false;
    }
    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="getPublicName">
    public function getPublicName(){
        $name = explode('@',$this->name);
        return '@'.$name[0];
    }
    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="billsInfo">
    public function billsInfo(){
        return $this->hasOne(BillsInfo::class);
    }
    // </editor-fold>
    
    public function preferences() {
        return $this->belongsToMany('\GlimGlam\Models\Preference');
    }
    
    public function getAunctionsInfo(){
        $info = [
            'totalEnrollments' => $this->getMyEnrolmentsAuctions(true)->count(),
            'totalWins' => $this->getWins(true)->count()
        ];
        return $info;
    }
    public function getBirthdayAttribute(){
        if(is_object($this->attributes['birthday'])) {
            return $this->attributes['birthday']->format('Y-m-d\TH:i:s');
        }
        return (new \DateTime($this->attributes['birthday']))->format('Y-m-d\TH:i:s');
    }
    
    public function getMyEnrolmentsAuctions($returnQuery = false ) {
        $enrolments = self::getMyEnrolments(true)->select('auction')->get();
        $auctionsIds = [];
        foreach($enrolments as $enrol) {
            $auctionsIds[] = $enrol->auction;
        }
        $query = Auction::whereIn('id', $auctionsIds)->orderBy('start_date', 'ASC');
        return $returnQuery ? $query : $query->get();
    }
    
    public function getMyEnrolments($returnQuery = false) {
        $query = Enrollment::where('user', '=' , $this->id );
        return $returnQuery? $query : $query->get();
    }
    public static function defaultAvatarType(){
        return 'image/png';
    }
    public static function defaultAvatar(){
        $img = base_path('public/img/perfil-gg.png');
        return file_get_contents($img);
    }
    public function getCurrentAuction(){
        return false;
    }
    public function getUpcomingAuctition(){
        return false;
    }
    
    public function getWins($returnQuery = false) {
        $ids = self::enrolmensAuntionsIds();
        $query = Auction::whereIn('id', $ids)
                ->where('status','=', Auction::STATUS_FINISHED)
                ->where('winner', '=', $this->id );
        return $returnQuery ? $query : $query->get();
    } 
    
    public function enrolmensAuntionsIds() {
        $auctions = self::getMyEnrolments(true)->select('auction')->get();
        $ids = [];
        foreach($auctions as $ac){
            $ids[] = $ac->auction;
        }
        return $ids;
    }   
    
    public function isAdmin() {
        return $this->perfil == self::PROFILE_ADMIN;
    }
    
    public function isClient() {
        return $this->profile == self::PROFILE_ADMIN;
    }
    
    public function enroll($auction, $cover){
        $idAuction = is_object($auction) ? $auction->id: $auction;
        return Enrollment::create([
            'user' => $this->id,
            'auction' => $idAuction,
            'cover' => $cover,
            'totalbids' => 0,
            'bids' => 10,
            'offer' => 0
        ]);
    }
    
    public function bid($enrollment, $offer) {
        if(is_a($enrollment, Enrollment::class)){
            $objEnrollment  = $enrollment;
        } else if(is_numeric($enrollment)){
            $objEnrollment = Enrollment::getById($enrollment);
        } else {
            throw new Exception("Subasta no valida");
        }
        
        $bid = new Bid([
            'offer' => $offer,
            'enrollment' => $objEnrollment->id,
            'auction' => $objEnrollment->acution()->id
        ]);
        $this->binds()->add($bid);
    }
    public function __construct(array $attributes = array()) {
        parent::__construct($attributes);
    }
}
