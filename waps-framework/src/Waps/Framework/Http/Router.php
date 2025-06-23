<?php

namespace Waps\Framework\Http;

use Waps\Framework\Controller\ControllerInterface;

class Router
{
    public function route(): void
    {
        $request = new Request();
        $uri = $request->path;
        $routes = [
            '/' => 'HomeController',
            '/Home' => 'HomeController',
            '/Example' => 'ExampleController',
            '/Gallerytest' => 'GallerytestController',
            '/Settings' => 'SettingsController',
            '/Login' => 'LoginController',
            '/Impressum' => 'ImpressumController',
            '/Lchoice' => 'LchoiceController',
            '/Lg' => 'LgController',
            '/Pg' => 'PgController',
            '/Termsofuse' => 'TermsofuseController',
            // Beispiel für eine Parameterroute:
            '/user/{id}' => 'UserController',
        ];

        // Zuerst exakte Routen prüfen
        if (isset($routes[$uri])) {
            $controllerName = 'App\\Controller\\' . $routes[$uri];
            if (class_exists($controllerName)) {
                $controller = new $controllerName();
                if (method_exists($controller, 'render')) {
                    $controller->render($request);
                    return;
                }
            }
        }

        // Parameter-Routen prüfen
        foreach ($routes as $route => $controllerClass) {
            if (strpos($route, '{') !== false) {
                $pattern = preg_replace('#\{[^/]+\}#', '([^/]+)', $route);
                $pattern = '#^' . $pattern . '$#';
                if (preg_match($pattern, $uri, $matches)) {
                    array_shift($matches); // Erstes Element ist der volle Match
                    $controllerName = 'App\\Controller\\' . $controllerClass;
                    if (class_exists($controllerName)) {
                        $controller = new $controllerName();
                        if (method_exists($controller, 'render')) {
                            $request->params = $matches;
                            $controller->render($request);
                            return;
                        }
                    }
                }
            }
        }

        // Fallback: Error404Controller
        $errorController = 'App\\Controller\\Error404Controller';
        if (class_exists($errorController)) {
            $controller = new $errorController();
            $controller->render($request);
        } else {
            // Fallback zu statischer Seite
            http_response_code(404);
            echo '<h1>404 - Page Not Found</h1>';
        }
    }
}
