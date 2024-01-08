<?php

use craft\elements\Entry;
use craft\helpers\UrlHelper;

return [
    'endpoints' => [
        '/api/cars' => function() {
            return [
                'elementType' => Entry::class,
                'criteria' => ['section' => 'news'],
                'cache' => false,
                'serializer' => 'jsonFeed',
                'transformer' => function(Entry $entry) {
                    return [
                        'id' => $entry->id,
                        'title' => $entry->title,
                        'intro' => $entry->introText,
                        'bannerImg' => str_replace("https", "http", $entry->bannerImage->one()->getUrl('banner')),
                        'thumbImg' => str_replace("https", "http", $entry->bannerImage->one()->getUrl('thumbnail')),
                    ];
                },
            ];
        },
        '/api/cars/<carName:{slug}>' => function($carName) {
            return [
                'elementType' => Entry::class,
                'criteria' => ['id' => $carName],
                'cache' => false,
                'serializer' => 'jsonFeed',
                'one' => true,
                'transformer' => function(Entry $entry) {
                    return [
                      'id' => $entry->id,
                      'title' => $entry->title,
                      'fullText' => $entry->fullText,
                      'headerImg' => str_replace("https", "http", $entry->bannerImage->one()->getUrl('header'))
                    ];
                },
            ];
        },
    ]
];