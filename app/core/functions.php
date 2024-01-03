<?php


function show($data)
{
    print_r($data);
    print "<br>";
}

function redirect($path)
{
    header("Location: " . ROOT . "/" . $path);
    die;
}
