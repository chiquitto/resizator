<?php

namespace Chiquitto\Resizator\Storage;


use Chiquitto\Resizator\Img;
use Intervention\Image\Image;

abstract class AbstractStorage
{

    /**
     * @var Img
     */
    private $img;

    abstract public function parseAbsolutePath(array $params = []);

    public function __construct(Img $img)
    {
        $this->img = $img;
    }

    public function parseFilename(array $params = []) {
        return strtr($this->img->getFilename(), $params);
    }

    abstract public function save(Image $image, array $params);

}