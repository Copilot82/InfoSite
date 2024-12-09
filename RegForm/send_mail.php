<?php
require 'vendor/autoload.php'; // Автозагрузка Composer
require 'config.php'; // Подключение к базе данных

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Получение данных из формы и их обработка
$username = mysqli_real_escape_string($conn, $_POST['username']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$password = $_POST['password'];

// Проверка существования пользователя
$sql = "SELECT id FROM users WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo "Пользователь с таким email уже зарегистрирован.";
} else {
    // Хеширование пароля
    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    // Генерация токена
    $token = bin2hex(random_bytes(16));

    // Время истечения токена (1 день)
    $expires = date('Y-m-d H:i:s', strtotime('+1 day'));

    // Сохранение пользователя в базе данных
    $sql = "INSERT INTO users (username, email, password, token, token_expires, status) VALUES (?, ?, ?, ?, ?, 'неподтвержденный')";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $username, $email, $password_hash, $token, $expires);
    if ($stmt->execute()) {
        // Отправка письма
        $mail = new PHPMailer(true);

        try {
            // Настройки сервера
            $mail->isSMTP();
            $mail->Host       = 'smtp.mail.ru';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'artemlaptev05@mail.ru'; // Замените на ваш email Mail.ru
            $mail->Password   = 'x2bLB2TLF2RnUywj6z5H'; // Замените на ваш пароль или пароль приложения
            $mail->SMTPSecure = 'ssl';
            $mail->Port       = 465;

            $mail->CharSet = 'UTF-8';

            // Адрес отправителя (должен совпадать с Username)
            $mail->setFrom('artemlaptev05@mail.ru', 'InfoSite');

            // Получатель
            $mail->addAddress($email, $username);

            // Содержание
            $mail->isHTML(true);
            $mail->Subject = 'Подтверждение регистрации';
            $mail->Body    = 'Здравствуйте, ' . htmlspecialchars($username) . '!<br><br>Пожалуйста, подтвердите регистрацию, перейдя по ссылке:<br><a href="http://188.32.166.139/InfoSite/RegForm/verify.php?email=' . urlencode($email) . '&token=' . $token . '">Подтвердить email</a>';

            $mail->send();
            echo 'Для завершения регистрации проверьте вашу электронную почту.';
        } catch (Exception $e) {
            echo "Письмо не может быть отправлено. Ошибка: {$mail->ErrorInfo}";
        }
    } else {
        echo "Ошибка при сохранении данных: " . $stmt->error;
    }
}

$conn->close();
?>