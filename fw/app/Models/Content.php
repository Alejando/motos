<?php

namespace DwSetpoint\Models;
class Content  extends \DevTics\LaravelHelpers\Model\ModelBase{
    //  <editor-fold defaultstate="collapsed" desc="getContetBySlug">
    public static function getContetBySlug($slug, $returnQuery = false) {
        $query = self::where('slug', '=', $slug);
        if ($returnQuery) {
            return $query;
        }
        $result = $query->get();
        if (count($result)) {
            return $result[0];
        }
        return null;
    }
    // </editor-fold>
}