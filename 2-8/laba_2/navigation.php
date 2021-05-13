<?php
$company = "<style> .company{background: yellow} </style>";
$services = "<style> .services{background: peachpuff} </style>";
$price = "<style> .price{background: orange} </style>";
$contacts = "<style> .contacts{background: rosybrown} </style>";
$logo = "<style> .logo{background: hotpink} </style>";
$array = "";

if (isset($_GET['company'])) {
    echo $company;
}
if (isset($_GET['services'])) {
    echo $services;
}
if (isset($_GET['price'])) {
    echo $price;
}
if (isset($_GET['contacts'])) {
    echo $contacts;
}

if (isset($_GET['logo'])) {
    echo $logo;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <link rel="stylesheet" href="navigation.css"/>
    <title>Lab_2</title>
</head>
<body>
<header>
    <div class="container">
        <nav>
            <div class="nav__inner">
                <div class="nav__logo">
                    <a href="?logo" class="logo">Vanya</a>
                </div>
                <div class="nav__menu">
                    <a href="?company" class="company">О компании</a>
                    <a href="?services" class="services">Услуги</a>
                    <a href="?price" class="price">Цены</a>
                    <a href="?contacts" class="contacts">Контакты</a>
                </div>
            </div>
        </nav>
    </div>
</header>
<main>
    <div class="main__input">
        <form name="main__form" method="post">
            <label for="array">
                Введите элементы массива через пробел:
                <input id="array" name="form__input" type="text">
            </label>
            <button type="submit">Отправить</button>
        </form>
    </div>
</main>

<?php
if (isset($_POST['form__input'])) {
    $array = explode(" ", htmlentities($_POST['form__input']));
    $tmp = [];

    foreach ($array as $item) {
        if (in_array($item, $tmp) || $item == "") {
            continue;
        } else {
            $tmp[] = $item;
            echo "Элемент: $item <br>";
        }
    }
}
?>

</body>
</html>