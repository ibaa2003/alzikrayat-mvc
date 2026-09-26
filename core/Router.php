<?php

class Router
{
    private array $routes = [];

    public function get(string $pattern, callable $callback): void
    {
        $this->addRoute("GET", $pattern, $callback);
    }

    public function post(string $pattern, callable $callback): void
    {
        $this->addRoute("POST", $pattern, $callback);
    }

    private function addRoute(
        string $method,
        string $pattern,
        callable $callback
    ): void {
        $this->routes[] = [
            "method" => $method,
            "pattern" => $pattern,
            "callback" => $callback
        ];
    }

    public function dispatch(string $uri, string $method): void
    {
        $path = parse_url($uri, PHP_URL_PATH);

        foreach ($this->routes as $route) {
            if ($route["method"] !== $method) {
                continue;
            }

            if (preg_match(
                $route["pattern"],
                $path,
                $matches
            )) {
                array_shift($matches);

                call_user_func_array(
                    $route["callback"],
                    $matches
                );

                return;
            }
        }

        http_response_code(404);
        echo "404 - Page Not Found";
    }
}
