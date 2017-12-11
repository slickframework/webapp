<?php

/**
 * This file is part of slick/webapp package
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Infrastructure\Persistence\Doctrine;

use Doctrine\ORM\EntityManager;
use Traversable;

/**
 * Doctrine Entity Manager Collection
 *
 * @package Infrastructure\Persistence\Doctrine
 */
class EntityManagerCollection implements \Countable, \IteratorAggregate
{

    /**
     * @var EntityManager[]
     */
    private $collection = [];

    /**
     * Adds an entity manager to the entity collection
     *
     * @param string $name
     * @param EntityManager $entityManager
     *
     * @return EntityManagerCollection
     */
    public function add(string $name, EntityManager $entityManager): EntityManagerCollection
    {
        $this->collection[$name] = $entityManager;
        return $this;
    }

    /**
     * Get the entity manager stored under provided key
     *
     * @param string $name
     *
     * @return EntityManager
     */
    public function get(string $name): EntityManager
    {
        if (! array_key_exists($name, $this->collection)) {
            throw new \RuntimeException(
                "There are no entity manager stored under key '{$name}'"
            );
        }
        return $this->collection[$name];
    }

    /**
     * Count the entity managers currently in the collection
     *
     * @return int The custom count as an integer.
     *
     * The return value is cast to an integer.
     * @since 5.1.0
     */
    public function count(): int
    {
        return count($this->collection);
    }

    /**
     * Retrieve an external iterator
     *
     * @return \ArrayIterator|Traversable
     */
    public function getIterator(): Traversable
    {
        return new \ArrayIterator($this->collection);
    }
}
