<?php

class Tasks
{
    private $pdo;

    const ARCHIVED = 1;
    const NOT_ARCHIVED = 0;

    public function __construct()
    {
        try {
            $this->pdo = new \PDO(
                'mysql:host=localhost;dbname=test',
                'root',
                '',
                [\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION]);

            $this->createTable();
        } catch (\PDOException $e) {
            echo "Невозможно установить соединение с базой данных";
        }
    }

    public function createTable()
    {
        $query = "CREATE TABLE IF NOT EXISTS tasks (
            id INT(11) NOT NULL AUTO_INCREMENT,
            task_name TINYTEXT NOT NULL,
            deadline DATE NOT NULL,
            archived TINYINT NOT NULL,
            PRIMARY KEY (id))";

        $count = $this->pdo->exec($query);

        if ($count === false) {
            throw new Exception("Не удалось создать таблицу" . print_r($this->pdo->errorInfo(), true));
        }
    }

    public function addTask ()
    {
        if (empty($_POST["name"])) exit('Не заполнено поле "Название задачи"');
        if (empty($_POST["deadline"])) exit('Не заполнено поле "Крайний срок"');

        $query = "INSERT INTO tasks VALUES (
                                    NULL, 
                                    :name,
                                    :deadline,
                                    :archived)";
        $tasks = $this->pdo->prepare($query);
        $tasks->execute(
            [
                "name" => $_POST["name"],
                "deadline" => $_POST["deadline"],
                "archived" => self::NOT_ARCHIVED,
            ],
        );
    }

    public function getTask(int $taskId) : array
    {
        $query = "SELECT * FROM tasks WHERE id = :id limit 1";
        $task = $this->pdo->prepare($query);
        $task->execute([
            'id' => $taskId
        ]);

        $task = $task->fetch();

        return $task ? $task : [];
    }

    public function printTasks()
    {
        try {
            $query = "SELECT * FROM tasks";

            $task = $this->pdo->prepare($query);
            $task->execute();
            $tasks = $task->fetchAll();

        } catch (PDOException $e) {
            echo "Ошибка выполнения запроса: " . $e->getMessage();
        }

        foreach ($tasks as $task) {
            if ($task["archived"] == 1) {
                $archived = "Да";
            } else {
                $archived = "Нет";
            }
            $taskID = $task["id"];
            echo "<tr id='$taskID'>";
            echo(
                "<td>".$task["id"]."</td><td>".
                $task["task_name"]."</td><td>".
                $task["deadline"]."</td><td>".
                $archived."</td>");

            echo "<td><a href='/edit.php?id=". $task["id"] ."'>Редактировать</a></td>";
            echo "<td><a href='/archive.php?id=". $task["id"] ."'>Архивировать</a></td>";
            echo "</tr>";
        }
    }

    public function archive (int $taskId)
    {
        $query = "UPDATE tasks SET archived = :archived WHERE id = :id";

        $tasks = $this->pdo->prepare($query);
        $tasks->execute(
            [
                "id" => $taskId,
                "archived" => self::ARCHIVED,
            ],
        );
    }

    public function saveTask()
    {
        $query = "UPDATE tasks SET task_name = :name,  deadline = :deadline WHERE id = :id";

        $tasks = $this->pdo->prepare($query);
        $tasks->execute(
            [
                "id" => $_POST["task_id"],
                "name" => $_POST["name"],
                "deadline" => $_POST["deadline"]
            ],
        );
    }
}