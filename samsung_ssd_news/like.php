<?php
session_start();
include('../RegForm/db_connect.php');

// Проверяем, что переменная $mysqli определена
if (!isset($mysqli)) {
    die("Переменная \$mysqli не определена после подключения db_connect.php");
}

// Проверяем, авторизован ли пользователь
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    echo 'not_logged_in';
    exit();
}

$user_id = $_SESSION['user_id'];
$news_id = $_POST['news_id'];

// Проверяем, что news_id не пусто
if (empty($news_id)) {
    echo 'error';
    exit();
}

// Используем подготовленные выражения
$stmt = $mysqli->prepare("SELECT * FROM likes WHERE user_id = ? AND news_id = ?");
$stmt->bind_param("is", $user_id, $news_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Удаляем лайк
    $stmt = $mysqli->prepare("DELETE FROM likes WHERE user_id = ? AND news_id = ?");
    $stmt->bind_param("is", $user_id, $news_id);
    $stmt->execute();
    echo 'unliked';
} else {
    // Добавляем лайк
    $stmt = $mysqli->prepare("INSERT INTO likes (user_id, news_id) VALUES (?, ?)");
    $stmt->bind_param("is", $user_id, $news_id);
    $stmt->execute();
    echo 'liked';
}
?>