<?php

namespace System\Router\Api;

class Route{

    public function get($url  , $executedMethod , $name = null)
    {
        $executedMethod = explode("@" , $executedMethod);
        $class = $executedMethod[0];
        $method = $executedMethod[1];
        global $routes;
        $routes['get'][] = array('url' => "api/".trim($url, "/ "), 'class' => $class, 'method' => $method, 'name' => $name);
    }

    public function post($url  , $executedMethod , $name = null)
    {
        $executedMethod = explode("@" , $executedMethod);
        $class = $executedMethod[0];
        $method = $executedMethod[1];
        global $routes;

        $routes['post'][] = array('url' => "api/".trim($url, "/ "), 'class' => $class, 'method' => $method, 'name' => $name);
    }

    public function put($url  , $executedMethod , $name = null)
    {
        $executedMethod = explode("@" , $executedMethod);
        $class = $executedMethod[0];
        $method = $executedMethod[1];
        global $routes;
        $routes['put'][] = array('url' => "api/".trim($url, "/ "), 'class' => $class, 'method' => $method, 'name' => $name);
    }

    public function delete($url  , $executedMethod , $name = null)
    {
        $executedMethod = explode("@" , $executedMethod);
        $class = $executedMethod[0];
        $method = $executedMethod[1];
        global $routes;
        $routes['delete'][] = array('url' => "api/".trim($url, "/ "), 'class' => $class, 'method' => $method, 'name' => $name);
    }



}