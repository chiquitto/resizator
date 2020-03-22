<?php

use Chiquitto\Resizator\Img;
use Chiquitto\Resizator\ImgFamily;
use Chiquitto\Resizator\Resizator;

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/LocalTestStorage.php';
// require __DIR__ . '/AwsS3TestStorage.php';

Resizator::setFamilies(require __DIR__ . '/img.config.php');
Resizator::setDefaultStorage(LocalTestStorage::class);

/** @var ImgFamily $family */
$family = Resizator::factoryFamily('post');

$params = ['{idPost}' => 10];

Resizator::generateThumbs(__DIR__ . '/php-1920x800.jpg', $family, $params);

$sep = str_repeat('=', 10);
$storage = Resizator::getStorage();

foreach ($family->getList() as $item) {
    /** @var Img $item */

    echo <<<ECHO
$sep
ID: {$item->getId()}
PRIVATE: {$storage->parsePrivateFileName($item, $params)}
PUBLIC: {$storage->parsePublicFileName($item, $params)}
$sep


ECHO;
}