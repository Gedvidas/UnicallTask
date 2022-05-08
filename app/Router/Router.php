<?php

namespace Unicall\Router;

use Unicall\Helper\Request;

class Router
{
    public  array   $routes = [];
    public Request $request;

    /**
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request =$request;
    }

    public function get(string $path, $callback) {
        $this->routes['get'][$path] = $callback;
    }

    public function post(string $path, $callback) {
        $this->routes['post'][$path] = $callback;
    }

    public function resolve() {
        $path = $this->request->getPatch();
        $method = $this->request->getMethod();
        $callback = $this->routes[$method][$path] ?? false;
        if (!$callback) {
            http_response_code(404);
            include(VIEW_ROOT . '404.php'); // provide your own HTML for the error page
            die();
        }

        if (is_array($callback)) {
            $callback[0] = new $callback[0]();
        }

        call_user_func($callback, $this->request);
    }
}