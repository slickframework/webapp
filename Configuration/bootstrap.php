<?php

/**
 * Application bootstrap file
 *
 * @package   Configuration
 * @author    Filipe Silva <filipe.silva@sata.pt>
 * @copyright 2014 Grupo SATA
 * @since     Version 1.0.0
 *
 * @var \Slick\Mvc\Application $this
 */

/**
 * Set locale for the based on the browser accept language
 */
$locale = \Locale::acceptFromHttp($_SERVER['HTTP_ACCEPT_LANGUAGE']);
$this->translator->setLocale($locale);