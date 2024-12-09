<?php
require 'config.php'; // Подключение к базе данных

if (isset($_GET['email']) && isset($_GET['token'])) {
    // Получаем параметры
    $email = $_GET['email'];
    $token = $_GET['token'];

    // Подготовленный запрос SELECT
    $stmt = $conn->prepare("SELECT id, username FROM users WHERE email = ? AND token = ? AND status = 'неподтвержденный'");
    $stmt->bind_param("ss", $email, $token);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $new_user_id = $row['id'];
        $username = $row['username'];
        $stmt->close();

        // Подготовленный запрос UPDATE
        $update_stmt = $conn->prepare("UPDATE users SET status='подтвержденный', token='' WHERE email = ?");
        $update_stmt->bind_param("s", $email);
        if ($update_stmt->execute()) {
            echo "Ваш email успешно подтвержден! Теперь вы можете войти на сайт.";

            // Создание уведомления
            $short_message = "Регистрация";
            $full_message = "Поздравляем вас с успешной регистрацией на нашем сайте, $username";

            // Подготовленный запрос INSERT для уведомления
            $insert_notification = $conn->prepare("INSERT INTO notifications (user_id, short_message, full_message) VALUES (?, ?, ?)");
            $insert_notification->bind_param("iss", $new_user_id, $short_message, $full_message);
            $insert_notification->execute();
            $insert_notification->close();

            // Перенаправление на страницу входа
             header("Location: login.php");
             exit();
        } else {
            echo "Ошибка при обновлении статуса: " . $update_stmt->error;
        }
        $update_stmt->close();
    } else {
        echo "Неверная ссылка или пользователь уже подтвержден.";
    }
} else {
    echo "Недопустимый запрос.";
}

$conn->close();
?>