<?php

namespace GlimGlam\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable {
    use \GlimGlam\Libs\CoreUtils\traits\MethodsModelBase;
    protected $guarded = ['id'];    
    public $timestamps = false;
    
    
    const PROFILE_CLIENT = 1;
    const PROFILE_ADMIN = 2;
    const GENDER_MALE = 1;
    const GENDER_FEMALE = 0;
    public function isMale(){
        return $this->gender == self::GENDER_MALE;
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'gender'
    ];
    protected $visible = array('name', 'email');
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    public function preferences(){
        return $this->belongsToMany('\GlimGlam\Models\Preference');
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
