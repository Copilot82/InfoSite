<?php
session_start();
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Проверяем, авторизован ли пользователь
if (!isset($_SESSION['user_id'])) {
    echo "Вы должны войти в систему, чтобы отправить сообщение.";
    exit;
}




if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Получаем данные из формы и защищаем их
    $username = htmlspecialchars(trim($_POST['username']));
    $email_address = htmlspecialchars(trim($_POST['email_address']));
    $phone_number = htmlspecialchars(trim($_POST['phone_number']));
    $comment = htmlspecialchars(trim($_POST['comment']));

    // Проверяем заполнение полей
    if (empty($username) || empty($email_address) || empty($phone_number) || empty($comment)) {
        echo "Пожалуйста, заполните все поля.";
        exit;
    }

    // Проверяем корректность email
    if (!filter_var($email_address, FILTER_VALIDATE_EMAIL)) {
        echo "Некорректный email адрес.";
        exit;
    }

    // Настройка PHPMailer
    $mail = new PHPMailer(true);

    try {
        // Настройки сервера
        $mail->SMTPDebug = 0;                      // Установите 0 для отключения отладки, 2 для вывода отладочной информации
        $mail->isSMTP();
        $mail->Host = 'smtp.mail.ru';            // SMTP сервер вашего почтового провайдера
        $mail->SMTPAuth = true;
        $mail->Username = 'artemlaptev05@mail.ru';  // Ваш email
        $mail->Password = 'u12w8JgZR89yRDu7WQgz';     // Ваш пароль приложения
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // Шифрование (ssl)
        $mail->Port = 465;                         // Порт для ssl

        // От кого письмо
        $mail->setFrom('artemlaptev05@mail.ru', 'Ваше имя');

        // Кому отправить
        $mail->addAddress('artemlaptev@mirea.online', 'Получатель'); // Вы можете отправить письмо самому себе или на другой email

        // Ответить на
        $mail->addReplyTo($email_address, $username);

        // Контент письма
        $mail->isHTML(false);                      // Установите true, если хотите отправить письмо в формате HTML
        $mail->CharSet = 'UTF-8';
        $mail->Subject = "Новое сообщение с сайта от $username";
        $mail->Body    = "Вы получили новое сообщение с формы обратной связи вашего сайта.\n\n".
                         "Имя: $username\n".
                         "Email: $email_address\n".
                         "Телефон: $phone_number\n\n".
                         "Сообщение:\n$comment\n";

        $mail->send();
        echo "Спасибо! Ваше сообщение было отправлено.";
    } catch (Exception $e) {
        echo "Извините, произошла ошибка при отправке сообщения. Ошибка: {$mail->ErrorInfo}";
    }
} else {
    // Если файл был вызван напрямую, перенаправляем на форму
    header("Location: index.php");
    exit;
}
?>