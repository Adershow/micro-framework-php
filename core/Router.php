<?php
class Router
{
    private $request;

    public function __construct(IRequest $request)
    {
        $this->request = $request;
    }

    public function get($url, $func)
    {
        $uri = $this->formatRoot();
        $uri = $this->formatRoute($uri);
        $url = $this->formatRoute($url);
        $this->testEquality($uri, $url, $func);
    }

    public function post($url, $func)
    {
        $uri = $this->formatRoot();
        $this->testEquality($uri, $url, $func);
    }

    public function put($url, $func)
    {
        $uri = $this->formatRoot();
        $uri = $this->formatRoute($uri);
        $url = $this->formatRoute($url);
        $this->testEquality($uri, $url, $func);
    }
    public function patch($url, $func)
    {
        $uri = $this->formatRoot();
        $uri = $this->formatRoute($uri);
        $url = $this->formatRoute($url);
        $this->testEquality($uri, $url, $func);
    }

    public function delete($url, $func)
    {
        $uri = $this->formatRoot();
        $uri = $this->formatRoute($uri);
        $url = $this->formatRoute($url);
        $this->testEquality($uri, $url, $func);
    }

    public function defaultRequestHandler()
    {
        header("{$this->request->serverProtocol} 404 Not Found");
    }

    private function testEquality($uri, $url, $func)
    {
        if ($uri === $url) {
            $func($this->request);
        }
    }

    private function formatRoute($data)
    {
        $array = explode("/", $data);

        for ($i = 3; $i < count($array); $i++) {
            $array[$i] = "";
        }
        $uri = implode('/', $array);
        return $uri;
    }

    private function formatRoot()
    {
        $root = ltrim(dirname($_SERVER['PHP_SELF']), '/');
        $root = substr($root, 0, strpos($root, "/"));
        $uri = str_replace('/' . $root, '', $_SERVER['REQUEST_URI']);
        return $uri;
    }

    public static function redirect($controller, $action = '', $data = [])
    {
        $controller_name = $controller;
        $dispatch = new $controller($controller_name, $action);
        if (method_exists($controller, $action)) {
            $dispatch->$action($data);
            die();
        } else {
            die('That method does not exist in the controller \"' . $controller_name . '\"');
        }
    }
}
