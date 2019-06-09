<?php

namespace Chiquitto\Resizator\Storage;


use Chiquitto\Resizator\Img;
use Intervention\Image\Image;

class LocalStorage extends AbstractStorage
{

    protected $basePath;

    public function __construct(Img $img)
    {
        parent::__construct($img);
    }

    public function parseAbsolutePath(array $params = [], $useCache = true) {
        return $this->basePath . '/' . $this->parseFilename($params, $useCache);
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

    /**
     * @param mixed $basePath
     */
    public function setBasePath($basePath): void
    {
        $this->basePath = $basePath;
    }



}