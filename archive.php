<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/tasks.php");
$task = new Tasks();

if ($_GET["id"]) {
    $task->archive(intval($_GET["id"]));
}

header('Location: /');