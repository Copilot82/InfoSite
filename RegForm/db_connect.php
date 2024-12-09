<?php
// Параметры подключения к базе данных
$host = 'localhost';     // Обычно это 'localhost'
$db_user = 'root';       // Ваше имя пользователя БД
$db_password = '';       // Ваш пароль от БД
$db_name = 'my_website';  // Имя вашей базы данных

// Создаем подключение
$mysqli = new mysqli($host, $db_user, $db_password, $db_name);

// Проверяем подключение
if ($mysqli->connect_error) {
    die('Ошибка подключения (' . $mysqli->connect_errno . ') '
        . $mysqli->connect_error);
}

// Устанавливаем кодировку UTF-8
$mysqli->set_charset("utf8");
?>