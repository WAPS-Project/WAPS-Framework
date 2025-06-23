<?php

namespace Waps\Framework\Controller;

use Twig\Loader\FilesystemLoader;
use Twig\Environment;

abstract class BaseController
{
    protected static string $VIEW_ROOT;

    public function __construct()
    {
        if (!isset(self::$VIEW_ROOT)) {
            self::$VIEW_ROOT = dirname(__DIR__, 3) . '/page/';
        }
    }

    protected function redirect(string $url, int $statusCode = 302): void
    {
        header('Location: ' . $url, true, $statusCode);
        exit;
    }

    protected function renderView(string $viewPath, array $data = []): void
    {
        extract($data);
        include $viewPath;
    }

    protected function renderTwig(string $template, array $data = []): void
    {
        $loader = new FilesystemLoader(__DIR__ . '/../templates');
        $twig = new Environment($loader);
        echo $twig->render($template, $data);
    }
}
