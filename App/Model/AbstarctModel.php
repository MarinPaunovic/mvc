<?php
declare(strict_types=1);

namespace App\Model;


use App\Core\Database;
use function Couchbase\defaultDecoder;

class AbstarctModel extends Database
{
    public static function createUser($ime, $prezime, $email, $password)
    {
        Database::connect();
        $sql="SELECT * FROM korisnici Where Email='$email'";
        $query=mysqli_query(Database::connect(),$sql);
        $result=mysqli_num_rows($query);
        if($result>=1)
        {
         exit(header('Location: register'));
        }else {
            $passHash = md5($password);
            $sql = "INSERT INTO korisnici (Ime, Prezime, Email, Password) values('$ime','$prezime','$email','$passHash')";
            mysqli_query(Database::connect(), $sql);
        }
    }


    public static  function login($email,$password){
        Database::connect();
        $passHash=md5($password);
        $sql= "SELECT id,Ime FROM korisnici WHERE Email='$email' and Password='$passHash'";
        $query=mysqli_query(Database::connect(),$sql);
        $result=mysqli_num_rows($query);
        if($result>=1){
            $row = mysqli_fetch_array($query);
            $_SESSION["userid"] = trim($row["id"]);
            $_SESSION["Ime"] = trim($row["Ime"]);
            return true;
        }else return false;
    }

    public static function createPost($post){
        Database::connect();
        $userID=$_SESSION['userid'];
        $sql="INSERT INTO posts (userid, post) VALUES ('$userID','$post')";
        mysqli_query(Database::connect(),$sql);
    }

    public static function getAllPosts(){
        Database::connect();
        $sql="SELECT post  FROM posts";
        $query=mysqli_query(Database::connect(),$sql);
        $posts=[];
        $i=0;
        while($row=mysqli_fetch_array($query)){
            $posts[$i++]=$row['post'];
        }
        return $posts;

    }

}