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

    private $dir = '';

    abstract public function parseAbsolutePath(array $params = []);

    public function __construct(Img $img)
    {
        $this->img = $img;
    }

    abstract public function save(Image $interventionImage, array $params);

    public function parseFilename(array $params = []) {
        return strtr($this->img->getFilename(), $params);
    }

    public function parseDirectory(array $params = []) {
        return $this->getDir() . '/' . $this->parseFilename($params);
    }

    /**
     * @return string
     */
    public function getDir(): string
    {
        return $this->dir;
    }

    /**
     * @param string $dir
     */
    public function setDir(string $dir): void
    {
        $this->dir = trim($dir, '/');
    }

}