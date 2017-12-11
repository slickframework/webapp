<?php

/**
 * This file is part of slick/webapp package
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace spec\Infrastructure\Persistence\Doctrine;

use Doctrine\ORM\EntityManager;
use Infrastructure\Persistence\Doctrine\EntityManagerCollection;
use PhpSpec\ObjectBehavior;

/**
 * Entity Manager Collection Specs
 *
 * @package spec\Infrastructure\Persistence\Doctrine
 */
class EntityManagerCollectionSpec extends ObjectBehavior
{

    function it_is_initializable()
    {
        $this->shouldHaveType(EntityManagerCollection::class);
    }

    function it_can_add_entity_manager_under_a_name(EntityManager $entityManager)
    {
        $this->add('test-manager', $entityManager)->shouldBe($this->getWrappedObject());
    }

    function it_can_retrieve_entity_managers_by_its_name(EntityManager $entityManager)
    {
        $this->add('other-manager', $entityManager);
        $this->get('other-manager')->shouldBe($entityManager);
    }

    function it_throws_an_exception_when_no_entity_manager_is_found()
    {
        $this->shouldThrow(\RuntimeException::class)
            ->during('get', ['test']);
    }

    function it_can_be_counted(EntityManager $entityManager)
    {
        $this->shouldImplement(\Countable::class);
        $this->add('test', $entityManager);
        $this->count()->shouldBe(1);
    }

    function it_can_be_traversed()
    {
        $this->shouldBeAnInstanceOf(\IteratorAggregate::class);
        $this->getIterator()->shouldBeAnInstanceOf(\ArrayIterator::class);
    }
}
