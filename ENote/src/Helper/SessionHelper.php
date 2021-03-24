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
        $_SESSION['userCategory'] = $categoryRepository->getCategoriesByUserID($_SESSION['user']->id);
        $_SESSION['taskAmountByCategory'] = $categoryRepository->getTaskAmountByCategory($_SESSION['user']->id);
        $_SESSION['taskOfCurrentDay'] = $taskRepository->getTaskOfCurrentDay($_SESSION['user']->id);
        $_SESSION['taskOfNextDay'] = $taskRepository->getTaskOfNextDay($_SESSION['user']->id);
    }
}