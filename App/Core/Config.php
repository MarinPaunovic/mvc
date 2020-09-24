<?php


namespace App\Core;


class Config
{
public static function get(){
    $config = include BP . DIRECTORY_SEPARATOR . "App/config.php";
    return $config ?? null;
}
}