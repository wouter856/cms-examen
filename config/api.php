<?php

use craft\elements\Entry;
use craft\helpers\UrlHelper;

return [
    'endpoints' => [
        '/api/vehicles' => function() {
            return [
                'elementType' => Entry::class,
                'criteria' => ['section' => 'vehicles'],
                'cache' => false,
                'serializer' => 'jsonFeed',
                'transformer' => function(Entry $entry) {
                    return [
                        'name' => $entry->title,
                        'summary' => $entry->summaryText,
                        'image' => str_replace("https", "http", $entry->carImage->one()->getUrl('banner')),
                        'text' => $entry->text,
                    ];
                },
            ];
        },
        '/api/vehicles/<carName:{slug}>' => function($carName) {
            return [
                'elementType' => Entry::class,
                'criteria' => ['slug' => $carName],
                'cache' => false,
                'serializer' => 'jsonFeed',
                'one' => true,
                'transformer' => function(Entry $entry) {
                    return [
                        'name' => $entry->title,
                        'fullText' => $entry->text,
                        'image' => str_replace("https", "http", $entry->carImage->one()->getUrl('banner')),
                        'text' => $entry->text,
                    ];
                },
            ];
        },
    ],
];