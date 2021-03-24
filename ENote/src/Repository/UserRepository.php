<?php

namespace App\Repository;

use App\Database\ConnectionHandler;
use App\Helper\SessionHelper;
use Exception;


class UserRepository extends Repository
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
        if ($result->num_rows > 0){
            $row = $result->fetch_object();
            return $row;
        }
    }

    public function registerUser($username, $password, $confirm_password){
        $result = $this->checkUserAvailability($username);
        if ($password == $confirm_password && $result->num_rows == 0){
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
            header('Location: /user/login');
            exit();
        }else if ($this->checkUserAvailability($username)->num_rows != 0){
            $_SESSION['warning'] = "User Already Exists";
            header('Location: /user/create');
            exit();
        }else{
            $_SESSION['warning'] = "Passwords do no match";
            header('Location: /user/create');
            exit();
        }
    }

    public function checkUserAvailability($username){
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

    public function updateUserInfo($email,$password){
        $user = $this->checkUserExistance($_SESSION['user']->username,$password);
        if ($user){
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
            $_SESSION['user'] = $this->checkUserExistance($_SESSION['user']->username, $_SESSION['user']->password);
            header('Location: /user/showProfile');
            exit();
        } else{
            $_SESSION['warning'] = "Password Incorrect";
            header('Location: /user/updateUserInfo');
            exit();
        }
    }

    public function changeUserPassword($newPW, $confirmNewPW, $currentPW)
    {
        if ($newPW == $currentPW){
            $_SESSION['warning'] = "Can not change to same password";
            header('Location: /user/changePassword');
            exit();
        }
        $user = $this->checkUserExistance($_SESSION['user']->username,$currentPW);
        if ($user && $confirmNewPW == $newPW){
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
            $_SESSION['user'] = $this->checkUserExistance($_SESSION['user']->username, $newPW);
            header('Location: /user/showProfile');
            exit();
        } else if($confirmNewPW == $newPW){
            $_SESSION['warning'] = "Passwords do not match";
            header('Location: /user/changePassword');
            exit();
        }else{
            $_SESSION['warning'] = "Password Incorrect";
            header('Location: /user/changePassword');
            exit();
        }

    }
}
