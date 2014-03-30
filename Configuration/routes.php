<?php

/**
 * Routes configuration file
 *
 * @package   Configuration
 * @author    Filipe Silva <filipe.silva@sata.pt>
 * @copyright 2014 Grupo SATA
 * @since     Version 1.0.0
 *
 * @var \Slick\Mvc\Router $router
 */

$router->addRoute(
    new \Slick\Mvc\Router\Route\Simple(
        [
            'pattern' => '',
            'controller' => 'dashboard',
            'action' => 'home'
        ]
    )
);

$router->addRoute(
    new \Slick\Mvc\Router\Route\Simple(
        [
            'pattern' => ':controller/list',
            'action' => 'index'
        ]
    )
);