<?php

namespace App\Repository;

use App\Database\ConnectionHandler;
use Exception;


class UserRepository extends Repository
{
    protected $tableName = "user";

    public function createUser($username, $password, $confirm_password)
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
        $result = $statement->get_result();
        if ($password == $confirm_password && $result->num_rows == 0) {
            $this->registerUser($username, $password);
            header('Location: /user/login');
        } else if ($result->num_rows != 0) {
            $_SESSION['warning'] = "Username Unavailable";
            header('Location: /user/create');
            exit();
        } else {
            $_SESSION['warning'] = "Passwords do no match";
            header('Location: /user/create');
            exit();}
    }

    public function loginUser($username, $password)
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
        if ($result->num_rows > 0){
            $row = $result->fetch_object();
            return $row;
        }
    }

    public function registerUser($username, $password){
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
}
