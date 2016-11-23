<?php

namespace DwSetpoint\Http\Controllers\Api;
use DwSetpoint\Models\Content;
class ContentController extends \DevTics\LaravelHelpers\Rest\ApiRestController {
    protected static $model = \DwSetpoint\Models\Content::class;

    public function updateContent() {
        $slug = Input::get('slug');
        $newContent = Input::get('newContent');
        $content = Content::where('slug', $slug)->first()->get();
        $content->content = $newContent;
        $content->save();
    }

}