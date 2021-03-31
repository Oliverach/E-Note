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
        ValidationHelper::redirectIfNotLoggedIn();
        if (!isset($_GET['category_id']) || !is_numeric($_GET['category_id'])) {
            header("Location: /");
            exit();
        }
        $this->checkIfCategoryExists($_GET['category_id']);
        $this->updateSpecificCategoryContent();
        $view = new View('task/task');
        $view->title = 'Task';
        $view->display();
    }

    public function addTask()
    {
        ValidationHelper::redirectIfNotLoggedIn();
        if (empty($_POST['description']) || empty($_POST['date']) || !ValidationHelper::validateTaskDescription($_POST['description'])) {
            $this->redirectToCurrentCategory();
        } else {
            $taskRepository = new TaskRepository();
            $description = ConnectionHandler::getConnection()->escape_string($_POST['description']);
            $date = $_POST['date'];
            $result = $taskRepository->checkIfTaskExist($description, $date, $_SESSION['currentCategory']->id);
            if(!$result){
                $_SESSION['warning'] = "Task already exists";
                $this->redirectToCurrentCategory();
            }
            $taskRepository->addTask($description, $date, $_SESSION['currentCategory']->id);
            SessionHelper::updateAllCategoryContent();
            $this->redirectToCurrentCategory();
        }
    }

    public function complete()
    {
        ValidationHelper::redirectIfNotLoggedIn();
        if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
            $this->redirectToCurrentCategory();
        }
        $task_id = (int)$_GET['id'];
        $taskRepository = new TaskRepository();
        $result = $taskRepository->checkByIDIfTaskExists($task_id);
        if (!$result){
            $_SESSION['warning'] = "Task does not exist";
            $this->redirectToCurrentCategory();
        }
        $taskRepository->completeTask($task_id, $_SESSION['user']->id);
        SessionHelper::updateAllCategoryContent();
        $this->redirectToCurrentCategory();
    }

    public function delete()
    {
        ValidationHelper::redirectIfNotLoggedIn();
        if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
            $this->redirectToCurrentCategory();
        }
        $task_id = (int)$_GET['id'];
        $taskRepository = new TaskRepository();
        $result = $taskRepository->checkByIDIfTaskExists($task_id);
        if(!$result){
            $_SESSION['warning'] = "Task does not exist";
            $this->redirectToCurrentCategory();
        }
        $taskRepository->deleteTaskByTaskID($task_id);
        $this->redirectToCurrentCategory();
    }

    public function deleteTaskOfCategory()
    {
        ValidationHelper::redirectIfNotLoggedIn();
        $this->checkIfCategoryExists($_SESSION['currentCategory']->id);
        $taskRepository = new TaskRepository();
        $taskRepository->deleteTaskByCategoryID($_SESSION['currentCategory']->id);
        $this->redirectToCurrentCategory();
    }

    public function checkIfCategoryExists($category_id)
    {
        $categoryRepository = new CategoryRepository();
        $result = $categoryRepository->checkIfCategoryExists($category_id, $_SESSION['user']->id);
        if (empty($result->id)) {
            $_SESSION['warning'] = "Category not found";
            header("Location: /");
            exit();
        }
    }

    public function updateSpecificCategoryContent()
    {
        $categoryRepository = new CategoryRepository();
        $taskRepository = new TaskRepository();
        $category_id = (int)$_GET['category_id'];
        $user_id = $_SESSION['user']->id;
        $_SESSION['currentCategory'] = $categoryRepository->getCurrentCategoryByID($category_id, $user_id);
        $_SESSION['taskOfCurrentCategory'] = $taskRepository->getTaskOfCurrentCategory($category_id, $user_id);
        $_SESSION['completedTaskOfCurrentCategory'] = $taskRepository->getCompletedTaskOfCurrentCategory($category_id, $user_id);
    }

    public function redirectToCurrentCategory()
    {
        header('Location: /task/?category_id=' . $_SESSION['currentCategory']->id);
        exit();
    }
}