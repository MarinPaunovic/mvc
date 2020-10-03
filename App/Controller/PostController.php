<?php


namespace App\Controller;

use App\Core\Database;
use App\Model\PostModel;
use App\Model\UserModel;

class PostController extends AbstractController
{
    public function createPostAction()
    {
        $this->View->render('Post');
    }

    public function createNewPostAction(){
        if(isset($_POST['posttitle']) && $_POST['posttitle'] != null) {
            if (isset($_POST['postcontent']) && $_POST['postcontent'] != null) {
                PostModel::createPost($_POST['posttitle'], $_POST['postcontent']);
                header('Location: /');
            }else header('Location: createPost');
        }
    }

    public function getAllPostsAction(){
        return PostModel::getAllPosts('ASC');
    }

    public function deletePostAction(){
        PostModel::deletePost($_GET['id']);
        header('Location: /');
    }

    public function showPostAction(){
        $this->View->render('showPost',['titles'=>PostModel::showOnePost(),'userinfo'=>UserModel::getUserInfo()]);
    }

    public function PostMenagmentAction(){
        if($_SESSION) {
            $this->View->render('PostMenagment', ['titles' => PostModel::getAllPosts('reg_date DESC')]);
        }else throw new \Exception('user nije logiran');
    }

    public function PostEditAction(){
        if($_SESSION){
            $this->View->render('PostEdit',['titles'=>PostModel::getAllPosts()]);
        }
    }
    public function PostEditEditAction(){
        PostModel::PostUpdate($_POST['Naslov'],$_POST['Post'],$_POST['edit_id']);
        header('Location: /');
    }
    public function deletePostEditAction(){
        PostModel::deletePost($_GET['id']);
        header('Location: PostMenagment');
    }

}