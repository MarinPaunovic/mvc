<?php
declare(strict_types=1);

namespace App\Model;


use App\Core\Database;

class PostModel
{
    public static function createPost($title,$content){
        Database::connect();
        $userID=$_SESSION['userid'];
        $sql="INSERT INTO posts (userid, naslov, post) VALUES ('$userID','$title','$content')";
        mysqli_query(Database::connect(),$sql);
    }

    public static function getAllPosts($orderBy=null){
        Database::connect();
        $sql="SELECT naslov,id,userid FROM posts ORDER BY $orderBy";
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
        $sql="DELETE FROM posts WHERE userid='$postId'";
        mysqli_query(Database::connect(),$sql);
    }

    public static function showOnePost(){
        Database::connect();
        $sql="SELECT naslov,userid,post FROM posts WHERE id=24";
        $query=mysqli_query(Database::connect(),$sql);
        $posts=[];
        $i=0;
        while($row=mysqli_fetch_assoc($query)){
            $posts[$i++]=$row;
        }
        return $posts;
    }

}