<?php
//  this file will contain all the common functions for all controllers, i.e: all other controllers will extend this class

trait Controller
{

    public function getView($viewName)
    {
        $filename = __DIR__ . "/../views/" . $viewName . ".view.php";
        if (file_exists($filename)) {
            require $filename;
        } else {
            require __DIR__ . '/../views/404.view.php';
        }
    }
    public function getModel($modelName)
    {
        $filename = __DIR__ . "/../models/" . ucfirst($modelName) . ".php";
        require $filename;
    }


    public function method_not_found()
    {
        echo "Method doesn't exist!";
    }
}
