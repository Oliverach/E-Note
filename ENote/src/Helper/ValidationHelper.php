<?php


namespace App\Helper;

class ValidationHelper
{
    public static function checkIfUserLoggedIn()
    {
        if (!isset($_SESSION['loggedIn'])) {
            header('Location: /user/login');
            exit();
        }
    }

    public static function redirectIfLoggedIn(){
        if (isset($_SESSION['loggedIn'])){
            header("Location: /" );
            exit();
        }
    }

    public static function hasLength($int, $description)
    {
        if(strlen($description) >= $int){
            return true;
        }else{
            return false;
        }
    }
}