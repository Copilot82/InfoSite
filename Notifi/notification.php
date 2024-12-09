<?php
session_start();

// Проверяем, авторизован ли пользователь
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: login.php');
    exit();
}

// Подключаемся к базе данных
include('../RegForm/db_connect.php');

// Получаем ID уведомления из GET-параметров
$notification_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Получаем ID пользователя из сессии
$user_id = $_SESSION['user_id'];

// Обновляем статус уведомления на "прочитано"
$sql = "UPDATE notifications SET is_read = 1 WHERE id = ? AND user_id = ?";
if ($stmt = $mysqli->prepare($sql)) {
    $stmt->bind_param("ii", $notification_id, $user_id);
    $stmt->execute();
    $stmt->close();
}

// Получаем полное сообщение уведомления
$sql = "SELECT full_message FROM notifications WHERE id = ? AND user_id = ?";
if ($stmt = $mysqli->prepare($sql)) {
    $stmt->bind_param("ii", $notification_id, $user_id);
    $stmt->execute();
    $stmt->bind_result($full_message);
    if ($stmt->fetch()) {
        // Успешно получили сообщение
    } else {
        // Уведомление не найдено или не принадлежит пользователю
        $full_message = "Уведомление не найдено.";
    }
    $stmt->close();
} else {
    // Обработка ошибки
    $full_message = "Не удалось загрузить уведомление.";
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Уведомление</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Уведомление</h1>
    <p><?php echo htmlspecialchars($full_message); ?></p>
    <a href="../RegForm/dashboard.php">Вернуться в личный кабинет</a>
</body>
</html>