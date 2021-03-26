<?php

namespace App\Repository;

use App\Database\ConnectionHandler;
use Exception;


class CategoryRepository extends Repository
{
    protected $tableName = "category";

    public function addCategory( $name, $user_id, $color)
    {
        $this->checkCategoryAvailability($name, $user_id);
        $query = "INSERT INTO $this->tableName(name, user_id, color) VALUES (?,?,?) ";
        $statement = ConnectionHandler::getConnection()->prepare($query);
        if (false === $statement) {
            throw new Exception(ConnectionHandler::getConnection()->error);
        }
        $rc = $statement->bind_param('sis', $name,$user_id,$color);
        if (false === $rc) {
            throw new Exception($statement->error);
        }
        $statement->execute();
    }

    public function checkCategoryAvailability($categoryName,$user_id){
        $query = "SELECT name FROM $this->tableName where name =? AND user_id =?";
        $statement = ConnectionHandler::getConnection()->prepare($query);
        if (false === $statement) {
            throw new Exception(ConnectionHandler::getConnection()->error);
        }
        $rc = $statement->bind_param('si', $categoryName,$user_id);
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
            header('Location: /category/create');
            exit();
        }
    }

    public function getCategoriesByUserID($user_id){
        $query = "SELECT name, color, id FROM $this->tableName where user_id =?";
        $statement = ConnectionHandler::getConnection()->prepare($query);
        if (false === $statement) {
            throw new Exception(ConnectionHandler::getConnection()->error);
        }
        $rc = $statement->bind_param('i', $user_id);
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

    public function getTaskAmountByCategory($user_id){
        $wantedStatus = 0;
        $query = "SELECT  category.name,category.color,category.id as category_id, COUNT(task.id) as amount FROM $this->tableName LEFT JOIN task ON category.id = task.category_id AND task.status = ? WHERE category.user_id = ? GROUP BY category.name";
        $statement = ConnectionHandler::getConnection()->prepare($query);
        if (false === $statement) {
            throw new Exception(ConnectionHandler::getConnection()->error);
        }
        $rc = $statement->bind_param('ii', $wantedStatus, $user_id);
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

    public function getCurrentCategoryByID($category_id){

        $query = "SELECT id, name, color FROM $this->tableName WHERE id =? AND user_id =?;";
        $statement = ConnectionHandler::getConnection()->prepare($query);
        if (false === $statement) {
            throw new Exception(ConnectionHandler::getConnection()->error);
        }
        $rc = $statement->bind_param('ii', $category_id, $_SESSION['user']->id);
        if (false === $rc) {
            throw new Exception($statement->error);
        }
        $statement->execute();
        $result = $statement->get_result();
        if (!$result) {
            throw new Exception($statement->error);
        }
        if ($result->num_rows > 0){
            $row = $result->fetch_object();
            return $row;
        }
    }

    public function deleteCategoryById($currentCategory_id)
    {
        $query = "DELETE FROM $this->tableName WHERE id=? AND user_id=?";
        $statement = ConnectionHandler::getConnection()->prepare($query);
        if (false === $statement) {
            throw new Exception(ConnectionHandler::getConnection()->error);
        }
        $rc = $statement->bind_param('ii', $currentCategory_id, $_SESSION['user']->id);
        if (false === $rc) {
            throw new Exception($statement->error);
        }
        $statement->execute();
    }

    public function checkIfCategoryExists($category_id)
    {
        $query = "SELECT id FROM $this->tableName WHERE id =? AND user_id =?";
        $statement = ConnectionHandler::getConnection()->prepare($query);
        if (false === $statement) {
            throw new Exception(ConnectionHandler::getConnection()->error);
        }
        $rc = $statement->bind_param('ii', $category_id, $_SESSION['user']->id);
        if (false === $rc) {
            throw new Exception($statement->error);
        }
        $statement->execute();
        $result = $statement->get_result();
        if (!$result) {
            throw new Exception($statement->error);
        }
        if ($result->num_rows > 0){
            $row = $result->fetch_object();
            return $row;
        }
    }
}
