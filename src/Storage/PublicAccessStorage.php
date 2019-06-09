<?php
/**
 * Created by PhpStorm.
 * User: alisson
 * Date: 09/06/19
 * Time: 16:50
 */

namespace Chiquitto\Resizator\Storage;


interface PublicAccessStorage
{

    public function parsePublicPath(array $params);
    public function parsePublicDirectory(array $params);

}