<?php
namespace GlimGlam\Http\Controllers\Api;
class ContentController extends \GlimGlam\Libs\CoreUtils\ApiRestController{
    protected static $model = \GlimGlam\Models\Content::class;
    public function slug($slug){
        $slug = \GlimGlam\Models\Content::where('slug',$slug)->get();
        if(count($slug)){
            return $slug;
        }
        abort(404);
    }
}