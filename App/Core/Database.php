<?php


namespace App\Core;


class Database
{
static function connect()
{
    $dbConfig = Config::get();
    return mysqli_connect($dbConfig['host'], $dbConfig['user'], $dbConfig['password'], $dbConfig['database']);
}
public function __construct(){
    self::connect();
}
}