<?php

namespace Waps\Framework\Controller;

use Waps\Framework\Http\Request;
use Waps\Framework\Http\Response;
use Twig\Loader\FilesystemLoader;
use Twig\Environment;

abstract class Controller implements ControllerInterface
{
    protected Request $request;
    protected Response $response;
    protected static string $VIEW_ROOT;

    public function __construct()
    {
        $this->response = new Response();
        if (!isset(self::$VIEW_ROOT)) {
            self::$VIEW_ROOT = dirname(__DIR__, 3) . '/page/';
        }
    }

    /**
     * Render the controller action
     *
     * @param Request $request
     * @return void
     */
    public function render(Request $request): void
    {
        $this->request = $request;
        $this->handle();
    }

    /**
     * Handle the request - to be implemented by child classes
     *
     * @return void
     */
    abstract protected function handle(): void;

    /**
     * Redirect to another URL
     *
     * @param string $url
     * @param int $statusCode
     * @return void
     */
    protected function redirect(string $url, int $statusCode = 302): void
    {
        $this->response->setStatusCode($statusCode);
        $this->response->addHeader('Location', $url);
        $this->response->send();
        exit;
    }

    /**
     * Render a view file
     *
     * @param string $viewPath
     * @param array $data
     * @return void
     */
    protected function renderView(string $viewPath, array $data = []): void
    {
        extract($data);
        include $viewPath;
    }

    /**
     * Render a Twig template
     *
     * @param string $template
     * @param array $data
     * @return void
     */
    protected function renderTwig(string $template, array $data = []): void
    {
        $loader = new FilesystemLoader(__DIR__ . '/../templates');
        $twig = new Environment($loader);
        echo $twig->render($template, $data);
    }

    /**
     * Return JSON response
     *
     * @param array $data
     * @param int $statusCode
     * @return void
     */
    protected function json(array $data, int $statusCode = 200): void
    {
        $this->response->setStatusCode($statusCode);
        $this->response->addHeader('Content-Type', 'application/json');
        $this->response->setContent(json_encode($data));
        $this->response->send();
    }
}
