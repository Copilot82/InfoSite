<?php
session_start(); // Начало сессии
require 'config.php'; // Подключение к базе данных

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Получение данных из формы
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Проверка корректности введенных данных
    if (empty($email) || empty($password)) {
        echo "Пожалуйста, заполните все поля.";
    } else {
        // Подготовленный запрос для выборки пользователя
        $stmt = $conn->prepare("SELECT id, username, password, status FROM users WHERE email=?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            // Пользователь найден
            $user = $result->fetch_assoc();

            // Проверка статуса подтверждения
            if ($user['status'] != 'подтвержденный') {
                echo "Пожалуйста, подтвердите ваш email перед входом.";
            } else {
                // Проверка пароля
                if (password_verify($password, $user['password'])) {
                    // Пароль верный, устанавливаем сессию
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['username'] = $user['username'];
                    $_SESSION['logged_in'] = true;

                    // Перенаправление на защищенную страницу
                    header("Location: dashboard.php");
                    exit();
                } else {
                    echo "Неверный пароль.";
                }
            }
        } else {
            echo "Пользователь с таким email не найден.";
        }
    }
} else {
    echo "Некорректный запрос.";
}
?>