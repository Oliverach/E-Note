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
        ValidationHelper::checkIfUserLoggedIn();
        if(!isset($_GET['category_id']) || !is_numeric($_GET['category_id'])){
            header("Location: /");
            exit();
        }
        $this->checkIfCategoryExists($_GET['category_id']);
        $this->updateSpecificCategoryContent();
        $view = new View('task/task');
        $view->title = 'Task';
        $view->display();
    }

    public function addTask(){
        ValidationHelper::checkIfUserLoggedIn();
        if (empty($_POST['description']) || empty($_POST['date'])){
            header('Location: /task/?category_id='.$_SESSION['currentCategory']->id);
            exit();
        }
        if(!ValidationHelper::validateTaskDescription($_POST['description'])){
            header('Location: /task/?category_id='.$_SESSION['currentCategory']->id);
            exit();
        }else{
            $taskRepository = new TaskRepository();
            $description = ConnectionHandler::getConnection()->escape_string($_POST['description']);
            $date = $_POST['date'];
            $taskRepository->checkIfTaskExist($description, $date, $_SESSION['currentCategory']->id);
            $taskRepository->addTask($description,$date,$_SESSION['currentCategory']->id);
            SessionHelper::updateAllCategoryContent();
            header('Location: /task/?category_id='.$_SESSION['currentCategory']->id);
            exit();
        }
    }

    public function complete(){
        ValidationHelper::checkIfUserLoggedIn();
        if(!isset($_GET['id']) || !is_numeric($_GET['id'])){
            header('Location: /task/?category_id='.$_SESSION['currentCategory']->id);
            exit();
        }
        $task_id = (int)$_GET['id'];
        $taskRepository = new TaskRepository();
        $taskRepository->checkByIDIfTaskExists($task_id);
        $taskRepository->completeTask($task_id,  $_SESSION['user']->id);
        SessionHelper::updateAllCategoryContent();
        header('Location: /task/?category_id='.$_SESSION['currentCategory']->id);
        exit();
    }

    public function delete(){
        ValidationHelper::checkIfUserLoggedIn();
        if(!isset($_GET['id']) || !is_numeric($_GET['id'])){
            header('Location: /task/?category_id='.$_SESSION['currentCategory']->id);
            exit();
        }
        $task_id = (int)$_GET['id'];
        $taskRepository = new TaskRepository();
        $taskRepository->checkByIDIfTaskExists($task_id);
        $taskRepository->deleteTaskByTaskID($task_id);
        header('Location: /task/?category_id='.$_SESSION['currentCategory']->id);
        exit();
    }

    public function deleteTaskOfCategory(){
        ValidationHelper::checkIfUserLoggedIn();
        $this->checkIfCategoryExists($_SESSION['currentCategory']->id);
        $taskRepository = new TaskRepository();
        $taskRepository->deleteTaskByCategoryID($_SESSION['currentCategory']->id);
        header('Location: /task/?category_id='.$_SESSION['currentCategory']->id);
        exit();
    }

    public function checkIfCategoryExists($category_id)
    {
        $categoryRepository = new CategoryRepository();
        $result = $categoryRepository->checkIfCategoryExists($category_id , $_SESSION['user']->id);
        if (empty($result->id)){
            $_SESSION['warning'] = "Category not found";
            header("Location: /");
            exit();
        }
    }

    public function updateSpecificCategoryContent(){
        $categoryRepository = new CategoryRepository();
        $taskRepository = new TaskRepository();
        $category_id = (int)$_GET['category_id'];
        $user_id = $_SESSION['user']->id;
        $_SESSION['currentCategory'] = $categoryRepository->getCurrentCategoryByID($category_id,$user_id);
        $_SESSION['taskOfCurrentCategory'] = $taskRepository->getTaskOfCurrentCategory($category_id, $user_id);
        $_SESSION['completedTaskOfCurrentCategory'] = $taskRepository->getCompletedTaskOfCurrentCategory($category_id, $user_id);
    }
}