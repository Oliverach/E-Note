<?php

namespace App\Repository;

use App\Database\ConnectionHandler;
use Exception;


class TaskRepository extends Repository
{
    protected $tableName = "task";

    public function addTask($description, $date, $category_id)
    {
        $defaultStatus = 0;
        $query = "INSERT INTO $this->tableName (description, dueDate, status, category_id)VALUES (?,?,?,?)";
        $connection = ConnectionHandler::getConnection();
        $statement = $connection->prepare($query);
        if ($statement == false) {
            throw new Exception($connection->error);
        }
        $rc = $statement->bind_param('ssii', $description, $date, $defaultStatus, $category_id);
        if (false === $rc) {
            throw new Exception($statement->error);
        }
        $statement->execute();
    }



    public function getTaskOfCurrentCategory($currentCategory_id)
    {
        $defaultStatus = 0;
        $query = "SELECT task.id task_id, task.*, category.id c_id, category.* FROM $this->tableName JOIN category ON category.id = category_id where category_id =? AND status = ? AND user_id =?";
        $statement = ConnectionHandler::getConnection()->prepare($query);
        if (false === $statement) {
            throw new Exception(ConnectionHandler::getConnection()->error);
        }
        $rc = $statement->bind_param('iii', $currentCategory_id, $defaultStatus, $_SESSION['user']->id);
        if (false === $rc) {
            throw new Exception($statement->error);
        }
        $statement->execute();
        $result = $statement->get_result();
        if (!$result) {
            throw new Exception($statement->error);
        }
        if ($result->num_rows > 0) {
            $row = $result->fetch_all(MYSQLI_ASSOC);
            return $row;
        }
    }

    public function completeTask($task_id)
    {
        $completedStatus = 1;
        $query = "UPDATE $this->tableName JOIN category ON category.id = category_id SET status =? WHERE task.id=? AND user_id=?";
        $statement = ConnectionHandler::getConnection()->prepare($query);
        if (false === $statement) {
            throw new Exception(ConnectionHandler::getConnection()->error);
        }
        $rc = $statement->bind_param('iii', $completedStatus, $task_id, $_SESSION['user']->id);
        if (false === $rc) {
            throw new Exception($statement->error);
        }
        $statement->execute();
    }

    public function getCompletedTaskOfCurrentCategory($currentCategory_id)
    {
        $wantedStatus = 1;
        $query = "SELECT task.id task_id, task.*, category.id c_id, category.* FROM $this->tableName JOIN category ON category.id = category_id WHERE category_id =? AND status = ? AND user_id =? ";
        $statement = ConnectionHandler::getConnection()->prepare($query);
        if (false === $statement) {
            throw new Exception(ConnectionHandler::getConnection()->error);
        }
        $rc = $statement->bind_param('iii', $currentCategory_id, $wantedStatus, $_SESSION['user']->id);
        if (false === $rc) {
            throw new Exception($statement->error);
        }
        $statement->execute();
        $result = $statement->get_result();
        if (!$result) {
            throw new Exception($statement->error);
        }
        if ($result->num_rows > 0) {
            $row = $result->fetch_all(MYSQLI_ASSOC);
            return $row;
        }
    }

    public function getTaskOfCurrentDay($user_id)
    {
        $wantedStatus = 0;
        $query = "SELECT  task.id, description, category_id, category.color, dueDate  FROM $this->tableName JOIN category ON task.category_id = category.id WHERE dueDate = CAST(CURRENT_TIMESTAMP as date) AND user_id =? AND status =?";
        $statement = ConnectionHandler::getConnection()->prepare($query);
        if (false === $statement) {
            throw new Exception(ConnectionHandler::getConnection()->error);
        }
        $rc = $statement->bind_param('ii', $user_id, $wantedStatus);
        if (false === $rc) {
            throw new Exception($statement->error);
        }
        $statement->execute();
        $result = $statement->get_result();
        if (!$result) {
            throw new Exception($statement->error);
        }
        if ($result->num_rows > 0) {
            $row = $result->fetch_all(MYSQLI_ASSOC);
            return $row;
        }
    }

