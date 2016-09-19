<?php

namespace GlimGlam\Libs\Helpers;
/**
 * JfcoDiaz
 */
class Img {
    public static function resizeImg($source, $width, $height, $pathCache, $returnData) {
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
    public static function resizeImgOutbound($source, $width, $height, $pathCache, $returnData) {
        $img = new \Imagine\Gd\Imagine();
        $size = new \Imagine\Image\Box($width, $height);
        $mode = \Imagine\Image\ImageInterface::THUMBNAIL_OUTBOUND;
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
}