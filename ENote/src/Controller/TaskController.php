<?php
namespace App\Controller;

use App\Database\ConnectionHandler;
use App\Repository\TaskRepository;
use App\Repository\UserRepository;
use App\View\View;
class TaskController
{

    public function index()
    {
        $view = new View('task/index');
        $view->title = 'Task';
        $view->display();
    }

    public function create()
    {
        $_SESSION['currentCategoryID'] = (int)$_POST['id'];
        $view = new View('task/task');
        $view->title = 'Task';
        $view->display();
    }

    public function addTask(){
        $description = ConnectionHandler::getConnection()->escape_string($_POST['description']);
        $date = $_POST['date'];
        $taskRepository = new TaskRepository();
        $categoryID = $_SESSION['currentCategoryID'];
        $taskRepository->addTask($description,$date,$categoryID);
        header('Location: /task/index');
        exit();
    }

}