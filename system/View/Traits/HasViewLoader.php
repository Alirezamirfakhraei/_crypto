<?php

namespace  System\View\Traits;

trait HasViewLoader
{

    private $viewNameArray = [];

    private function viewLoader($dir)
    {
        $dir = trim($dir, " .");
        $dir = str_replace(".", "/", $dir);
        if(file_exists(dirname(__DIR__, 3) ."/resources/view/$dir.blade.php"))
        {
            $this->registerView($dir);
            return htmlentities(file_get_contents(dirname(__DIR__, 3) ."/resources/view/$dir.blade.php"));
        }
        else{
            throw new \Exception('view not Found!!!!');
        }
    }

    private function registerView($view)
    {
        $this->viewNameArray[] = $view;
    }
}
