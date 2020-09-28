<?php


namespace App\Controller;

use App\Core\Database;
use App\Model\PostModel;

class PostController extends AbstractController
{
    public function createPostAction()
    {
        $this->View->render('Post');
    }

    public function createNewPostAction(){
        if(isset($_POST['posttitle']) && $_POST['posttitle'] != null)
        if(isset($_POST['postcontent']) && $_POST['postcontent'] != null)
        {
            PostModel::createPost($_POST['posttitle'],$_POST['postcontent']);
            header('Location: Post');
        }header('Location: Post');
    }

    public function getAllPostsAction(){
        return PostModel::getAllPosts();
    }

    public function deletePostAction(){
        PostModel::deletePost($_SESSION['userid']);
        header('Location: Post');
    }

    public function showPostAction(){
        $this->View->render('showPost',['titles'=>PostModel::showOnePost()]);
    }

}