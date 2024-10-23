<?php

//todo - Добавление задач, и срока
//todo - Редактирование задач
//todo - Удаление задач в архив
//todo - Отображение текущих и архивных
//todo - Красиво оформить*
/**создать таблицу с полями: id, название задачи, срок, пометка о том, что задача в архиве.
 */
require_once($_SERVER["DOCUMENT_ROOT"] . '/tasks.php');

$task = new Tasks();

?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Добавление задач</title>
</head>
<body>
