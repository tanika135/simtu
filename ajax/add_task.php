<?php

require_once($_SERVER["DOCUMENT_ROOT"] . "/tasks.php");

$task = new Tasks();

if ($_POST["submit"]) {
    $task->addTask();
}
?>
<tbody>
<?php $task->printTasks(); ?>
</tbody>