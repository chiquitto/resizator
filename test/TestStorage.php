<?php

use Chiquitto\Resizator\Storage\LocalStorage;

class TestStorage extends LocalStorage
{

    public function __construct(\Chiquitto\Resizator\Img $img)
    {
        parent::__construct($img);

        $this->setBasePath(__DIR__ . '/img');
    }

}