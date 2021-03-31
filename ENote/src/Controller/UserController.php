<?php

namespace App\Controller;

use App\Database\ConnectionHandler;
use App\Helper\SessionHelper;
use App\Helper\ValidationHelper;
use App\Repository\UserRepository;
use App\View\View;

class UserController
{
    public function index()
    {
        ValidationHelper::checkIfUserLoggedIn();
        unset($_SESSION['currentCategory']);
        $view = new View('user/profile');
        $view->title = 'Personal Info';
        $view->display();
    }

    public function create()
    {
        ValidationHelper::redirectIfLoggedIn();
        $view = new View('user/signin');
        $view->title = 'Sign In';
        $view->display();
    }

    public function doCreate()
    {
        if (!ValidationHelper::validatePasswordFormat($_POST['password'])) {
            header('Location: /user/create');
            exit();
        } else {
            $userRepository = new UserRepository();
            $username = ConnectionHandler::getConnection()->escape_string($_POST['username']);
            $password = hash('sha256', $_POST['password']);
            $confirm_password = hash('sha256', $_POST['confirm_password']);
            $userRepository->registerUser($username, $password, $confirm_password);
            $_SESSION['success'] = "Register successful";
            header('Location: /user/login');
            exit();
        }
    }

    public function login()
    {
        ValidationHelper::redirectIfLoggedIn();
        $view = new View('user/login');
        $view->title = 'Login';
        $view->display();
    }

    public function doLogin()
    {
        $userRepository = new UserRepository();
        $username = ConnectionHandler::getConnection()->escape_string($_POST['username']);
        $password = hash('sha256', $_POST['password']);
        $user = $userRepository->checkUserExistance($username, $password);
        if (isset($user->id)) {
            $_SESSION['loggedIn'] = true;
            $_SESSION['user'] = $user;
            SessionHelper::updateAllCategoryContent();
            header('Location: /category');
            exit();
        } else {
            $_SESSION['warning'] = "Login Failed";
            header('Location: /user/login');
            exit();
        }
    }

    public function updateUserInfo()
    {
        ValidationHelper::checkIfUserLoggedIn();
        $view = new View('user/changeProfile');
        $view->title = 'Personal Info';
        $view->display();
    }

    public function doUpdateUserInfo()
    {
        ValidationHelper::checkIfUserLoggedIn();
        if (empty($_POST['email']) || empty($_POST['password'])){
            header('Location: /user/updateProfile');
            exit();
        }
        $email = ConnectionHandler::getConnection()->escape_string($_POST['email']);
        ValidationHelper::isEmail($email);
        $password = hash('sha256', $_POST['password']);
        $userRepository = new UserRepository();
        $userRepository->updateUserInfo($email, $password);
    }

    public function changePassword()
    {
        ValidationHelper::checkIfUserLoggedIn();
        $view = new View('user/changePassword');
        $view->title = 'Change Password';
        $view->display();
    }

    public function doChangePassword()
    {
        if (empty($_POST['confirmNewPW']) || empty($_POST['currentPW'] || empty($_POST['newPW']))){
            header('Location: /user/changePassword');
            exit();
        }
        if (!ValidationHelper::validatePasswordFormat($_POST['newPW'])) {
            header('Location: /user/changePassword');
            exit();
        } else {
            $newPW = hash('sha256', $_POST['newPW']);
            $confirmNewPW = hash('sha256', $_POST['confirmNewPW']);
            $currentPW = hash('sha256', $_POST['currentPW']);
            $userRepository = new UserRepository();
            $userRepository->changeUserPassword($newPW, $confirmNewPW, $currentPW);
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
