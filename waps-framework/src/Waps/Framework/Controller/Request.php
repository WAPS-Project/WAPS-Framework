<?php

namespace Waps\Framework\Controller;

class Request
{
    public string $method;
    public string $path;
    public array $query;
    public array $post;
    public array $server;
    public array $params = [];

    public function __construct()
    {
        $this->method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
        $this->path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) ?? '/';
        $this->query = $_GET;
        $this->post = $_POST;
        $this->server = $_SERVER;
    }
}
