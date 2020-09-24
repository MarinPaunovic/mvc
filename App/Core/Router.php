<?php

declare(strict_types=1);

namespace App\Core;

use App\Core\exception\routeException;

class Router
{
    public function match()
    {
        if ($_SERVER['REQUEST_URI'] == '/') {
            $controller = 'HomeController';
            $method = 'indexAction';
        } else {
            $actual_link = $_SERVER['REQUEST_URI'];
            $actual_link = trim($actual_link, '/');
            $parts = explode("/", $actual_link);
            if (count($parts) > 2) {
                header('Location: /');
            }
            $controller = ucfirst(strtolower($parts[0] ?? 'home')) . 'Controller';
            $method = strtolower($parts[1] ?? 'index') . 'Action';

        }
        $className = "\\App\\Controller\\$controller";
        if (!method_exists($className, $method)) {
            header('Location: /');
        } else {
            $object = new $className();
            return $object->$method();

        }
    }
}
