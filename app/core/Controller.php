<?php
//  this file will contain all the common functions for all controllers, i.e: all other controllers will extend this class

class Controller
{
    public function view($name)
    {
        $filename = __DIR__ . "/../views/" . $name . ".view.php";
        if (file_exists($filename)) {
            require $filename;
        } else {
            require __DIR__ . '/../views/404.view.php';
        }
    }
}
