<?php

namespace App\Repository;

use App\Database\ConnectionHandler;
use Exception;


class UserRepository
{
    protected $tableName = "user";

    public function checkUserExistance($username, $password)
    {
        $query = "SELECT * FROM $this->tableName WHERE username =? and password=?";
        $connection = ConnectionHandler::getConnection();
        $statement = $connection->prepare($query);
        if ($statement == false) {
            throw new Exception($connection->error);
        }
        $statement->bind_param('ss', $username, $password);
        $statement->execute();
        $result = $statement->get_result();
        if (!$result) {
            throw new Exception($statement->error);
        }
        if ($result->num_rows > 0) {
            $row = $result->fetch_object();
            return $row;
        }
    }

    public function registerUser($username, $password, $confirm_password)
    {
        $query = "INSERT INTO $this->tableName(username, password) VALUES (?,?)";
        $statement = ConnectionHandler::getConnection()->prepare($query);
        if (false === $statement) {
            throw new Exception(ConnectionHandler::getConnection()->error);
        }
        $rc = $statement->bind_param('ss', $username, $password);
        if (false === $rc) {
            throw new Exception($statement->error);
        }
        $statement->execute();
    }

    public function checkUserAvailability($username)
    {
        $query = "SELECT username FROM $this->tableName WHERE username = ?";
        $statement = ConnectionHandler::getConnection()->prepare($query);
        if (false === $statement) {
            throw new Exception(ConnectionHandler::getConnection()->error);
        }
        $rs = $statement->bind_param('s', $username);
        if (false === $rs) {
            throw new Exception($statement->error);
        }
        $statement->execute();
        return $result = $statement->get_result();
    }

    public function updateUserInfo($email)
    {
        $query = "UPDATE $this->tableName SET email =? WHERE username=?";
        $statement = ConnectionHandler::getConnection()->prepare($query);
        if (false === $statement) {
            throw new Exception(ConnectionHandler::getConnection()->error);
        }
        $rc = $statement->bind_param('ss', $email, $_SESSION['user']->username);
        if (false === $rc) {
            throw new Exception($statement->error);
        }
        $statement->execute();
    }

    public function checkEMailAvailability($email)
    {
        $query = "SELECT email FROM $this->tableName where email=?";
        $statement = ConnectionHandler::getConnection()->prepare($query);
        if (false === $statement) {
            throw new Exception(ConnectionHandler::getConnection()->error);
        }
        $rc = $statement->bind_param('s', $email);
        if (false === $rc) {
            throw new Exception($statement->error);
        }
        $statement->execute();
        $result = $statement->get_result();
        if (!$result) {
            throw new Exception($statement->error);
        }
        if ($result->num_rows > 0) {
            return false;
        } else {
            return true;
        }
    }

    public function changeUserPassword($newPW)
    {

        $query = "UPDATE $this->tableName SET password =? WHERE username=?";

        $statement = ConnectionHandler::getConnection()->prepare($query);
        if (false === $statement) {
            throw new Exception(ConnectionHandler::getConnection()->error);
        }
        $rc = $statement->bind_param('ss', $newPW, $_SESSION['user']->username);
        if (false === $rc) {
            throw new Exception($statement->error);
        }
        $statement->execute();

    }
}
