<?php
namespace App\Controller;

use App\Database\ConnectionHandler;
use App\Helper\SessionHelper;
use App\Helper\ValidationHelper;
use App\Repository\CategoryRepository;
use App\Repository\TaskRepository;
use App\View\View;

class TaskController
{
    public function index()
    {
        if(!isset($_GET['category_id']) || !is_numeric($_GET['category_id'])){
            header("Location: /");
            exit();
        }
        self::checkIfCategoryExists($_GET['category_id']);
        ValidationHelper::checkIfUserLoggedIn();
        SessionHelper::updateSpecificCategoryContent();
        $view = new View('task/task');
        $view->title = 'Task';
        $view->display();
    }

    public function addTask(){
        ValidationHelper::checkIfUserLoggedIn();
        $description = ConnectionHandler::getConnection()->escape_string($_POST['description']);
        $date = $_POST['date'];

        if(empty($description) && ValidationHelper::hasLength(40, $description)){
            $_SESSION['warning']= "Description required";
        }

        $taskRepository = new TaskRepository();
        $taskRepository->addTask($description,$date,$_SESSION['currentCategory']->id);
        SessionHelper::updateUserContent();
        header('Location: /task/?category_id='.$_SESSION['currentCategory']->id);
        exit();
    }

    public function complete(){
        ValidationHelper::checkIfUserLoggedIn();
        if(!isset($_GET['id']) || !is_numeric($_GET['id'])){
            header('Location: /task/?category_id='.$_SESSION['currentCategory']->id);
            exit();
        }
        self::checkIfTaskExists((int)$_GET['id']);
        $taskID = (int)$_GET['id'];
        $taskRepository = new TaskRepository();
        $taskRepository->completeTask($taskID);
        SessionHelper::updateUserContent();
        header('Location: /task/?category_id='.$_SESSION['currentCategory']->id);
        exit();
    }

    public function deleteTaskOfCategory(){
        ValidationHelper::checkIfUserLoggedIn();
        $taskRepository = new TaskRepository();
        $taskRepository->deleteTaskByCategoryID($_SESSION['currentCategory']->id);
        header('Location: /task/?id='.$_SESSION['currentCategory']->id.'&name='.$_SESSION['currentCategory']->name.'');
    }

    public function deleteTaskByID(){
        ValidationHelper::checkIfUserLoggedIn();
        $taskID = (int)$_GET['id'];
        $taskRepository = new TaskRepository();
        $taskRepository->deleteTaskByTaskID($taskID);
        header('Location: /task/?id='.$_SESSION['currentCategory']->id.'&name='.$_SESSION['currentCategory']->name.'');
    }

    public function checkIfCategoryExists($category_id)
    {
        $categoryRepository = new CategoryRepository();
        if (!$categoryRepository->checkIfCategoryExists($category_id)){
            header("Location: /");
            exit();
        }
    }

    public function checkIfTaskExists($task_id)
    {
        $taskRepository = new TaskRepository();
        if (!$taskRepository->checkIfTaskExists($task_id)){
            header('Location: /task/?category_id='.$_SESSION['currentCategory']->id);
            exit();
        }
    }
}