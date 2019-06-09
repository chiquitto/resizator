<?php

use Chiquitto\Resizator\Storage\LocalStorage;

class LocalTestStorage extends LocalStorage
{

    public function __construct(\Chiquitto\Resizator\Img $img)
    {
        parent::__construct($img);

        $this->setBasePath(__DIR__ . '/img');
    }

}