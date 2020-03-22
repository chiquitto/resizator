<?php


namespace Chiquitto\Resizator;


use Chiquitto\Resizator\Storage\AbstractStorage;
use Intervention\Image\ImageManagerStatic;

class Resizator
{
    private static $families = [];
    private static $defaultStorage;
    private static $storageInstance;

    /**
     * @param $idFamily
     * @return ImgFamily
     */
    public static function factoryFamily(string $idFamily)
    {
        return ImgFamily::factoryFamily($idFamily);
    }

    public static function generateThumbs(string $origin, ImgFamily $imgFamily, array $params = [])
    {
        foreach ($imgFamily->getList() as $key => $img) {
            /* @var $img Img */
            static::generateThumb($origin, $img, $params);
        }

        return true;
    }

    private static function generateThumb($origin, Img $img, array $params = [])
    {
        $storage = self::getStorage();
        // $origin = $storage->parsePrivateFileName($img, $params);

        $interventionImage = ImageManagerStatic::make($origin);

        // apply filters
        $img->applyFilters($interventionImage);

        // save
        $storage->save($interventionImage, $img, $params);
    }

    /**
     * @return AbstractStorage
     */
    public static function getStorage()
    {
        if (static::$storageInstance === null) {
            static::$storageInstance = new static::$defaultStorage();
        }
        return static::$storageInstance;
    }

    /**
     * @return array
     */
    public static function getFamilies(): array
    {
        return self::$families;
    }

    /**
     * @param array $families
     */
    public static function setFamilies(array $families)
    {
        self::$families = $families;
    }

    /**
     * @param mixed $defaultStorage
     */
    public static function setDefaultStorage($defaultStorage)
    {
        self::$defaultStorage = $defaultStorage;
    }


}