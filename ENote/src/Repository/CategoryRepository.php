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
        $query = "SELECT name, color, id FROM category where user_id =?";
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



}
