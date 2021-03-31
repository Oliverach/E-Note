<?php

namespace App\Controller;

use App\Database\ConnectionHandler;
use App\Helper\SessionHelper;
use App\Helper\ValidationHelper;
use App\Repository\CategoryRepository;
use App\View\View;

class CategoryController
{
    public function index()
    {
        ValidationHelper::redirectIfNotLoggedIn();
        SessionHelper::updateAllCategoryContent();
        $view = new View('category/allCategory');
        $view->title = 'All Category';
        $_SESSION['showingAll'] = true;
        $view->display();
    }

    public function create()
    {
        ValidationHelper::redirectIfNotLoggedIn();
        $view = new View('category/addCategory');
        $view->title = 'Add Category';
        $_SESSION['creating'] = true;
        $view->display();
    }

    public function doCreate()
    {
        ValidationHelper::redirectIfNotLoggedIn();
        if (empty($_POST['name']) || empty($_POST['color']) || !ValidationHelper::validateCategoryName($_POST['name'])) {
            header('Location: /category/create');
            exit();
        }
        $name = ConnectionHandler::getConnection()->escape_string($_POST['name']);
        $user_id = $_SESSION["user"]->id;
        $color = ConnectionHandler::getConnection()->escape_string($_POST['color']);
        $categoryRepository = new CategoryRepository();
        $result = $categoryRepository->checkCategoryAvailability($name, $user_id);
        if (!$result) {
            $_SESSION['warning'] = "Category already exists";
            header('Location: /category/create');
            exit();
        } else {
            $categoryRepository->addCategory($name, $user_id, $color);
        }
        SessionHelper::updateAllCategoryContent();
        header("Location: /category ");
        exit();
    }

    public function deleteCategory()
    {
        ValidationHelper::redirectIfNotLoggedIn();
        if (empty($_SESSION['currentCategory'])) {
            header("Location: /category ");
            exit();
        } else {
            $categoryRepository = new CategoryRepository();
            $categoryRepository->deleteCategoryById($_SESSION['currentCategory']->id, $_SESSION['user']->id);
            header('Location: /category');
            exit();
        }
    }
}