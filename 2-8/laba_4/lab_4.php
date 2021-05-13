<?php
const date_regex_dmy = '/([\d]{1,2}[.][\d]{1,2}[.])([\d]{4}|[\d]{2})/u';
const date_regex_mdy = '/([\d]{1,2}[\/][\d]{1,2}[\/])([\d]{4}|[\d]{2})/u';

function format_translation($text)
{
    $text = preg_replace("/([\d]{1,2})[\/]([\d]{1,2})[\/]([\d]{4}|[\d]{2})/u", "\\2.\\1.\\3", $text);
    return $text;
}

function next_year($matches): string
{
    return $matches[1] . ($matches[2] + 1);
}

function replace_year($text)
{
    $text = preg_replace_callback(date_regex_dmy, "next_year", $text);
    $text = preg_replace_callback(date_regex_mdy, "next_year", $text);
    return $text;
}

function paint_text($text)
{
    $text = preg_replace(date_regex_dmy, "<span style='color: red'>$0</span>", $text);
    $text = preg_replace(date_regex_mdy, "<span style='color: red'>$0</span>", $text);
    return $text;
}

if (isset($_POST['input_file'])) {
    $file = $_POST['input_file'];
    if (is_file($file)) {
        $text = htmlentities(file_get_contents($file));
        echo "Исходный текст: " . $text . "<br>";

        $text = replace_year($text);
        $text = format_translation($text);

        echo "ИТОГ: " . paint_text($text);
    } else{
        echo "$file - is not a file";
    }
}