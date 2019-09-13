<?php
include_once ROOT . DS . 'core' . DS . 'RequestHandlers' . DS . 'RequestHandler.php';

class Request implements IRequest
{
    public function __construct()
    {
        $this->bootstrapSelf();
    }

    private function bootstrapSelf()
    {
        foreach ($_SERVER as $key => $value) {
            $this->{$this->toUpper($key)} = $value;
        }
    }

    private function toUpper($str)
    {
        $result = strtolower($str);
        preg_match_all('/_[a-z]/', $result, $matches);

        foreach ($matches[0] as $match) {
            $c = str_replace('_', '', strtoupper($match));
            $result = str_replace($match, $c, $result);
        }
        return $result;
    }

    //Get the request jsonBody
    public function getBody()
    {
        $body = [];
        if ($this->requestMethod === "PATCH" || $this->requestMethod === "PUT") {
            $body = file_get_contents("php://input");
            $body = json_decode($body, true);
        } else {
            $body = file_get_contents("php://input");
            $body = json_decode($body, true);
        }
        return $body;
    }

    public function getQueryParams()
    {
        $body = [];
        if ($this->requestMethod === "GET" || $this->requestMethod === "DELETE") {
            $array = $this->getData();
            for ($i = 3; $i < count($array); $i++) {
                array_push($body, $array[$i]);
            }
        } elseif ($this->requestMethod === "PATCH" || $this->requestMethod === "PUT") {
            $array = $this->getData();
            for ($i = 3; $i < count($array); $i++) {
                array_push($body, $array[$i]);
            }
        }
        return $body;
    }

    public function getHeaders()
    {

    }

    private function getData()
    {
        $root = ltrim(dirname($_SERVER['PHP_SELF']), '/');
        $root = substr($root, 0, strpos($root, "/"));
        $uri = str_replace('/' . $root, '', $_SERVER['REQUEST_URI']);
        $array = explode("/", $uri);

        return $array;
    }
}
