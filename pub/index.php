<?php
## Requira sve klase koje pozovemo u index.php-u
define('BP', dirname(__DIR__));
spl_autoload_register(function ($class) {
    $class = lcfirst($class);
    $filename = BP . DIRECTORY_SEPARATOR . str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php';
    if (file_exists($filename)) {
        require_once $filename;
    }else header('Location: /');
});
ini_set('session.cookie_lifetime','864000');
session_start();
$router= new \App\Core\Router();
$router->match();




