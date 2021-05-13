<?php


$dir = isset($_POST['dir']) ? $_POST['dir'] : "";
if (is_dir($dir) && ($_FILES['file']['error'] == 0)) {
    $save_path = "$dir/" . $_FILES['file']['name'];
    if (move_uploaded_file($_FILES['file']['tmp_name'], $save_path)) {
        echo "<p>Success!</p><br>";
        if (strpos($_FILES['file']['type'], 'text') === 0) {
            open_text_file($save_path);
        } elseif (strpos($_FILES['file']['type'], 'image') === 0) {
            open_image_file($save_path);
        }
    }
} elseif (!is_dir($dir)) {
    exit("Неверный путь к директории");
} else {
    exit("Ошибка при загрузке");
}

function open_text_file($save_path)
{
    $file = fopen($save_path, "r");
    $contents = fread($file, 30);
    fclose($file);
    echo $contents;
}

function open_image_file($save_path)
{
    copy($save_path, "." . "\\" . pathinfo($save_path, PATHINFO_BASENAME));
    echo "<img src=\"" . pathinfo($save_path, PATHINFO_BASENAME) . "\">";
}
?>