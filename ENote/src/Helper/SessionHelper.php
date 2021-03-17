<?php


namespace App\Helper;


use App\Repository\CategoryRepository;

class SessionHelper
{
    public static function updateUserCategory()
    {
        $categoryRepository = new CategoryRepository();
        $_SESSION['userCategory'] = $categoryRepository->getCategoriesByUserID($_SESSION['userID']);
    }
}