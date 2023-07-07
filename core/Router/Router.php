<?php

namespace Core\Router;

use Core\Http\Request;

class Router
{

    private array $routes;


    public function __construct(array $routes)
    {
        $this->routes = $routes;

    }


    public function run(Request $request): void
    {
        foreach ($this->routes as $route) {
            if ($route->matches($request)) {
                $route->callAction();
            }

        }

    }


}
