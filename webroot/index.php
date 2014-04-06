<?php

/**
 * Slick Framework web application startup application
 *
 * @package    SlickCms
 * @author     Filipe Silva <silvam.filipe@gmail.com>
 * @copyright  2014 Filipe Silva
 * @license    http://www.opensource.org/licenses/mit-license.php MIT License
 * @since      Version 1.0.0
 */

use Slick\Configuration\Configuration,
    Slick\Mvc\Application;

// Set the base directory for this application
chdir(dirname(__DIR__));

/** @var Composer\Autoload\ClassLoader $autoload */
$autoload = require_once 'vendor/autoload.php';

// Create application
Configuration::addPath(getcwd() . '/Configuration');
$app = new Application();

// Application bootstrap
$app->bootstrap();
$app->run();


$app->getResponse()->send();
