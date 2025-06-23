<?php

namespace Waps\Framework\Controller;

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
            $controllerName = __NAMESPACE__ . '\\' . $routes[$uri];
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
                    $controllerName = __NAMESPACE__ . '\\' . $controllerClass;
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
        $errorController = __NAMESPACE__ . '\\Error404Controller';
        if (class_exists($errorController)) {
            $controller = new $errorController();
            $controller->render($request);
        } else {
            include __DIR__ . '/../page/static/Error_404.page.php';
        }
    }
}
