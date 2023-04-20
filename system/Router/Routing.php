<?php

namespace System\Router;
use ReflectionMethod;

class Routing
{
    private $current_route;
    private $method_field;
    private $routes;
    private $values = [];

    public function __construct()
    {
        $this->current_route = explode('/', CURRENT_ROUTE);
        $this->method_field = $this->method_field();

        global $routes;
        $this->routes = $routes;
        //end
    }

    public function run()
    {

        $match = $this->match();
        if (empty($match)){
             $this->error404();
        }

        $classPath = str_replace('\\' , '/' , $match["class"]);
        $path = BASE_DIR. "/app/Http/Controllers/".$classPath.".php";
        if (!file_exists($path)){
             $this->error404();
        }

        $class = "\App\Http\Controllers\\".$match["class"];
        $object = new $class;
        if (method_exists($object , $match["method"])){
            $reflection = new ReflectionMethod($class , $match["method"]);
            $parameterCount = $reflection->getNumberOfParameters();
            if ($parameterCount <= count($this->values)){
                call_user_func_array(array($object , $match["method"]) , $this->values);
            }else{

                $this->error404();
            }
        }else{

            $this->error404();
        }
    }

    public function match()
    {
        $reserveRoutes = $this->routes[$this->method_field];
        foreach ($reserveRoutes as $reserveRoute) {
            if ($this->compare($reserveRoute['url'])){
                return ["class" => $reserveRoute['class'] , "method" => $reserveRoute['method']];
            }else{
                $this->values = [];
            }
        }
        return [];
    }

    public function compare($reservedRouteUrl)
    {
        //part1
        if (trim($reservedRouteUrl, '/') === '') {
            return trim($this->current_route[0], '/') === '' ? true : false;
        }
        //part2
        $reservedRouteUrlArray = explode('/', $reservedRouteUrl);
        if (sizeof($this->current_route) != sizeof($reservedRouteUrlArray)) {
            return false;
        }
        //part3
        foreach ($this->current_route as $key => $currentRouteElement) {
            $reservedRouteUrlElement = $reservedRouteUrlArray[$key];
            if (str_starts_with($reservedRouteUrlElement, "{") && str_starts_with($reservedRouteUrlElement, -1) == "}"){
                $this->values[] = $currentRouteElement;
            } elseif ($reservedRouteUrlElement != $currentRouteElement) {
                return false;
            }
        }
        return true;
    }

    public function error404()
    {
        http_response_code(404);
        include __DIR__ . DIRECTORY_SEPARATOR . 'View' . DIRECTORY_SEPARATOR . '404.php';
        exit;
    }

    public function method_field()
    {
        $method_field = strtolower($_SERVER['REQUEST_METHOD']);
        if ($method_field == 'post') {
            if (isset($_POST['_method'])) {
                if ($_POST['_method'] == 'put') {
                    $method_field = 'put';
                } elseif ($_POST['_method'] == 'delete') {
                    $method_field = 'delete';
                }
            }
        }
        return $method_field;
    }

}