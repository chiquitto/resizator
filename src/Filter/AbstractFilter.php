<?php

namespace Chiquitto\Resizator\Filter;


use Intervention\Image\Image;

abstract class AbstractFilter
{
    private static $filterInstances = [];

    abstract public function run(Image $image, array $config);

    /**
     * @param $filterName
     * @return AbstractFilter
     */
    public static function getInstance($filterName) {
        if (!isset(static::$filterInstances[$filterName])) {
            static::$filterInstances[$filterName] = new $filterName();
        }

        return static::$filterInstances[$filterName];
    }
}