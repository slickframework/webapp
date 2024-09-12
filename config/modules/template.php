<?php

/**
 * This file is part of template module
 */

return [
    'paths' => [dirname(__DIR__, 2) . '/templates'],
    'options' => [
        'debug' => isset($_ENV["APP_ENV"]) ? $_ENV["APP_ENV"] == 'develop' : false,
    ],
    'framework' => 'bulma',
    'theme' => 'sandstone'
];
 