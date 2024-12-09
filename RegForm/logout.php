<?php
session_start();

// Очистка всех данных сессии
$_SESSION = [];

// Удаление cookie сессии
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"],
        $params["domain"],
        $params["secure"],
        $params["httponly"]
    );
}

// Уничтожение сессии
session_destroy();

// Перенаправление на страницу входа или главную страницу
header('Location: login.php');
exit();
?>