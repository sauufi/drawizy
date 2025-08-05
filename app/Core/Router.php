<?php

namespace App\Core;

class Router
{
    private $routes = [];

    /**
     * Tambah route
     * @param string $method (GET/POST)
     * @param string $path (regex atau /url/{param})
     * @param array|callable $callback
     * @param callable|null $middleware (opsional)
     */
    public function add($method, $path, $callback, $middleware = null)
    {
        // Ubah {param} menjadi regex (ex: /image/{slug})
        $pattern = preg_replace('/\{([a-zA-Z0-9_]+)\}/', '([\w-]+)', $path);
        $pattern = str_replace('/', '\/', $pattern);
        $this->routes[] = [
            'method' => strtoupper($method),
            'path' => "^$pattern$",
            'callback' => $callback,
            'middleware' => $middleware
        ];
    }

    public function run()
    {
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $method = $_SERVER['REQUEST_METHOD'];

        foreach ($this->routes as $route) {
            if ($method === $route['method'] && preg_match("#{$route['path']}#", $uri, $matches)) {
                array_shift($matches);

                // Jalankan middleware jika ada
                if ($route['middleware']) {
                    $middleware = $route['middleware'];
                    if (is_callable($middleware)) {
                        $middleware();
                    }
                }

                // Callback berupa [Class, method]
                if (is_array($route['callback']) && is_string($route['callback'][0])) {
                    $className = $route['callback'][0];
                    $methodName = $route['callback'][1];
                    $instance = new $className();
                    return call_user_func_array([$instance, $methodName], $matches);
                }

                // Callback berupa closure
                return call_user_func_array($route['callback'], $matches);
            }
        }

        http_response_code(404);
        echo "404 Not Found";
    }
}
