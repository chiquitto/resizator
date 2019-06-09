<?php

use Chiquitto\Resizator\Img;
use Chiquitto\Resizator\ImgFamily;
use Chiquitto\Resizator\Resizator;

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/TestStorage.php';

Resizator::$families = require __DIR__ . '/config.php';
Resizator::$defaultStorage = TestStorage::class;

/** @var ImgFamily $family */
$family = Resizator::factoryFamily('post');

Resizator::generateThumbs(__DIR__ . '/php-1920x800.jpg', $family, [
    '{idPost}' => 10
]);

foreach ($family->getList() as $item) {
    /** @var Img $item */

    echo str_repeat('=', 10) . "\n";
    echo "ID: {$item->getId()}\n";
    echo "ABS.PATH: {$item->parseAbsolutePath(['{idPost}' => 10])}\n";
    echo str_repeat('=', 10) . "\n\n";
}