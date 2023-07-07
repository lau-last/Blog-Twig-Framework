<?php

namespace Core\Router;

use Core\Http\Request;

class Route
{

    private string $path;

    private string $controllerName;

    private string $action;

    private array $params = [];

    private array $method;


    public function __construct(string $path, string $controllerName, string $action, array $method=[])
    {
        $this->path = $path;
        $this->controllerName = $controllerName;
        $this->action = $action;
        $this->method = $method;

    }


    public function matches(Request $request): bool
    {
        $matches = [];
        if (\preg_match($this->path, $request->getUri(), $matches)) {
            if (\count($matches) > 1) {
                \array_shift($matches);
                $this->params = $matches;
            }

            return true;
        }

        return false;

    }


    public function callAction(): void
    {
        $controller = new $this->controllerName;
        $action = $this->action;
        $controller->$action($this->params);

    }


    public function getMethod(): array
    {
        return $this->method;

    }


    public function getParams(): array
    {
        return $this->params;

    }


}
