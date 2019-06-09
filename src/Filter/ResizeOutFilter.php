<?php

namespace Chiquitto\Resizator\Filter;

use Intervention\Image\Image;

class ResizeOutFilter extends AbstractFilter
{
    public function run(Image $image, array $config)
    {
        $newWidth = (int) ($image->width() * $config['height'] / $image->height());
        $newHeight = (int) ($image->height() * $config['width'] / $image->width());

        if ($newWidth > $config['width']) {
            $newHeight = $config['height'];
        } else {
            $newWidth = $config['width'];
        }

        $image->resize($newWidth, $newHeight);
        $image->resizeCanvas($config['width'], $config['height'], 'center', false, '#FFFFFF');
    }
}