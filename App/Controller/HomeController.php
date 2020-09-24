<?php

declare(strict_types=1);

namespace App\Controller;
define('Model','new \App\Model\AbstarctModel()->getAllPosts()');
class HomeController extends AbstractController
{
    public function indexAction()
    {
        return $this->View->render('Home');
    }
}