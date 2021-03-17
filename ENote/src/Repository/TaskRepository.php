<?php

namespace App\Repository;

use App\Database\ConnectionHandler;
use Exception;


class TaskRepository extends Repository
{
    protected $tableName = "task";

    public function addTask($description, $date, $categoryID)
    {
        $query = "INSERT INTO task(description, dueDate, completed, category_id)VALUES (?,?,?,?)";
        $connection = ConnectionHandler::getConnection();
        $statement = $connection->prepare($query);
        if ($statement == false) {
            throw new Exception($connection->error);
        }
        $statement->bind_param('ssii', $description, $date,0,$categoryID);

        // Das Statement absetzen
        $statement->execute();

        // Resultat der Abfrage holen
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
