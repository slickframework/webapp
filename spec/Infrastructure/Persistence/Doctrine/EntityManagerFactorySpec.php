<?php

namespace spec\Infrastructure\Persistence\Doctrine;

use Doctrine\Common\Cache\CacheProvider;
use Infrastructure\Persistence\Doctrine\EntityManagerCollection;
use Infrastructure\Persistence\Doctrine\EntityManagerFactory;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class EntityManagerFactorySpec extends ObjectBehavior
{

    private $devMode = true;

    private $settings = [
        'default' => ['url' => 'sqlite:///:memory']
    ];

    function let(CacheProvider $cacheProvider)
    {
        $this->beConstructedWith($this->settings, $cacheProvider, $this->devMode);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(EntityManagerFactory::class);
    }

    /**
     * @throws \Doctrine\ORM\ORMException
     */
    function it_creates_an_entity_manager_collection()
    {
        $collection = $this->entityManagersCollection();
        $collection->shouldBeAnInstanceOf(EntityManagerCollection::class);
        $collection->getIterator()->getArrayCopy()->shouldHaveKey('default');
    }
}
