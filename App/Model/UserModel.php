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

    public static function getUserInfo($id=null){
        Database::connect();
        if($id != null){
            $sql="SELECT id,Ime,Prezime,Email FROM korisnici where id='$id'";
        }else $sql="SELECT id,Ime,Prezime,Email FROM korisnici";
        $query=mysqli_query(Database::connect(),$sql);
        $users=[];
        $i=0;
        while($row=mysqli_fetch_assoc($query)){
            $users[$i++]=$row;
        }
        return $users;
        }
public static function changeUserInfo($ime,$prezime,$email,$oldPass=null,$newPass=null,$id)
{
    Database::connect();
    if($oldPass != null && $newPass !=null){
    $hash_old_pass=md5($oldPass);
    $hash_new_pass=md5($newPass);
    $sql = "UPDATE korisnici SET Ime='$ime', Prezime='$prezime', Email='$email', Password='$hash_new_pass' WHERE id='$id' AND Password='$hash_old_pass' ";
    mysqli_query(Database::connect(), $sql);
    }else {
    $sql="UPDATE korisnici SET Ime='$ime', Prezime='$prezime', Email='$email' WHERE id='$id'";
    mysqli_query(Database::connect(), $sql);
    }
    header('Location: UserInfo');
}
}