<?php


namespace App\Helper;


use App\Repository\CategoryRepository;

class SessionHelper
{
    public static function updateUserCategory()
    {
        $categoryRepository = new CategoryRepository();
        $_SESSION['userCategory'] = $categoryRepository->getCategoriesByUserID($_SESSION['userID']);
        $_SESSION['taskAmountByCategory'] = $categoryRepository->getTaskAmountByCategory($_SESSION['userID']);
        $_SESSION['taskOfCurrentDay'] = $categoryRepository->getTaskOfCurrentDay($_SESSION['userID']);
    }
}