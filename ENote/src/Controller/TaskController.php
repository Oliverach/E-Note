<?php
namespace App\Controller;

use App\Database\ConnectionHandler;
use App\Helper\SessionHelper;
use App\Repository\CategoryRepository;
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
        $categoryRepository = new CategoryRepository();
        $_SESSION['currentCategory'] = $categoryRepository->getCurrentCategoryByID((int)$_GET['id']);
        $_SESSION['taskOfCurrentCategory'] = $taskRepository->getTaskOfCurrentCategory($_SESSION['currentCategory']->id);
        $_SESSION['completedTaskOfCurrentCategory'] = $taskRepository->getCompletedTaskOfCurrentCategory($_SESSION['currentCategory']->id);
        $view = new View('task/task');
        $view->title = 'Task';
        $view->display();
    }

    public function addTask(){
        $description = ConnectionHandler::getConnection()->escape_string($_POST['description']);
        $date = $_POST['date'];
        $taskRepository = new TaskRepository();
        $taskRepository->addTask($description,$date,$_SESSION['currentCategory']->id);
        SessionHelper::updateUserContent();
        header('Location: /task/create?id='.$_SESSION['currentCategory']->id);
        exit();
    }
    public function complete(){
        $taskID = (int)$_GET['id'];
        $taskRepository = new TaskRepository();
        $taskRepository->completeTask($taskID);
        header('Location: /task/create?id='.$_SESSION['currentCategory']->id);
        exit();
    }
    public function deleteTaskOfCategory(){
        $taskRepository = new TaskRepository();
        $taskRepository->deleteTaskByCategoryID($_SESSION['currentCategory']->id);
        header('Location: /task/create?id='.$_SESSION['currentCategory']->id.'&name='.$_SESSION['currentCategory']->name.'');
    }
    public function deleteTaskByID(){
        $taskID = (int)$_GET['id'];
        $taskRepository = new TaskRepository();
        $taskRepository->deleteTaskByTaskID($taskID);
        header('Location: /task/create?id='.$_SESSION['currentCategory']->id.'&name='.$_SESSION['currentCategory']->name.'');
    }

}