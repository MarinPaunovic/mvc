<?php

namespace App\Controller;

use App\Core\Database;
use App\Model\UserModel;
use http\Client\Curl\User;

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
                UserModel::createUser($_POST['ime'], $_POST['prezime'], $_POST['email'], $_POST['password']);
                header('Location: login');
            } else header('Location: register');
        }else header('Location: register');
    }


    public function loginSubmitAction()
    {
        if ($this->validateDataLogin()) {
            if(UserModel::login($_POST['email'], $_POST['password'])){
                header('Location: /');
            }else header('Location: login');
        } else header('Location: login');

    }

    public function logoutAction(){
        session_unset();
        header('Location: /');
    }

    public function userInfoAction(){
        $this->View->render('UserInfo', ['users'=>UserModel::getUserInfo()]);
    }

    public function changeUserInfoAction(){
        if(isset($_POST['old_password']) && $_POST['old_password'] !== null){
            if(isset($_POST['new_password']) && $_POST['new_password'] !== null && isset($_POST['confirm_new_password']) && $_POST['confirm_new_password']!== null && $_POST['new_password'] === $_POST['confirm_new_password']) {
                UserModel::changeUserInfo($_POST['Ime'], $_POST['Prezime'], $_POST['Email'], $_POST['old_password'],$_POST['new_password'],$_POST['id']);
            }
        }else{
        UserModel::changeUserInfo($_POST['Ime'],$_POST['Prezime'],$_POST['Email'],$_POST['id']);
        }
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