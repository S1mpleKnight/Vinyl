<?php

if (isset($_POST['input_dir'])) {
    $dir = $_POST['input_dir'];
    if (is_dir($dir)) {
        init_table();
        $files_size = scanning($_POST['input_dir']);
        close_table($files_size);
        echo '<br><a href="index.php" style="text-decoration: none">Вернуться<a/>';
    } else {
        echo 'Error: ' . $dir . ' - is not exist';
        echo '<br><a href="index.php" style="text-decoration: none">Вернуться<a/>';
    }
}

function init_table()
{
    echo '<table border="1">';
    echo '<tr><th>№</th><th>ФАЙЛ</th></tr>';
}

function close_table($files_size)
{
    echo '<tr><td>Итого</td>';
    get_size($files_size);
    echo '</table>';
}

function get_size($files_size)
{
    if ($files_size > 10000000) {
        echo '<td style="text-align: center">' . ($files_size / (1024 * 1024)) . 'МБ</td></tr>';
    } else {
        echo '<td style="text-align: center">' . $files_size . 'Б</td></tr>';
    }
}

function scanning($dir): int
{
    static $iteration = 1;
    $files_size = 0;
    $files = scandir($dir);

    unset($files[array_search('.', $files, true)]);
    unset($files[array_search('..', $files, true)]);

    foreach ($files as $internal_file) {
        if (is_dir($dir . '/' . $internal_file)) {
            $files_size += scanning($dir . '/' . $internal_file);
        } else {
            echo '<tr><td style="text-align: center;">' . $iteration++ . '</td>';
            echo '<td style="text-align: center">' . $internal_file . '</td></tr>';
            $files_size += filesize($dir . '/' . $internal_file);
        }
    }
    return $files_size;
}

