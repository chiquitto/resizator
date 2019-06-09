<?php

namespace Chiquitto\Resizator\Storage;


interface PublicAccessStorage
{

    public function parsePublicPath(array $params);
    public function parsePublicDirectory(array $params);

}