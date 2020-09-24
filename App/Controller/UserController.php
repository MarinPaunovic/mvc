<?php

namespace App\Controller;

use App\Core\Database;
use App\Model\AbstarctModel;

class UserController extends AbstractController
{

    public function loginAction()
    {
        $this->View->render('login');
    }


    public function registerAction()
    {
        $this->View->render('register');
    }


    public function registerSubmitAction()
    {
        if ($this->validateDataRegister()) {
            if ($_POST['password'] === $_POST['confirm_password']) {
                AbstarctModel::createUser($_POST['ime'], $_POST['prezime'], $_POST['email'], $_POST['password']);
                header('Location: login');
            } else header('Location: register');
        }else header('Location: register');
    }


    public function loginSubmitAction()
    {
        if ($this->validateDataLogin()) {
            if(AbstarctModel::login($_POST['email'], $_POST['password'])){
                header('Location: /');
            }else header('Location: login');
        } else header('Location: login');

    }

    public function logoutAction(){
        session_unset();
        header('Location: /');
    }

    public function createPostAction(){
        if(isset($_POST['post']) && $_POST['post'] != null)
        {
            AbstarctModel::createPost($_POST['post']);
        }
        header('Location: /');
    }

    public function getAllPostsAction(){
        AbstarctModel::getAllPosts();
    }



    public function validateDataRegister()
    {
            if (isset($_POST['ime']) && $_POST['ime'] != null)
                if (isset($_POST['prezime']) && $_POST['prezime'] != null)
                    if (isset($_POST['email']) && $_POST['email'] != null)
                        if (isset($_POST['password']) && $_POST['password'] != null)
                            if (isset($_POST['confirm_password']) && $_POST['confirm_password'] != null) {
                                return true;
                            } else return false;
    }


    public function validateDataLogin(){
            if (isset($_POST['email']) && $_POST['email'] != null)
                if (isset($_POST['password']) && $_POST['password'] != null) {
                    return true;
                } else return false;
    }


}