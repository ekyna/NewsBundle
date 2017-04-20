<?php

declare(strict_types=1);

use Ekyna\Bundle\NewsBundle\Model\NewsInterface;

return [
    NewsInterface::class => [
        'news{1..100}' => [
            '__factory' => [
                '@ekyna_news.factory.news::create' => [],
            ],
            'name'      => '<sentence()>',
            'title'     => '<sentence()>',
            'date'      => '<dateTimeBetween(\'-1 year\'))>',
            'enabled'   => '<enabled(80)>',
            'content'   => '<htmlParagraphs(4,6)>',
            'media'     => '70%? <randomImage()>',
        ],
    ],
];
