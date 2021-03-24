<?php

namespace App\Controller;

use App\Database\ConnectionHandler;
use App\Helper\SessionHelper;
use App\Repository\CategoryRepository;
use App\Repository\UserRepository;
use App\View\View;

class UserController
{
    public function create()
    {
        $view = new View('user/signin');
        $view->title = 'Sign In';
        $view->display();
    }

    public function doCreate()
    {
        $username = ConnectionHandler::getConnection()->escape_string($_POST['username']);
        $password = hash('sha256', $_POST['password']);
        $confirm_password = hash('sha256', $_POST['confirm_password']);
        $userRepository = new UserRepository();
        $userRepository->registerUser($username, $password, $confirm_password);
    }

    public function login()
    {
        if (isset($_SESSION['loggedIn'])) {
            header('Location: /category/showAll');
            exit();
        } else {
            $view = new View('user/login');
            $view->title = 'Login';
            $view->display();
        }
    }

    public function doLogin()
    {
        $username = ConnectionHandler::getConnection()->escape_string($_POST['username']);
        //password_hash("21334", PASSWORD_ARGON2I);
        $password = hash('sha256', $_POST['password']);
        $userRepository = new UserRepository();
        $user = $userRepository->checkUserExistance($username, $password);

        if ($user->id > 0) {
            $_SESSION['loggedIn'] = true;
            $_SESSION['user'] = $user;
            SessionHelper::updateUserContent();
            header('Location: /category/showAll');
            exit();
        } else {
            $_SESSION['warning'] = "Login Failed";
            header('Location: /user/login');
            exit();
        }
    }

    public function logoutUser()
    {
        session_destroy();
        session_unset();
        header('Location: /user/login');
        exit();
    }
    public function showProfile(){
        $view = new View('user/profile');
        $view->title = 'Sign In';
        $view->display();
    }

    public function updateUserInfo(){
        $view = new View('user/changeProfile');
        $view->title = 'User Info';
        $view->display();
    }
    public function doUpdateUserInfo(){
        $email = ConnectionHandler::getConnection()->escape_string($_POST['email']);
        $password = hash('sha256', $_POST['password']);
        $userRepository = new UserRepository();
        $userRepository->updateUserInfo($email, $password);

    }
    public function changePassword(){
        $view = new View('user/changePassword');
        $view->title = 'New Password';
        $view->display();
    }
    public function doChangePassword(){
        $newPW = hash('sha256', $_POST['newPW']);
        $confirmNewPW = hash('sha256', $_POST['confirmNewPW']);
        $currentPW = hash('sha256', $_POST['currentPW']);
        $userRepository = new UserRepository();
        $userRepository->changeUserPassword($newPW, $confirmNewPW, $currentPW);
    }
}
