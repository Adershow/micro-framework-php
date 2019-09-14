<?php
class Router
{
    private $request;
    private $supportedHttpMethods = array(
        "GET",
        "POST",
        "DELETE",
        "PATCH",
    );

    public function __construct(IRequest $request)
    {
        $this->request = $request;
    }

    private function defaultRequestHandler()
    {
        header("{$this->request->serverProtocol} 404 Not Found");
    }

    public function get($url, $func)
    {
        $req = new Request();
        $root = ltrim(dirname($_SERVER['PHP_SELF']), '/');
        $root = substr($root, 0, strpos($root, "/"));
        $uri = str_replace('/' . $root, '', $_SERVER['REQUEST_URI']);
        $uri = $this->formatRoute($uri);
        $url = $this->formatRoute($url);

        if ($uri === $url) {
            $func($this->request);
        } else {
            $this->defaultRequestHandler();
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

    public static function redirect($controller, $action = '', $data = [])
    {
        $controller_name = $controller;
        $dispatch = new $controller($controller_name, $action);
        if (method_exists($controller, $action)) {
            $dispatch->$action($data);
        } else {
            die('That method does not exist in the controller \"' . $controller_name . '\"');
        }
    }
    /*public static function route($url, $jsonData = null)
{
//controller
$controller = (isset($url[0]) && $url[0] != '') ? ucwords($url[0]) : DEFAULT_CONTROLLER;
$controller_name = $controller;
array_shift($url);

//action
$action = (isset($url[0]) && $url[0] != '') ? $url[0] . 'Action' : 'indexAction';
$action_name = $action;
array_shift($url);

define the params logic
if ($url[0] != '' && $jsonData == null) {
$queryParams = $url;
echo "saas";
} else if ($url[0] != '') {
$queryParams = array_merge($url, json_decode($jsonData, true));
} else {
$queryParams = json_decode($jsonData, true);
}
var_dump($queryParams);
die();

$dispatch = new $controller($controller_name, $action);

if (method_exists($controller, $action)) {
call_user_func_array([$dispatch, $action], $queryParams);
} else {
die('That method does not exist in the controller \"' . $controller_name . '\"');
}
}*/
}
