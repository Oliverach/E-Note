<?php
namespace App\Controller;

use App\Database\ConnectionHandler;
use App\Repository\TaskRepository;
use App\View\View;
class TaskController
{
    public function create()
    {
        if(!isset($_GET['id']) || !is_numeric($_GET['id'])){
            header("Location: /");
            exit();
        }
        $taskRepository = new TaskRepository();
        $_SESSION['currentCategoryID'] = (int)$_GET['id'];
        $_SESSION['taskOfCurrentCategory'] = $taskRepository->getTaskOfCurrentCategory($_SESSION['currentCategoryID']);
        $_SESSION['completedTaskOfCurrentCategory'] = $taskRepository->getCompletedTaskOfCurrentCategory($_SESSION['currentCategoryID']);
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
        header('Location: /task/create?id='.$categoryID);
        exit();
    }
    public function complete(){
        $taskID = (int)$_GET['id'];
        $taskRepository = new TaskRepository();
        $taskRepository->completeTask($taskID);
        $categoryID = $_SESSION['currentCategoryID'];
        header('Location: /task/create?id='.$categoryID);
        exit();
    }

}