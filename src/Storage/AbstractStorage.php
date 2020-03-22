<?php

namespace Chiquitto\Resizator\Storage;

use Chiquitto\Resizator\Img;
use Intervention\Image\Image as InterventionImage;

abstract class AbstractStorage
{

    abstract public function getPrivateDir();

    abstract public function getPublicDir();

    abstract public function save(InterventionImage $interventionImage, Img $img, array $params);

    public function parsePrivateFileName(Img $img, $params = []) {
        return strtr($this->getPrivateDir() . '/' . $img->getFilename(), $params);
    }

    public function parsePublicFileName(Img $img, $params = []) {
        return strtr($this->getPublicDir() . '/'  . $img->getFilename(), $params);
    }

}