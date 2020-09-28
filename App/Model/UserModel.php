<?php
declare(strict_types=1);

namespace App\Model;

use App\Core\Database;

class UserModel
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
}