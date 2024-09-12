<?php

/**
 * This file is part of webapp
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace App\UserInterface;

use Psr\Http\Message\ResponseInterface;
use Slick\Template\UserInterface\TemplateMethods;
use Symfony\Component\Routing\Attribute\Route;

/**
 * WelcomeController
 *
 * @package App\UserInterface
 */
final class WelcomeController
{

    use TemplateMethods;

    #[Route(path: '/', name: 'welcome')]
    public function welcome(): ResponseInterface
    {
        return $this->render("welcome.html.twig");
    }
}
