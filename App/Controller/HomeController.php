<?php

declare(strict_types=1);

namespace App\Controller;
use App\Model\PostModel;
use App\Model\UserModel;

class HomeController extends AbstractController
{
    public function indexAction()
    {
        return $this->View->render('Home',['titles'=>PostModel::getAllPosts('reg_date DESC')]);
    }
}