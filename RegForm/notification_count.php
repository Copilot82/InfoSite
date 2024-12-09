<?php
session_start();

// Проверяем, авторизован ли пользователь
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    // Возвращаем 0, если пользователь не авторизован
    echo json_encode(['unread_count' => 0]);
    exit();
}

// Подключаемся к базе данных
include('db_connect.php');

// Получаем ID пользователя из сессии
$user_id = $_SESSION['user_id'];

// Запрос для получения количества непрочитанных уведомлений
$sql = "SELECT COUNT(*) as unread_count FROM notifications WHERE user_id = ? AND is_read = 0";
if ($stmt = $mysqli->prepare($sql)) {
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $stmt->bind_result($unread_count);
    $stmt->fetch();
    $stmt->close();

    // Возвращаем количество в формате JSON
    echo json_encode(['unread_count' => $unread_count]);
} else {
    // В случае ошибки возвращаем 0
    echo json_encode(['unread_count' => 0]);
}
?>