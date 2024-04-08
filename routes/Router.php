<?php

namespace Routes;

class Router
{
    private array $handlers;
    private array $notFound;
    private const string METHOD_GET = 'GET';
    private const string METHOD_POST = 'POST';

    public function get(string $path, $className, $funcName): void
    {
        $this->addHandler(self::METHOD_GET, $path, $className, $funcName);
    }

    public function post(string $path, $className, $funcName): void
    {
        $this->addHandler(self::METHOD_POST, $path, $className, $funcName);
    }

    public function run(){

        $requestUri = parse_url($_SERVER['REQUEST_URI']);
        $requestPath = $requestUri['path'];
        $requestMethod = $_SERVER['REQUEST_METHOD'];

        $callback = null;

        foreach ( $this->handlers as $handler){
            if ($handler['path'] === $requestPath && $requestMethod === $handler['method']){
                $className = new $handler['className'];



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

        call_user_func_array($callback , [
            array_merge($_GET, $_POST)
        ]);
    }

    public function addNotFoundHandler($className, $funcName): void
    {
        $this->notFound["className"] = $className;
        $this->notFound["funcName"] = $funcName;
    }

    public function addHandler(string $method,string $path, $className, $funcName){
        $this->handlers[$method . $path] = [
            'path' => $path,
            'method' => $method,
            'className' => $className,
            'funcName' => $funcName
        ];
    }

}
