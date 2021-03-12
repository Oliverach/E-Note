<?php

namespace App\Repository;

use App\Database\ConnectionHandler;
use Exception;


class UserRepository extends Repository
{
    protected $tableName = "user";

    public function createUser($username, $password, $confirm_password)
    {
        $query = "INSERT INTO user(username, password) VALUES (?,?)";
        $statement = ConnectionHandler::getConnection()->prepare($query);
        if (false === $statement) {
            throw new Exception(ConnectionHandler::getConnection()->error);
        }
        $rc = $statement->bind_param('ss', $username, $password);
        if (false === $rc) {
            throw new Exception($statement->error);
        }

        $query2 = "SELECT username FROM $this->tableName WHERE username = ?";
        $statement2 = ConnectionHandler::getConnection()->prepare($query2);
        if (false === $statement2) {
            throw new Exception(ConnectionHandler::getConnection()->error);
        }
        $rs = $statement2->bind_param('s', $username);
        if (false === $rs) {
            throw new Exception($statement2->error);
        }
        $statement2->execute();
        $result = $statement2->get_result();

        if ($password == $confirm_password && $result->num_rows == 0) {
            $statement->execute();
        } else if ($result->num_rows != 0) {
            echo "user already exists";
        } else {
            echo "passwords do not match";
        }
    }


    public function loginUser($username, $password)
    {
        // Query erstellen
        $query = "SELECT * FROM $this->tableName WHERE username =? and password=?";

        // Datenbankverbindung anfordern und, das Query "preparen" (vorbereiten)
        // und die Parameter "binden"
        $connection = ConnectionHandler::getConnection();
        $statement = $connection->prepare($query);
        if ($statement == false) {
            throw new Exception($connection->error);
        }
        $statement->bind_param('ss', $username, $password);

        // Das Statement absetzen
        $statement->execute();

        // Resultat der Abfrage holen
        $result = $statement->get_result();
        if (!$result) {
            throw new Exception($statement->error);
        }
        if ($result->num_rows > 0){
            $row = $result->fetch_object();
            return $row->id;
        }
    }
}
