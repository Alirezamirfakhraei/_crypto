<?php

namespace System\Router\Web;

class Route{

    public function get($url  , $executedMethod , $name = null)
    {
        $executedMethod = explode("@" , $executedMethod);
        $class = $executedMethod[0];
        $method = $executedMethod[1];
        global $routes;
        $routes['get'][] = array('url' => trim($url, "/ "), 'class' => $class, 'method' => $method, 'name' => $name);
    }

    public function post($url  , $executedMethod , $name = null)
    {
        $executedMethod = explode("@" , $executedMethod);
        $class = $executedMethod[0];
        $method = $executedMethod[1];
        global $routes;
        $routes['post'][] = array('url' => trim($url, "/ "), 'class' => $class, 'method' => $method, 'name' => $name);
    }

    public function put($url  , $executedMethod , $name = null)
    {
        $executedMethod = explode("@" , $executedMethod);
        $class = $executedMethod[0];
        $method = $executedMethod[1];
        global $routes;
        $routes['put'][] = array('url' => trim($url, "/ "), 'class' => $class, 'method' => $method, 'name' => $name);
    }

    public function delete($url  , $executedMethod , $name = null)
    {
        $executedMethod = explode("@" , $executedMethod);
        $class = $executedMethod[0];
        $method = $executedMethod[1];
        global $routes;
        $routes['delete'][] = array('url' => trim($url, "/ "), 'class' => $class, 'method' => $method, 'name' => $name);
    }



}