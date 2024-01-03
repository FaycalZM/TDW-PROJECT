<?php
spl_autoload_register(function ($className) {
    $fileName = __DIR__ . "/../models/" . ucfirst($className) . ".php";
    require $fileName;
});

require 'config.php';
require 'functions.php';
require 'Database.php';
require 'Model.php';
require 'View.php';
require 'Controller.php';
require 'App.php';
