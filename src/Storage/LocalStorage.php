<?php

namespace Chiquitto\Resizator\Storage;


use Chiquitto\Resizator\Img;
use Intervention\Image\Image;

class LocalStorage extends AbstractStorage
{

    private $path;

    public function __construct(Img $img)
    {
        parent::__construct($img);

        $this->path = __DIR__;
    }

    public function parseAbsolutePath(array $params = [], $useCache = true) {
        return $this->path . '/' . $this->parseFilename($params, $useCache);
    }

    public function save(Image $image, array $params)
    {
        $absolutePath = $this->parseAbsolutePath($params, false);
        $this->checkDir($absolutePath);
        $image->save($absolutePath);
    }

    private function checkDir($path)
    {
        $dir = dirname($path);
        if (!is_dir($dir)) {
            mkdir($dir, 0777, true);
        }
    }

}