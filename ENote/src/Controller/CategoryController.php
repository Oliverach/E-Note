<?php

namespace App\Controller;

use App\Database\ConnectionHandler;
use App\Helper\SessionHelper;
use App\Helper\ValidationHelper;
use App\Repository\CategoryRepository;
use App\View\View;

class CategoryController
{
    public function  index()
    {
        ValidationHelper::checkIfUserLoggedIn();
        SessionHelper::updateUserContent();
        $view = new View('category/allCategory');
        $view->title = 'All Category';
        $_SESSION['showingAll'] = true;
        $view->display();
    }

    public function  create()
    {
        ValidationHelper::checkIfUserLoggedIn();
        $view = new View('category/addCategory');
        $view->title = 'Add Category';
        $_SESSION['creating'] = true;
        $view->display();
    }

    public function doCreate(){
        ValidationHelper::checkIfUserLoggedIn();
        $name = ConnectionHandler::getConnection()->escape_string($_POST['name']);
        $userID = $_SESSION["user"]->id;
        $color = ConnectionHandler::getConnection()->escape_string($_POST['color']);
        $categoryRepository = new CategoryRepository();
        $categoryRepository->addCategory($name,$userID,$color);
        SessionHelper::updateUserContent();
        header("Location: /category ");
        exit();
    }
    public function deleteCategory(){
        ValidationHelper::checkIfUserLoggedIn();
        $categoryRepository = new CategoryRepository();
        $categoryRepository->deleteCategoryById($_SESSION['currentCategory']->id);
        header('Location: /category');
        exit();
    }
}