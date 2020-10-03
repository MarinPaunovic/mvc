<?php
declare(strict_types=1);

namespace App\Model;


use App\Core\Database;

class PostModel
{
    public static function createPost($title,$content){
        Database::connect();
        $userID=$_SESSION['userid'];
        $title_escaped=mysqli_escape_string(Database::connect(),$title);
        $content_escaped=mysqli_escape_string(Database::connect(),$content);
        $sql="INSERT INTO posts (userid, naslov, post) VALUES ('$userID','$title_escaped','$content_escaped')";
        mysqli_query(Database::connect(),$sql);
    }

    public static function getAllPosts($orderBy=null){
        Database::connect();
        if($orderBy !==null){
            $sql="SELECT * FROM posts ORDER BY $orderBy";
        }else {$sql="SELECT * FROM posts";}
        $query=mysqli_query(Database::connect(),$sql);
        $posts=[];
        $i=0;
        while($row=mysqli_fetch_assoc($query)){
            $posts[$i++]=$row;
        }
        return $posts;
    }

    public static function deletePost($postId){
        Database::connect();
        $sql="DELETE FROM posts WHERE id='$postId'";
        mysqli_query(Database::connect(),$sql);
    }

    public static function showOnePost(){
        Database::connect();
        $sql="SELECT * FROM posts";
        $query=mysqli_query(Database::connect(),$sql);
        $posts=[];
        $i=0;
        while($row=mysqli_fetch_assoc($query)){
            $posts[$i++]=$row;
        }
        return $posts;
    }

    public static function PostUpdate($naslov,$content,$id){
        Database::connect();
        $sql="UPDATE posts SET naslov='$naslov', post='$content' where id='$id'";
        mysqli_query(Database::connect(),$sql);
    }
}