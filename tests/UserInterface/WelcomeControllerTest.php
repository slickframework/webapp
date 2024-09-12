<?php
/**
 * This file is part of webapp
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Test\App\UserInterface;

use App\UserInterface\WelcomeController;
use PHPUnit\Framework\TestCase;
use Slick\Template\TemplateEngineInterface;

class WelcomeControllerTest extends TestCase
{

    public function testWelcome(): void
    {
        $engine = $this->createMock(TemplateEngineInterface::class);
        $engine->method('parse')->with("welcome.html.twig")->willReturn($engine);
        $engine->method('process')->willReturn('Test');
        $controller = new WelcomeController();
        $controller->withTemplateEngine($engine);
        $response = $controller->welcome();
        $this->assertEquals(200, $response->getStatusCode());
    }
}
