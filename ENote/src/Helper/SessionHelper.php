<?php


namespace App\Helper;


use App\Repository\CategoryRepository;
use App\Repository\TaskRepository;

class SessionHelper
{
    public static function updateAllCategoryContent()
    {
        $categoryRepository = new CategoryRepository();
        $taskRepository = new TaskRepository();
        $userId = $_SESSION['user']->id;
        $_SESSION['userCategory'] = $categoryRepository->getCategoriesByUserID($userId);
        $_SESSION['taskAmountByCategory'] = $categoryRepository->getTaskAmountByCategory($userId);
        $_SESSION['taskOfCurrentDay'] = $taskRepository->getTaskOfCurrentDay($userId);
        $_SESSION['taskOfNextDay'] = $taskRepository->getTaskOfNextDay($userId);
    }
}