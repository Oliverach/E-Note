<?php

namespace App\Repository;

use App\Database\ConnectionHandler;
use Exception;


class CategoryRepository extends Repository
{
    protected $tableName = "category";

    public function addCategory( $name, $userID, $color)
    {
        $query = "INSERT INTO $this->tableName(name, user_ID, color) VALUES (?,?,?) ";
        $statement = ConnectionHandler::getConnection()->prepare($query);
        if (false === $statement) {
            throw new Exception(ConnectionHandler::getConnection()->error);
        }
        $rc = $statement->bind_param('sis', $name,$userID,$color);
        if (false === $rc) {
            throw new Exception($statement->error);
        }
        $statement->execute();

    }

    public function getCategoriesByUserID($userID){
        $query = "SELECT name, color, id FROM $this->tableName where user_id =?";
        $statement = ConnectionHandler::getConnection()->prepare($query);
        if (false === $statement) {
            throw new Exception(ConnectionHandler::getConnection()->error);
        }
        $rc = $statement->bind_param('i', $userID);
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
    public function getTaskAmountByCategory($userID){
        $wantedStatus = 0;
        $query = "SELECT category.name, COUNT(category_id) as amount FROM task JOIN category ON category.id = task.category_id WHERE category.user_id =? AND task.status =? GROUP BY category.name";
        $statement = ConnectionHandler::getConnection()->prepare($query);
        if (false === $statement) {
            throw new Exception(ConnectionHandler::getConnection()->error);
        }
        $rc = $statement->bind_param('ii', $userID, $wantedStatus);
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

    public function getTaskOfCurrentDay($userID)
    {
        $wantedStatus = 0;
        $query = "SELECT  task.id, description, category_id  FROM task JOIN category ON task.category_id = category.id WHERE dueDate = CAST(CURRENT_TIMESTAMP as date) AND user_id =? AND status =?";
        $statement = ConnectionHandler::getConnection()->prepare($query);
        if (false === $statement) {
            throw new Exception(ConnectionHandler::getConnection()->error);
        }
        $rc = $statement->bind_param('ii', $userID, $wantedStatus);
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
