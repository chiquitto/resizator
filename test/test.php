<?php

use Chiquitto\Resizator\Img;
use Chiquitto\Resizator\ImgFamily;
use Chiquitto\Resizator\Resizator;

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/LocalTestStorage.php';
require __DIR__ . '/AwsS3TestStorage.php';

Resizator::$families = require __DIR__ . '/img.config.php';
Resizator::$defaultStorage = LocalTestStorage::class;
// Resizator::$defaultStorage = AwsS3TestStorage::class;

/** @var ImgFamily $family */
$family = Resizator::factoryFamily('post');

Resizator::generateThumbs(__DIR__ . '/php-1920x800.jpg', $family, [
    '{idPost}' => 10
]);

foreach ($family->getList() as $item) {
    /** @var Img $item */

    $sep = str_repeat('=', 10);

    echo <<<ECHO
$sep
ID: {$item->getId()}
PATH.ABS: {$item->parseAbsolutePath(['{idPost}' => 10])}
WEB.ABS: {$item->parsePublicPath(['{idPost}' => 10])}
WEB.SITE: {$item->parseDirectory(['{idPost}' => 10])}
$sep


ECHO;
}