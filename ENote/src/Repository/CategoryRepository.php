<?php

namespace App\Repository;

use App\Database\ConnectionHandler;
use Exception;


class CategoryRepository extends Repository
{
    protected $tableName = "category";

    public function addCategory( $name, $userID, $color)
    {
        $this->checkCategoryAvailability($name, $userID);
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
    public function checkCategoryAvailability($categoryName,$userID){
        $query = "SELECT name FROM $this->tableName where name =? AND user_id =?";
        $statement = ConnectionHandler::getConnection()->prepare($query);
        if (false === $statement) {
            throw new Exception(ConnectionHandler::getConnection()->error);
        }
        $rc = $statement->bind_param('si', $categoryName,$userID);
        if (false === $rc) {
            throw new Exception($statement->error);
        }
        $statement->execute();
        $result = $statement->get_result();
        if (!$result) {
            throw new Exception($statement->error);
        }
        if ($result->num_rows > 0){
            $_SESSION['warning'] = "Category already exists";
            header('Location: /user/showProfile');
            exit();
        }
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

    public function deleteCategoryById($currentCategoryID)
    {
        $query = "DELETE FROM $this->tableName WHERE id=?";
        $statement = ConnectionHandler::getConnection()->prepare($query);
        if (false === $statement) {
            throw new Exception(ConnectionHandler::getConnection()->error);
        }
        $rc = $statement->bind_param('i', $currentCategoryID);
        if (false === $rc) {
            throw new Exception($statement->error);
        }
        $statement->execute();
    }
}
