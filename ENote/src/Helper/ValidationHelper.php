<?php


namespace App\Helper;

class ValidationHelper
{
    public static function redirectIfNotLoggedIn()
    {
        if (!isset($_SESSION['loggedIn'])) {
            header('Location: /user/login');
            exit();
        }
    }

    public static function redirectIfLoggedIn()
    {
        if (isset($_SESSION['loggedIn'])) {
            header("Location: /");
            exit();
        }
    }

    public static function isEmail($email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['warning'] = "Invalid email format";
            header("Location: /user/updateUserInfo");
            exit();
        }
    }

    public static function validatePasswordFormat($password)
    {
        $uppercase = preg_match('@[A-Z]@', $password);
        $lowercase = preg_match('@[a-z]@', $password);
        $number = preg_match('@[0-9]@', $password);
        if (!$uppercase || !$lowercase || !$number || strlen($password) < 8) {
            $_SESSION['warning'] = "Password should be at least 8 characters in length and should include at least one upper case letter and one number.";
            return false;
        } else {
            return true;
        }
    }

    public static function validateCategoryName($categoryName){
        if(strlen($categoryName) > 40){
            $_SESSION['warning'] = "Category Name to long";
            return false;
        }else if(empty($categoryName)){
            $_SESSION['warning'] = "Category Name required";
            return false;
        }else{
            return true;
        }
    }
    public static function validateTaskDescription($description){
        if(strlen($description) > 40){
            $_SESSION['warning'] = "Task description to long";
            return false;
        }else if(empty($description)){
            $_SESSION['warning'] = "Task description required";
            return false;
        }else{
            return true;
        }
    }



}