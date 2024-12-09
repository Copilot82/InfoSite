<?php
session_start();

// Проверяем, авторизован ли пользователь
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    // Возвращаем пустой список, если пользователь не авторизован
    echo json_encode(['notifications' => []]);
    exit();
}

// Подключаемся к базе данных
include('db_connect.php');

// Получаем ID пользователя из сессии
$user_id = $_SESSION['user_id'];

// Запрос для получения уведомлений, теперь включая поле created_at
$sql = "SELECT id, short_message, is_read, created_at FROM notifications WHERE user_id = ? ORDER BY created_at DESC LIMIT 10";
if ($stmt = $mysqli->prepare($sql)) {
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $notifications = [];
    while ($row = $result->fetch_assoc()) {
        // Форматируем дату и время (при необходимости)
        $created_at = date('d.m.Y H:i', strtotime($row['created_at']));
        // или, если хотите передать в исходном формате:
        // $created_at = $row['created_at'];

        $notifications[] = [
            'id' => $row['id'],
            'short_message' => $row['short_message'],
            'is_read' => $row['is_read'],
            'created_at' => $created_at
        ];
    }

    $stmt->close();

    // Возвращаем список уведомлений в формате JSON
    echo json_encode(['notifications' => $notifications]);
} else {
    // В случае ошибки возвращаем пустой список
    echo json_encode(['notifications' => []]);
}
?>