<?php

return [
    'post' => [
        'filename' => 'p/{idPost}.jpg',
        'filters' => [],
    ],

    'post-g' => [
        'filename' => 'p/{idPost}g.jpg',
        'filters' => [
            [
                'filter' => \Chiquitto\Resizator\Filter\ResizeOutFilter::class,
                'config' => [
                    'height' => 300,
                    'width' => 300,
                ]
            ]
        ],
        'original' => 'post'
    ],
];