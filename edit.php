<?php require_once($_SERVER["DOCUMENT_ROOT"] . "/template/header.php");
$id = intval($_GET['id']);
$oldTask = $task->getTask($id);

?>
<form action="index.php" method="POST" id="edit_form">
    <input type="hidden" name="task_id" value="<?= $id ?>">
    <tr>
        <td>Название задачи:</td>
        <td><input type="text" name="name" id="name" required value="<?= $oldTask['task_name'] ?>"></td>
    </tr>

    <tr>
        <td>Крайний срок:</td>
        <td><input type="date" name="deadline" id="deadline" required value="<?= $oldTask['deadline'] ?>"></td>
    </tr>
    <tr>
        <td></td>
        <td><input type="submit" value="Сохранить"></td>
    </tr>
    <tr>
        <td></td>
        <td><input type="hidden" id="save" name="save" value="true"></td>
    </tr>
</form>

<?php require_once($_SERVER["DOCUMENT_ROOT"] . "/template/footer.php"); ?>
