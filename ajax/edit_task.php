<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/tasks.php");
$task = new Tasks();

if ($_POST["save"]) {
    $task->saveTask();
}