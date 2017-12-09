<?php

/**
 * This file is part of slick/webapp package
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace UserInterface\Controller;

use Slick\WebStack\Controller\ControllerMethods;
use Slick\WebStack\ControllerInterface;

/**
 * Pages controller
 *
 * @package UserInterface\Controller
 */
class Pages implements ControllerInterface
{
    use ControllerMethods;


    public function home()
    {
        $this->set('message', 'Slick web application startup!');
    }
}
