<?php

namespace Chiquitto\Resizator;

/*
ID - id no arquivo config

ORIGINAL - Imagem original (a partir dessa imagem que sera aplicada os filtros)
FILENAME - nome do arquivo
FILTERS - Lista de filtros


*/

use Chiquitto\Resizator\Storage\AbstractStorage;
use Chiquitto\Resizator\Storage\LocalStorage;
use Intervention\Image\Image;

/**
 * Class Img
 * @package Chiquitto\Resizator
 */
class Img
{
    /**
     * Id in config img
     * @var string
     */
    private $id;
    private $filename;
    private $filters;
    private $original;

    /**
     * @var AbstractStorage
     */
    private $storage;

    public function __construct(array $args)
    {
        $this->id = $args['id'];
        $this->filename = $args['filename'];
        $this->filters = $args['filters'] ?? [];
        $this->original = $args['original'] ?? null;

        $this->storage = new Resizator::$defaultStorage($this);
    }

    /**
     * @return mixed
     */
    public function getFilename()
    {
        return $this->filename;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * Return absolute path in storage
     */
    public function parseAbsolutePath(array $params = []) {
        return $this->storage->parseAbsolutePath($params);
    }

    public function save(Image $image, array $params)
    {
        $this->storage->save($image, $params);
    }


}