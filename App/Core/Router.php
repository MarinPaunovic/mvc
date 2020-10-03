<?php

declare(strict_types=1);

namespace App\Core;

use App\Controller\PostController;
use App\Core\exception\routeException;
use mysql_xdevapi\Exception;

class Router extends \Exception
{
    public function match()
    {
            $url = $_SERVER['REQUEST_URI'];
            $parts = parse_url($url);
        if(isset($parts['query'])) {
            $urlgetm = explode('?', $parts['query']);
        }
            $url_class_name_trim = trim($parts['path'], '/');
        if ($url_class_name_trim === '') {
            $controller = 'HomeController';
            $method = 'indexAction';
        }else {
            $url_class_name_explode = explode('/', $url_class_name_trim);
            $path_count=count($url_class_name_explode);
            if($path_count>2){
                throw new \Exception('Birali ste stranicu koja ne postoji');
            }
            if($path_count==2){
                $controller = $url_class_name_explode[0] . 'Controller';
                $method = $url_class_name_explode[1] . 'Action';
            }else throw new \Exception('nema metode');
        }
        $className = "\\App\\Controller\\$controller";

        if(file_exists(BP . $className. '.php')) {
            if (method_exists($className, $method)) {
                $object = new $className();
                return $object->$method();
            } else throw new \Exception('nepostojeće');
        }else throw new \Exception('nije valjan kontroler');
    }
}

