<?php

namespace App\Controller;

use App\Database\ConnectionHandler;
use App\Helper\SessionHelper;
use App\Repository\CategoryRepository;
use App\Repository\UserRepository;
use App\View\View;

class UserController
{

    public function index()
    {
        $view = new View('user/index');
        $view->title = 'Benutzer';
        $view->display();
    }

    public function create()
    {
        $view = new View('user/create');
        $view->title = 'Sign In';
        $view->display();
    }

    public function doCreate()
    {
        $username = ConnectionHandler::getConnection()->escape_string($_POST['username']);
        $password = sha1($_POST['password']);
        $confirm_password = sha1($_POST['confirm_password']);

        $userRepository = new UserRepository();
        $userRepository->createUser($username, $password, $confirm_password);

        header('Location: /user/login');
    }

    public function login()
    {
        if (isset($_SESSION['loggedIn'])) {
            header('Location: /');
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
        $password = sha1($_POST['password']);
        $userRepository = new UserRepository();
        $user = $userRepository->loginUser($username, $password);

        if ($user->id > 0) {
            $_SESSION['loggedIn'] = true;
            $_SESSION['userID'] = $user->id;
            SessionHelper::updateUserCategory();
            header('Location: /');
            exit();
        } else {
            echo '<p>login failed</p>';
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
}
