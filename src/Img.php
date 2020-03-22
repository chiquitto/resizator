<?php

namespace Chiquitto\Resizator;

use Chiquitto\Resizator\Filter\AbstractFilter;
use Intervention\Image\Image as InterventionImage;

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

    public function __construct(array $args)
    {
        $this->id = $args['id'];
        $this->filename = $args['filename'];
        $this->filters = $args['filters'] ?? [];
        $this->original = $args['original'] ?? null;
    }

    public function applyFilters(InterventionImage $interventionImage)
    {
        foreach ($this->filters as $filterConfig) {
            $filter = AbstractFilter::getInstance($filterConfig['filter']);
            $filter->run($interventionImage, $filterConfig['config']);
        }
    }

    /**
     * @return mixed
     */
    public function getFilename()
    {
        return $this->filename;
    }

    /**
     * @return array|mixed
     */
    public function getFilters()
    {
        return $this->filters;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return mixed|null
     */
    public function getOriginal(): mixed
    {
        return $this->original;
    }

}
