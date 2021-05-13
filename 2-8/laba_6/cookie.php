<?php

if (isset($_POST['cookie_name']) && isset($_POST['cookie_value']) && isset($_POST['cookie_life_time'])) {
    setcookie($_POST['cookie_name'], $_POST['cookie_value'], time() + $_POST['cookie_life_time']);
}
