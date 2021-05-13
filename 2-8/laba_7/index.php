<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html">
    <title>Lab_7</title>
</head>
<body>
    <form method="post">
        <label for="form__subject">
            Subject:
            <input type="text" name="subject" id="form__subject" placeholder="Theme" required>
        </label><br>
        <label for="form__message">
            Message:<br>
            <textarea id="form__message" name="message" cols="70" rows="20" placeholder="Your message" required></textarea>
        </label><br>
        <div>
            <input name="submit" type="submit" value="Отправить">
        </div>
    </form>
</body>
</html>

<?php
define("SQL_FIND_ALL", "SELECT * FROM emails");
define("PASSWORD", "mysqlpassword");
define("USERNAME", "root");
define("DATABASE_NAME", "lab_7");
define("DATABASE_PORT", "3306");
define("HOSTNAME", "localhost");

if (isset($_POST["submit"])){
    $subject = $_POST["subject"];
    $message = $_POST["message"];
} else {
    exit("Данные для отправки отсутствуют");
}

$link = mysqli_connect(HOSTNAME, USERNAME, PASSWORD, DATABASE_NAME, DATABASE_PORT);

if ($link == false){
    exit("Ошибка приподключении к базе данных");
}

$emails_list = mysqli_query($link, SQL_FIND_ALL);

if ($emails_list == false){
    exit("Не удалось получить данные из базы");
} else {
    $message = wordwrap($message, 70, "\r\n");
    while ($row = mysqli_fetch_row($emails_list)){
        $headers = 'From: Vanya <s1mpleknight@mail.ru>' . "\r\n"
            . 'Content-type: text/html; charset=utf-8'. "\r\n"
            . 'Reply-To: Vanya <s1mpleknight@mail.ru>' . "\r\n"
            . 'X-Mailer: PHP/'
            . phpversion();
        $result = mail($row[1], $subject, $message, $headers);
        if ($result == false){
            echo 'Ошибка при отправке<br>';
        } else {
            echo 'Письмо отправлено<br>';
        }
    }
}

mysqli_close($link);

