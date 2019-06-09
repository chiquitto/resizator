<?php

use Chiquitto\Resizator\Img;
use Chiquitto\Resizator\Storage\LocalStorage;
use Chiquitto\Resizator\Storage\PublicAccessStorage;

class LocalTestStorage extends LocalStorage implements PublicAccessStorage
{

    public function __construct(Img $img)
    {
        parent::__construct($img);

        $this->setBasePath(__DIR__);
        $this->setDir('img/');
    }

    public function parsePublicPath(array $params)
    {
        return "https://resizator.chiquitto.com.br/" . $this->parseDirectory($params);
    }

    public function parsePublicDirectory(array $params)
    {
        return $this->parseDirectory($params);
    }

}