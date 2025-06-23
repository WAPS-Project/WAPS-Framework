<?php
declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

use PHPUnit\Framework\TestCase;
use Waps\Framework\Controller\Router;
use Waps\Framework\Controller\Request;

class RouterTest extends TestCase
{
    public function testHomeRouteResolvesToHomeController(): void
    {
        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['REQUEST_URI'] = '/Home';
        $router = new Router();
        ob_start();
        $router->route();
        $output = ob_get_clean();
        if (empty($output)) {
            fwrite(STDERR, "[DEBUG] Output is empty\n");
        } else {
            fwrite(STDERR, "[DEBUG] Output: $output\n");
        }
        $this->assertStringContainsString('Welcome Home', $output);
    }
}
