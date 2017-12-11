<?php

/**
 * This file is part of slick/webapp package
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Infrastructure\Persistence\Doctrine\DBAL;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;

/**
 * Class SimpleObjectType
 * @package Infrastructure\Persistence\Doctrine\DBAL
 */
abstract class SimpleObjectType extends StringType
{

    /**
     * Converts a value from its database representation to its PHP
     * representation of this type.
     *
     * @param mixed $value The value to convert.
     * @param AbstractPlatform $platform The currently used database platform.
     *
     * @return mixed The PHP representation of the value.
     */
    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        if (null == $value) {
            return $value;
        }
        $className = $this->getNamespace() . '\\' . $this->getName();
        return new $className($value);
    }

    /**
     * Returns the identity object name space
     *
     * @return string
     */
    abstract protected function getNamespace();
}
