<?php

namespace DwSetpoint\Models;
use Illuminate\Database\Eloquent\Model;

class PostalCode extends \DevTics\LaravelHelpers\Model\ModelBase {
    //
    public function postal_code_group() {
    	return $this->belongsTo(\DwSetpoint\Models\PostalCodeGroup::class, 'postal_code_group_id');
    }
    public static function getByCode($postal_code) {
        $postal_code = self::where('code','=', $postal_code)->get();
        if($postal_code->count()) {
            return $postal_code->get(0);
        }
        return null;
    }
}
