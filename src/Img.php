<?php

namespace Chiquitto\Resizator;

/*
ID - id no arquivo config

ORIGINAL - Imagem original (a partir dessa imagem que sera aplicada os filtros)
FILENAME - nome do arquivo
FILTERS - Lista de filtros


*/

use Chiquitto\Resizator\Filter\AbstractFilter;
use Chiquitto\Resizator\Storage\AbstractStorage;
use Chiquitto\Resizator\Storage\PublicAccessStorage;
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
     * @var AbstractStorage|PublicAccessStorage
     */
    private $storage;

    public function __construct(array $args)
    {
        $this->id = $args['id'];
        $this->filename = $args['filename'];
        $this->filters = $args['filters'] ?? [];
        $this->original = $args['original'] ?? null;
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
        return $this->getStorage()->parseAbsolutePath($params);
    }

    public function parsePublicPath(array $params = []) {
        return $this->getStorage()->parsePublicPath($params);
    }

    public function parseDirectory(array $params = []) {
        return $this->getStorage()->parseDirectory($params);
    }

    public function save(Image $interventionImage, array $params)
    {
        $this->getStorage()->save($interventionImage, $params);
    }

    /**
     * @return AbstractStorage|PublicAccessStorage
     */
    private function getStorage()
    {
        if ($this->storage === null) {
            $this->storage = new Resizator::$defaultStorage($this);
        }
        return $this->storage;
    }

    public function applyFilters(Image $interventionImage) {
        foreach ($this->filters as $filterConfig) {
            $filter = AbstractFilter::getInstance($filterConfig['filter']);
            $filter->run($interventionImage, $filterConfig['config']);
        }
    }




}