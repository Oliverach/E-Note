<?php


namespace App\Helper;


use App\Repository\CategoryRepository;
use App\Repository\TaskRepository;

class SessionHelper
{
    public static function updateUserContent()
    {
        $categoryRepository = new CategoryRepository();
        $taskRepository = new TaskRepository();
        $userId = $_SESSION['user']->id;
        $_SESSION['userCategory'] = $categoryRepository->getCategoriesByUserID($userId);
        $_SESSION['taskAmountByCategory'] = $categoryRepository->getTaskAmountByCategory($userId);
        $_SESSION['taskOfCurrentDay'] = $taskRepository->getTaskOfCurrentDay($userId);
        $_SESSION['taskOfNextDay'] = $taskRepository->getTaskOfNextDay($userId);
    }
    public static function updateSpecificCategoryContent(){
        $categoryRepository = new CategoryRepository();
        $taskRepository = new TaskRepository();
        $_SESSION['currentCategory'] = $categoryRepository->getCurrentCategoryByID((int)$_GET['category_id']);
        $_SESSION['taskOfCurrentCategory'] = $taskRepository->getTaskOfCurrentCategory($_SESSION['currentCategory']->id);
        $_SESSION['completedTaskOfCurrentCategory'] = $taskRepository->getCompletedTaskOfCurrentCategory($_SESSION['currentCategory']->id);
    }
}