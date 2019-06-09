<?php

namespace Chiquitto\Resizator;


use Intervention\Image\ImageManagerStatic;

class Resizator
{
    public static $families = [];
    public static $defaultStorage;

    /**
     * @param $idFamily
     * @return ImgList
     */
    public static function factoryFamily($idFamily)
    {
        return ImgList::factoryFamily($idFamily);
    }

    public static function generateThumbs($pathImg, ImgList $imgList, array $params)
    {
        $newParams = [];
        foreach ($params as $k => $v) {
            $newParams['{' . $k . '}'] = $v;
        }

        foreach ($imgList->getList() as $key => $img) {
            /* @var $img Img */
            self::generateThumb($pathImg, $img, $newParams);
        }

        return true;
    }

    private static function generateThumb($originPath, Img $img, array $params)
    {
        $image = ImageManagerStatic::make($originPath);

        // apply filters

        // save
        $img->save($image, $params);

        // clean memory
        $image->destroy();
        unset($image);

        return true;
    }

}