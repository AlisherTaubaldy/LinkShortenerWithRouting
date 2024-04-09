<?php

namespace Routes;

class Router
{
    private array $handlers;
    private array $notFound;
    private const string METHOD_GET = 'GET';
    private const string METHOD_POST = 'POST';

    public function get(string $path, $className, $funcName, $page): void
    {
        $this->addHandler(self::METHOD_GET, $path, $className, $funcName, $page);
    }

    public function post(string $path, $className, $funcName, $page): void
    {
        $this->addHandler(self::METHOD_POST, $path, $className, $funcName, $page);
    }

    public function run(){

        $requestUri = parse_url($_SERVER['REQUEST_URI']);
        $requestPath = $requestUri['path'];
        $requestMethod = $_SERVER['REQUEST_METHOD'];

        $callback = null;
        $args = null;

        foreach ( $this->handlers as $handler){
            if ($handler['path'] === $requestPath && $requestMethod === $handler['method']){
                $className = new $handler['className'];
                $args = [$handler['page']];

                $callback = [$className, $handler['funcName']];
            }
        }

        if (!$callback){
            if (!empty($this->notFound)){
                $className = $this->notFound['className'];
                $handler = new $className;

                $funcName = $this->notFound['funcName'];

                $callback = [$handler, $funcName];
            }
        }

        call_user_func_array($callback , $args);
    }

    public function addNotFoundHandler($className, $funcName): void
    {
        $this->notFound["className"] = $className;
        $this->notFound["funcName"] = $funcName;
    }

    public function addHandler(string $method, string $path, $className, $funcName, $page){
        $this->handlers[$method . $path] = [
            'path' => $path,
            'method' => $method,
            'className' => $className,
            'funcName' => $funcName,
            'page' => $page
        ];
    }

}
