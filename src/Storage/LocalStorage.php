<?php


namespace Chiquitto\Resizator\Storage;

use Chiquitto\Resizator\Img;
use Intervention\Image\Image as InterventionImage;


abstract class LocalStorage extends AbstractStorage
{

    public function save(InterventionImage $interventionImage, Img $img, array $params)
    {
        $dest = $this->parsePrivateFileName($img, $params);
        $this->checkDir($dest);
        $interventionImage->save($dest);
    }

    private function checkDir($path)
    {
        $dir = dirname($path);
        if (!is_dir($dir)) {
            mkdir($dir, 0777, true);
        }
    }

}