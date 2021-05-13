<?php

define('SQL_INSERT_EMAIL', "INSERT INTO users_emails (email) value ");
define('SQL_FIND_ALL', "SELECT id, email FROM users_emails");
define('EMAIL_REGEXP', "/^(?:[a-zA-Z0-9]+(?:[-_.]?[a-zA-Z0-9]+)?@[a-zA-Z0-9_.-]+(?:\.?[a-zA-Z0-9]+)?\.[a-zA-Z]{2,5})$/i");
define('HOSTNAME', "localhost");
define('USERNAME', "root");
define('PASSWORD', 'mysqlpassword');
define('DATABASE_NAME', "lab_5");
define('DATABASE_PORT', "3306");

$link = mysqli_connect(HOSTNAME, USERNAME, PASSWORD, DATABASE_NAME, DATABASE_PORT);
if ($link == false)
{
    die("Ошибка: Невозможно подключиться к MySQL ");
}

if (isset($_POST['email']))
{
    if (!is_email_correct($_POST['email']))
    {
        die("Ошибка: некорректный адрес электронной почты");
    }
    $email = $_POST['email'];
    $users_emails = mysqli_query($link, SQL_FIND_ALL);
    if (!is_database_contain_email($email, $users_emails))
    {
        write_email_to_database($email, $link);
    }
    else {
        echo "Электронная почта: $email - уже содержится в базе данных";
    }
} else {
    die("Ошибка: post запрос не существует");
}
mysqli_close($link);

function is_email_correct($email): bool
{
    return preg_match(EMAIL_REGEXP, $email);
}

function is_database_contain_email($email, $all_database_record): bool
{
    while ($row = mysqli_fetch_row($all_database_record)) {
        if ($row[1] == $email)
        {
            return true;
        }
    }
    return false;
}

function write_email_to_database($email, $link)
{
    mysqli_query($link, (SQL_INSERT_EMAIL . '(\'' . $email . '\')'));
    echo "Адрес электронной почты успешно добавлен в базу данных";
}

