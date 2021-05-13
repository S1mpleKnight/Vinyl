<?php
$filename = isset($_POST['full_filename']) ? $_POST['full_filename'] : "";

if (file_exists($filename)) {
    if (unlink($filename))
        echo "Success!";
        echo '<br><a href="delete.html" style="text-decoration: none">Вернуться</a>';
} else {
    exit("Неверный путь к файлу");
}