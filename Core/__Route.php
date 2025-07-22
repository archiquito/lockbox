<?php

namespace Core;

class Route
{
    private array $routes = [];

    public function get(string $uri, $controller, $middleware = null): self
    {
        $this->routes['GET'][$uri] = [
            'controller' => $controller,
            'middleware' => $middleware,
            'parameters' => $this->getUriParameters($uri)
        ];
        return $this;
    }

    private function getUriParameters(string $uri): array
    {
        if (! str_contains($uri, '{')) {
            return [];
        }

        preg_match_all('/\{([^}]+)\}/', $uri, $matches);
        return $matches[1];
    }

    private function matchRoute(string $requestUri, string $routeUri): ?array
    {
        // Convert route pattern to regex
        $pattern = preg_replace('/\{([^}]+)\}/', '([^/]+)', $routeUri);
        $pattern = "@^" . str_replace('/', '\/', $pattern) . "$@";

        if (preg_match($pattern, $requestUri, $matches)) {
            array_shift($matches); // Remove the full match
            return $matches;
        }

        return null;
    }

    public function run()
    {
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $method = $_SERVER['REQUEST_METHOD'];

        foreach ($this->routes[$method] as $route => $handler) {
            $matches = $this->matchRoute($uri, $route);

            if ($matches !== null) {
                if ($handler['middleware']) {
                    (new $handler['middleware'])->handle();
                }

                $controller = $handler['controller'];
                if (is_array($controller)) {
                    $class = new $controller[0]();
                    return $class->{$controller[1]}(...$matches);
                }

                return new $controller();
            }
        }

        abort(404);
    }
    // ...existing code...
}
