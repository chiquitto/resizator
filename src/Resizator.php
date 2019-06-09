<?php

namespace Chiquitto\Resizator;


use Chiquitto\Resizator\Filter\AbstractFilter;
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

    public static function generateThumbs($pathImg, ImgFamily $imgFamily, array $params)
    {
        foreach ($imgFamily->getList() as $key => $img) {
            /* @var $img Img */
            self::generateThumb($pathImg, $img, $params);
        }

        return true;
    }

    private static function generateThumb($originPath, Img $img, array $params)
    {
        $interventionImage = ImageManagerStatic::make($originPath);

        // apply filters
        $img->applyFilters($interventionImage);

        // save
        $img->save($interventionImage, $params);

        // clean memory
        $interventionImage->destroy();
        unset($interventionImage);

        return true;
    }

}