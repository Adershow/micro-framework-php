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

    public function getBody()
    {
        $body = [];
        if ($this->requestMethod === "GET") {
            $root = ltrim(dirname($_SERVER['PHP_SELF']), '/');
            $root = substr($root, 0, strpos($root, "/"));
            $uri = str_replace('/' . $root, '', $_SERVER['REQUEST_URI']);

            $array = explode("/", $uri);
            for ($i = 3; $i < count($array); $i++) {
                array_push($body, $array[$i]);
            }
        } else if ($this->requestMethod === "PATCH") {
            $body = file_get_contents("php://input");
        } else {
            $body = file_get_contents("php://input");
            $body = json_decode($body, true);
        }
        return $body;
    }
}
