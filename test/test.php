<?php

use Chiquitto\Resizator\Resizator;

require __DIR__ . '/../vendor/autoload.php';

Resizator::$families = require __DIR__ . '/config.php';

$family = Resizator::factoryFamily('post');

Resizator::generateThumbs(__DIR__ . '/php-1920x800.jpg', $family, [
    'idPost' => 10
]);