<?php

namespace Chiquitto\Resizator;


use Intervention\Image\ImageManagerStatic;

class Resizator
{
    public static $families = [];
    public static $defaultStorage;

    /**
     * @param $idFamily
     * @return ImgFamily
     */
    public static function factoryFamily($idFamily)
    {
        return ImgFamily::factoryFamily($idFamily);
    }

    public static function generateThumbs($pathImg, ImgFamily $imgList, array $params)
    {
        foreach ($imgList->getList() as $key => $img) {
            /* @var $img Img */
            self::generateThumb($pathImg, $img, $params);
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