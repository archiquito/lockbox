<?php

namespace Core;

class Route
{
    private array $routes = [];

    public function addRoute($httpMethod, $uri, $controller, $middleware = null)
    {
        if (is_string($controller)) {

            $data = [
                'class' => $controller,
                'method' => '__invoke',
                'middleware' => $middleware,
                'parameters' => $this->getUriParameters($uri)
            ];
        }
        if (is_array($controller)) {
            $data = [
                'class' => $controller[0],
                'method' => $controller[1],
                'middleware' => $middleware,
                'parameters' => $this->getUriParameters($uri)
            ];
        }


        $this->routes[$httpMethod][$uri] = $data;
    }

    private function getUriParameters(string $uri): array
    {
        if (! str_contains($uri, '{')) {
            return [];
        }

        preg_match_all('/\{([^}]+)\}/', $uri, $matches);
        //dump($matches[1]);
        return $matches[1];
    }

    public function get($uri, $controller, $middleware = null)
    {
        $this->addRoute('GET', $uri, $controller, $middleware);
        return $this;
    }

    public function post($uri, $controller, $middleware = null)
    {
        $this->addRoute('POST', $uri, $controller, $middleware);
        return $this;
    }

    public function run()
    {
        $uri = parse_url($_SERVER['REQUEST_URI'])['path'];
        //dump($this->routes);
        $httpMethod = $_SERVER['REQUEST_METHOD'];
        $routeInfo = $this->routes[$httpMethod][$uri];

        if (!isset($routeInfo)) {
            abort(404);
        }
        if (!class_exists($routeInfo['class'])) {
            abort(404);
        }
        $class = $routeInfo['class'];
        $method =  $routeInfo['method'];
        $middleware = $routeInfo['middleware'];

        if ($middleware) {
            $m = new $middleware;
            $m->handle();
        }

        $c = new $class;
        $c->$method();
    }
}
