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
        $query = "INSERT INTO task(description, dueDate, status, category_id, user_id)VALUES (?,?,?,?,?)";
        $connection = ConnectionHandler::getConnection();
        $statement = $connection->prepare($query);
        if ($statement == false) {
            throw new Exception($connection->error);
        }
        $statement->bind_param('ssiii', $description, $date,$defaultStatus,$categoryID,$_SESSION['userID']);
        // Das Statement absetzen
        $statement->execute();
    }
}
