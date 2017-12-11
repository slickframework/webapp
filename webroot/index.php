<?php

/**
 * Application startup script
 */

namespace Test\App;

use Slick\Di\ContainerBuilder;
use Slick\Http\Message\Response;
use Slick\Http\Message\Server\Request;
use Slick\Http\Server\MiddlewareStack;

require dirname(__DIR__).'/vendor/autoload.php';

/** Application root directory */
define('APP_ROOT', dirname(__DIR__));
define('WEB_ROOT', dirname(__DIR__).'/webroot');

$container = (new ContainerBuilder(APP_ROOT.'/config/services'))->getContainer();

/** @var Response $response */
$response = $container->get(MiddlewareStack::class)
    ->process(new Request());

// Send response headers
foreach ($response->getHeaders() as $name => $value) {
    $line = implode(', ', $value);
    header("{$name}: $line");
}

// Send response body
echo $response->getBody();
