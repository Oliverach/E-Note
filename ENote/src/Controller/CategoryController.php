<?php

namespace App\Controller;

use App\Database\ConnectionHandler;
use App\Helper\SessionHelper;
use App\Repository\CategoryRepository;
use App\Repository\UserRepository;
use App\View\View;

class CategoryController
{
    public function  create()
    {
        $view = new View('category/addCategory');
        $view->title = 'Add Category';
        $view->display();
    }
    public function  showAll()
    {
        SessionHelper::updateUserCategory();
        $view = new View('category/allCategory');
        $view->title = 'All Category';
        $view->display();
    }
    public function doCreate(){
        $name = ConnectionHandler::getConnection()->escape_string($_POST['name']);
        $userID = $_SESSION["userID"];
        $color = ConnectionHandler::getConnection()->escape_string($_POST['color']);
        $categoryRepository = new CategoryRepository();
        $categoryRepository->addCategory($name,$userID,$color);
        SessionHelper::updateUserCategory();
        header("Location: /category/showAll ");
    }
}