<?php

/**
 * This file is part of slick/webapp package
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */


namespace spec\UserInterface\Controller;

use PhpSpec\ObjectBehavior;
use Slick\WebStack\ControllerInterface;
use UserInterface\Controller\Pages;

/**
 * Pages controller Specs
 *
 * @package spec\UserInterface\Controller
 */
class PagesSpec extends ObjectBehavior
{

    function its_a_controller()
    {
        $this->shouldBeAnInstanceOf(ControllerInterface::class);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Pages::class);
    }

    function it_handles_home_page_requests()
    {
        $this->home();
        $this->data()->shouldHaveKeyWithValue('message', 'Slick web application startup!');
    }
}
