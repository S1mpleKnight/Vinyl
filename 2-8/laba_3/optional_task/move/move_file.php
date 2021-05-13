<?php

$filename = isset($_POST['full_filename']) ? $_POST['full_filename'] : "";
$dir = isset($_POST['new_directory']) ? $_POST['new_directory'] : "";

if (file_exists($filename) && is_dir($dir)) {
    if (rename($filename, $dir.pathinfo($filename, PATHINFO_BASENAME))) {
        echo "Success!";
        echo '<br><a href="move.html" style="text-decoration: none">Вернуться</a>';
    }
} else if (!file_exists($filename)) {
    exit("Файл по пути не найден");
} else {
    exit("Неверный путь к директории");
}