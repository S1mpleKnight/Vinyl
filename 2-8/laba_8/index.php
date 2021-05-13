<?php

define('SQL_INSERT_IP', "INSERT INTO users (IP, times) value ");
define('SQL_UPDATE_IP', "UPDATE users SET times = ");
define('SQL_FIND_ALL', "SELECT * FROM users");
define('HOSTNAME', "localhost");
define('USERNAME', "root");
define('PASSWORD', 'mysqlpassword');
define('DATABASE_NAME', "lab_8");
define('DATABASE_PORT', "3306");

$link = mysqli_connect(HOSTNAME, USERNAME, PASSWORD, DATABASE_NAME, DATABASE_PORT);
if ($link == false) {
    die("Ошибка: Невозможно подключиться к MySQL ");
}

$users = mysqli_query($link, SQL_FIND_ALL);
if (mysqli_num_rows($users) == 0) {
    echo '<p>Таблица адрессов пуста</p>';
} else {
    init_table();
    $table = array();
    while ($row = mysqli_fetch_row($users)) {
        $table[$row[1]] = $row[2];
    }
    arsort($table);
    foreach ($table as $key => $value) {
        echo "<tr><td style='text-align: center;'>$key</td>
                <td style='text-align: center'>$value</td>";
    }
}

$users = mysqli_query($link, SQL_FIND_ALL);
$addr = $_SERVER['REMOTE_ADDR'];
$count = is_database_contain_ip($addr, $users);
if ($count != null) {
    update_ip_in_database($addr, $link, $count);
} else {
    write_ip_to_database($addr, $link);
}

mysqli_close($link);

function is_database_contain_ip($ip, $all_database_record): ?int{
    while ($row = mysqli_fetch_row($all_database_record)) {
        if ($row[1] == $ip) {
            return $row[2];
        }
    }
    return null;
}

function write_ip_to_database($ip, $link){
    mysqli_query($link, (SQL_INSERT_IP . '(\'' . $ip . '\',' . 1 . ')'));
}

function update_ip_in_database($ip, $link, $count){
    $count = $count + 1;
    mysqli_query($link, (SQL_UPDATE_IP . "$count" . " WHERE IP=" . '\'' . $ip . '\''));
}

function init_table(){
    echo "<table border='1' style='margin-top: 10px'>";
    echo "<tr>
            <th>IP</th>
            <th>Количество посещений</th>
          </tr>";
}

