<?php


function show($data)
{
    print_r($data);
    print "<br>";
}

function redirect($path)
{
    header("Location: " . ROOT  . $path);
    die;
}

function encode_message($message)
{
    return strtr($message, " ", "_");
}

function decode_message($message)
{
    return strtr($message, "_", " ");
}
