<?php

namespace App\Repository;

use App\Database\ConnectionHandler;
use Exception;


class TaskRepository extends Repository
{
    protected $tableName = "task";

    public function addTask($description, $date, $categoryID)
    {
        $defaultStatus = 0;
        $query = "INSERT INTO $this->tableName (description, dueDate, status, category_id)VALUES (?,?,?,?)";
        $connection = ConnectionHandler::getConnection();
        $statement = $connection->prepare($query);
        if ($statement == false) {
            throw new Exception($connection->error);
        }
        $statement->bind_param('ssii', $description, $date,$defaultStatus,$categoryID);
        // Das Statement absetzen
        $statement->execute();
    }

    public function getTaskOfCurrentCategory($currentCategoryID)
    {
        $defaultStatus = 0;
        $query = "SELECT * FROM $this->tableName where category_id =? AND status = ?";
        $statement = ConnectionHandler::getConnection()->prepare($query);
        if (false === $statement) {
            throw new Exception(ConnectionHandler::getConnection()->error);
        }
        $rc = $statement->bind_param('ii', $currentCategoryID,$defaultStatus);
        if (false === $rc) {
            throw new Exception($statement->error);
        }
        $statement->execute();
        $result = $statement->get_result();
        if (!$result) {
            throw new Exception($statement->error);
        }
        if ($result->num_rows > 0){
            $row = $result->fetch_all(MYSQLI_ASSOC);
            return $row;
        }
    }

    public function completeTask($taskID)
    {
        $completedStatus = 1;
        $query = "UPDATE $this->tableName SET status =? WHERE id=?";
        $statement = ConnectionHandler::getConnection()->prepare($query);
        if (false === $statement) {
            throw new Exception(ConnectionHandler::getConnection()->error);
        }
        $rc = $statement->bind_param('ii', $completedStatus,$taskID);
        if (false === $rc) {
            throw new Exception($statement->error);
        }
        $statement->execute();
    }

    public function getCompletedTaskOfCurrentCategory($currentCategoryID)
    {
        $wantedStatus = 1;
        $query = "SELECT * FROM $this->tableName where category_id =? AND status = ?";
        $statement = ConnectionHandler::getConnection()->prepare($query);
        if (false === $statement) {
            throw new Exception(ConnectionHandler::getConnection()->error);
        }
        $rc = $statement->bind_param('ii', $currentCategoryID,$wantedStatus);
        if (false === $rc) {
            throw new Exception($statement->error);
        }
        $statement->execute();
        $result = $statement->get_result();
        if (!$result) {
            throw new Exception($statement->error);
        }
        if ($result->num_rows > 0){
            $row = $result->fetch_all(MYSQLI_ASSOC);
            return $row;
        }
    }
}
