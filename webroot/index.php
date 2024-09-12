<?php

/**
 * Application startup script
 */

namespace App\StartScript;

use Slick\ErrorHandler\Runner;
use Slick\ErrorHandler\Util\SystemFacade;
use Slick\Http\Message\Server\Request;
use Slick\Template\UserInterface\PrettyErrorHandler;
use Slick\WebStack\Infrastructure\FrontController\WebApplication;

require_once dirname(__DIR__).'/vendor/autoload.php';

// ------------------------------------------------------
//  Exception/Error handling
// ------------------------------------------------------
$runner = new Runner(new SystemFacade(), dirname(__DIR__).'/src');
$runner
    ->pushHandler(PrettyErrorHandler::create())
    ->register();

// ------------------------------------------------------
//  Initialize application
// ------------------------------------------------------
$request = new Request();
$application = new WebApplication($request, dirname(__DIR__));

// ------------------------------------------------------
//  Load any bootstrap actions
// ------------------------------------------------------
$bootstrapFile = APP_ROOT . '/config/bootstrap.php';
if (is_file($bootstrapFile)) {
    include_once $bootstrapFile;
}

// ------------------------------------------------------
//  Run application and output the response.
// ------------------------------------------------------
$application->output($application->run());
