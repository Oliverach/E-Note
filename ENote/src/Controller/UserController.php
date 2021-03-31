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
        ValidationHelper::redirectIfNotLoggedIn();
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
            $this->redirectToRegistration();
        }
        $userRepository = new UserRepository();
        $username = ConnectionHandler::getConnection()->escape_string($_POST['username']);
        $password = hash('sha256', $_POST['password']);
        $confirm_password = hash('sha256', $_POST['confirm_password']);
        $result = $userRepository->checkUserAvailability($username);
        if ($password == $confirm_password && $result->num_rows == 0) {
            $userRepository->registerUser($username, $password, $confirm_password);
        } else if ($result->num_rows != 0) {
            $_SESSION['warning'] = "User Already Exists";
            $this->redirectToRegistration();
        } else if ($password != $confirm_password) {
            $_SESSION['warning'] = "Passwords do no match";
            $this->redirectToRegistration();
        }
        $_SESSION['success'] = "Register successful";
        header('Location: /user/login');
        exit();
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
        ValidationHelper::redirectIfNotLoggedIn();
        $view = new View('user/changeProfile');
        $view->title = 'Personal Info';
        $view->display();
    }

    public function doUpdateUserInfo()
    {
        ValidationHelper::redirectIfNotLoggedIn();
        if (empty($_POST['email']) || empty($_POST['password'])) {
            header('Location: /user/updateProfile');
            exit();
        }
        $email = ConnectionHandler::getConnection()->escape_string($_POST['email']);
        ValidationHelper::isEmail($email);
        $password = hash('sha256', $_POST['password']);
        $userRepository = new UserRepository();
        $user = $userRepository->checkUserExistance($_SESSION['user']->username, $password);
        $emailAvailability = $userRepository->checkEMailAvailability($email);
        if (!$user){
            $_SESSION['warning'] = "Password Incorrect";
            $this->redirectToUpdateUserInfo();
        }else if(!$emailAvailability){
            $_SESSION['warning'] = "E-Mail unavailable";
            $this->redirectToUpdateUserInfo();
        }else{
            $userRepository->updateUserInfo($email);
        }
        $_SESSION['user'] = $userRepository->checkUserExistance($_SESSION['user']->username, $_SESSION['user']->password);
        $_SESSION['success'] = "Personal Info updated successfully";
        header('Location: /user');
        exit();
    }

    public function changePassword()
    {
        ValidationHelper::redirectIfNotLoggedIn();
        $view = new View('user/changePassword');
        $view->title = 'Change Password';
        $view->display();
    }

    public function doChangePassword()
    {
        if (empty($_POST['confirmNewPW']) || empty($_POST['currentPW'] || empty($_POST['newPW'] || !ValidationHelper::validatePasswordFormat($_POST['newPW'])))) {
            $this->redirectToChangePassword();
        }
        $newPW = hash('sha256', $_POST['newPW']);
        $confirmNewPW = hash('sha256', $_POST['confirmNewPW']);
        $currentPW = hash('sha256', $_POST['currentPW']);
        $userRepository = new UserRepository();
        $user = $userRepository->checkUserExistance($_SESSION['user']->username, $currentPW);
        if ($newPW == $currentPW) {
            $_SESSION['warning'] = "Can not change to same password";
            $this->redirectToChangePassword();
        } else if ($confirmNewPW != $newPW) {
            $_SESSION['warning'] = "Passwords do not match";
            $this->redirectToChangePassword();
        } else if (!$user){
            $_SESSION['warning'] = "Password Incorrect";
            $this->redirectToChangePassword();
        } else{
            $userRepository->changeUserPassword($newPW);
        }
        $_SESSION['user'] = $userRepository->checkUserExistance($_SESSION['user']->username, $newPW);
        $_SESSION['success'] = "Password changed successfully";
        header('Location: /user');
        exit();
    }

    public function logoutUser()
    {
        session_destroy();
        session_unset();
        header('Location: /user/login');
        exit();
    }

    public function redirectToRegistration()
    {
        header('Location: /user/create');
        exit();
    }

    public function redirectToChangePassword()
    {
        header('Location: /user/changePassword');
        exit();
    }

    public function redirectToUpdateUserInfo()
    {
        header('Location: /user/updateUserInfo');
        exit();
    }
}
