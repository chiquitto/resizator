<?php

use Chiquitto\Resizator\Storage\LocalStorage;
use Chiquitto\Resizator\Storage\PublicAccessStorage;

class LocalTestStorage extends LocalStorage
{
    public function getPrivateDir()
    {
        return __DIR__ . '/img';
    }

    public function getPublicDir()
    {
        return '/img';
    }
}