    public function getTaskOfNextDay($user_id)
    {
        $wantedStatus = 0;
        $timeAddition = 1;
        $query = "SELECT  task.id , description, category_id, category.color, dueDate  FROM $this->tableName JOIN category ON task.category_id = category.id WHERE dueDate = DATE_ADD(CAST(CURRENT_TIMESTAMP as date), INTERVAL ? DAY) AND user_id=? AND status =?";
        $statement = ConnectionHandler::getConnection()->prepare($query);
        if (false === $statement) {
            throw new Exception(ConnectionHandler::getConnection()->error);
        }
        $rc = $statement->bind_param('iii', $timeAddition, $user_id, $wantedStatus);
        if (false === $rc) {
            throw new Exception($statement->error);
        }
        $statement->execute();
        $result = $statement->get_result();
        if (!$result) {
            throw new Exception($statement->error);
        }
        if ($result->num_rows > 0) {
            $row = $result->fetch_all(MYSQLI_ASSOC);
            return $row;
        }
    }

    public function deleteTaskByCategoryID($category_id)
    {
        $query = "DELETE t FROM $this->tableName t JOIN category c ON c.id = t.category_id WHERE t.category_id =? AND c.user_id =?";
        $statement = ConnectionHandler::getConnection()->prepare($query);
        if (false === $statement) {
            throw new Exception(ConnectionHandler::getConnection()->error);
        }
        $rc = $statement->bind_param('ii', $category_id, $_SESSION['user']->id);
        if (false === $rc) {
            throw new Exception($statement->error);
        }
        $statement->execute();
    }

    public function deleteTaskByTaskID($task_id)
    {
        $query = "DELETE t FROM $this->tableName t JOIN category c ON c.id = t.category_id WHERE t.id =? AND c.user_id =?";
        $statement = ConnectionHandler::getConnection()->prepare($query);
        if (false === $statement) {
            throw new Exception(ConnectionHandler::getConnection()->error);
        }
        $rc = $statement->bind_param('ii', $task_id, $_SESSION['user']->id);
        if (false === $rc) {
            throw new Exception($statement->error);
        }
        $statement->execute();
    }

    public function checkByIdIfTaskExists($task_id)
    {
        $query = "SELECT  task.id FROM $this->tableName JOIN category ON category.id = category_id WHERE task.id=? AND user_id=?";
        $statement = ConnectionHandler::getConnection()->prepare($query);
        if (false === $statement) {
            throw new Exception(ConnectionHandler::getConnection()->error);
        }
        $rc = $statement->bind_param('ii', $task_id, $_SESSION['user']->id);
        if (false === $rc) {
            throw new Exception($statement->error);
        }
        $statement->execute();
        $result = $statement->get_result();
        if (empty($result->num_rows)) {
            $_SESSION['warning'] = "Task does not exist";
            header('Location: /task/?category_id='.$_SESSION['currentCategory']->id);
            exit();
        }
    }

    public function checkIfTaskExist($description, $date, $category_id)
    {
        $wantedStatus = 0;
        $query = "SELECT task.id FROM $this->tableName JOIN category ON category.id = category_id WHERE category_id =? AND description =? AND dueDate=? AND status = ? AND user_id =? ";
        $statement = ConnectionHandler::getConnection()->prepare($query);
        if (false === $statement) {
            throw new Exception(ConnectionHandler::getConnection()->error);
        }
        $rc = $statement->bind_param('issii', $category_id, $description, $date, $wantedStatus, $_SESSION['user']->id);
        if (false === $rc) {
            throw new Exception($statement->error);
        }
        $statement->execute();
        $result = $statement->get_result();
        if ($result->num_rows > 0) {
            $_SESSION['warning'] = "Task already exists";
            header('Location: /task/?category_id='.$_SESSION['currentCategory']->id);
            exit();
        }
    }
}
