<?php

/**
 * This file is part of slick/webapp package
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

$settings = [];

// ---------------------------
// Environment settings
// ---------------------------
$settings['environment'] = 'production';

// ---------------------------
// Database settings
// ---------------------------
$settings['database'] = [
    'default' => ['url' => 'sqlite://'.__DIR__.'/db.sqlite']
];

// ---------------------------
// Local settings override
// ---------------------------
if (file_exists(__DIR__.'/settings-local.php')) {
    include __DIR__.'/settings-local.php';
}

return $settings;