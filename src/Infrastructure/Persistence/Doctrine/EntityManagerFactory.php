<?php

/**
 * This file is part of slick/webapp package
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Infrastructure\Persistence\Doctrine;

use Doctrine\Common\Cache\CacheProvider;
use Doctrine\DBAL\Types\Type;
use Doctrine\ORM\Configuration;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;

/**
 * Entity Manager Factory
 *
 * @package Infrastructure\Persistence\Doctrine
 */
final class EntityManagerFactory
{
    /**
     * @var array
     */
    private $settings;

    /**
     * @var CacheProvider|null
     */
    private $cacheProvider;

    /**
     * @var bool
     */
    private $devMode;

    /**
     * @var EntityManagerCollection
     */
    private static $collection;

    /**
     * @var string
     */
    private $mappingDir = '/Doctrine/Mapping';

    /**
     * @var string
     */
    private $proxyDir = '/Doctrine/Proxies';

    /**
     * @var string
     */
    private $proxyNamespace = 'Infrastructure\Persistence\Doctrine\Proxies';

    /**
     * Creates an Entity Manager Factory
     *
     * @param array $settings
     * @param CacheProvider|null $cacheProvider
     * @param bool $devMode
     *
     * @throws \Doctrine\DBAL\DBALException
     */
    public function __construct(array $settings, CacheProvider $cacheProvider = null, bool $devMode = false)
    {
        $this->settings = $settings;
        $this->cacheProvider = $cacheProvider;
        $this->devMode = $devMode;
        self::addCustomTypes();
    }

    /**
     * Adds defined custom types
     *
     * @throws \Doctrine\DBAL\DBALException
     */
    public static function addCustomTypes()
    {
        foreach (DoctrineCustomDataTypes::$types as $name => $type) {
            Type::addType($name, $type);
        }
    }

    /**
     * Returns the entity managers collection
     *
     * @return EntityManagerCollection
     *
     * @throws \Doctrine\ORM\ORMException
     */
    public function entityManagersCollection(): EntityManagerCollection
    {
        if (!self::$collection instanceof EntityManagerCollection) {
            self::$collection = $this->createCollection();
        }
        return self::$collection;
    }

    /**
     * @return EntityManagerCollection
     *
     * @throws \Doctrine\ORM\ORMException
     */
    private function createCollection(): EntityManagerCollection
    {
        $collection = new EntityManagerCollection();
        foreach ($this->settings as $name => $setting) {
            $collection->add($name, EntityManager::create($setting, $this->configuration($name)));
        }
        return $collection;
    }

    /**
     * Creates the ORM configuration
     *
     * @param string $name
     *
     * @return Configuration
     */
    private function configuration(string $name): Configuration
    {
        $config = Setup::createYAMLMetadataConfiguration(
            [dirname(__DIR__)."{$this->mappingDir}/{$name}"],
            $this->devMode
        );

        $this->configProxySettings($config);

        if (!$this->devMode && $this->cacheProvider) {
            $config->setMetadataCacheImpl($this->cacheProvider);
            $config->setQueryCacheImpl($this->cacheProvider);
        }

        return $config;
    }

    /**
     * Set proxy configuration settings
     *
     * @param Configuration $config
     */
    private function configProxySettings(Configuration $config): void
    {
        $config->setProxyDir(dirname(__DIR__) . $this->proxyDir);
        $config->setProxyNamespace($this->proxyNamespace);

        if (!$this->devMode) {
            $config->setAutoGenerateProxyClasses(false);
        }
    }
}
