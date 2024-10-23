<?php require_once($_SERVER["DOCUMENT_ROOT"] . "/template/header.php"); ?>

<link rel="stylesheet" href="styles.css">
<table class="table">
    <thead>
        <th>ID</th>
        <th>Название задачи</th>
        <th>Крайний срок</th>
        <th>Задача архивирована</th>
        <th></th>
        <th></th>
    </thead>
    <tbody>
    <?php
    $task->printTasks();
    ?>
    </tbody>
</table>

<table>
    <form action="index.php" method="POST" id="add_form">
        <input type="hidden" name="task_id" value="'.$taskId.'">
        <tr>
            <td>Название задачи:</td>
            <td><input type="text" name="name" id="name" required></td>
        </tr>
        <tr>
            <td>Крайний срок:</td>
            <td><input type="date" name="deadline" id="deadline" required></td>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" value="Добавить задачу"></td>
        </tr>
        <tr>
            <td></td>
            <td><input type="hidden" id="submit" name="submit" value="true"></td>
        </tr>
    </form>
</table>
<div id="results"></div>

<?php require_once($_SERVER["DOCUMENT_ROOT"] . "/template/footer.php"); ?>