<?php

/**
 * This file is part of slick/webapp package
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace config;

use Doctrine\DBAL\DBALException;
use Doctrine\ORM\ORMException;
use Doctrine\ORM\Tools\Console\ConsoleRunner;
use Infrastructure\Persistence\Doctrine\EntityManagerFactory;
use Slick\Configuration\Configuration;

require_once dirname(__DIR__).'/vendor/autoload.php';

Configuration::addPath(__DIR__);
$settings = Configuration::get('settings')->get('database');

try {
    $entityCollection = (new EntityManagerFactory($settings, null, true))->entityManagersCollection();
    return ConsoleRunner::createHelperSet($entityCollection->get('default'));
} catch (ORMException $caught) {
    print "Error: {$caught->getMessage()}";
} catch (DBALException $caught) {
    print "Error: {$caught->getMessage()}";
}


