<?php

if (isset($_GET['name']))
{
    setcookie($_GET['name'], null, -1);
}

?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Lab_6</title>
        <style>
            input[type=text] {
                margin-bottom: 10px;
            }
        </style>
    </head>
    <body>
    <form method="post" name="main_form">
        <label for="cookie_name"> Имя куки:
            <input type="text" id="cookie_name" name="cookie_name" pattern="[^\s]+" placeholder="Введите имя куки"
                   required>
        </label><br>
        <label for="cookie_value"> Значение куки:
            <input type="text" id="cookie_value" name="cookie_value" placeholder="Введите значение для куки" required>
        </label><br>
        <label for="cookie_life_time"> Время жизни куки(сек):
            <input type="text" id="cookie_life_time" name="cookie_life_time" pattern="[0-9]+"
                   placeholder="Введите время жизни" required>
        </label><br>
        <input type="submit" name="submit" id="submit" name="button_submit" value="Отправить">
    </form>
    </body>
    </html>

<?php

function init_table()
{
    echo "<table border='1' style='margin-top: 10px'>";
    echo "<tr>
            <th>Название куки</th>
            <th>Значение</th>
            <th>Удаление</th>
          </tr>";
}

if (isset($_POST['submit']))
{
    include('cookie.php');
    header("Refresh: 0");
}

if (count($_COOKIE) == 0)
{
    echo "<br>Список cookie в настоящее время пуст!" . "<br><br>";
} else {
    init_table();
    foreach ($_COOKIE as $key => $value) {
        echo "<tr><td style='text-align: center;'>$key</td>
                <td style='text-align: center'>$value</td>
                <td style='text-align: center'>
                    <a href='index.php?name=$key'>Удалить</a>
                </td>";
    }
}