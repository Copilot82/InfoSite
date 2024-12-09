<?php
session_start();
include('db_connect.php');

// Проверяем, является ли пользователь администратором
if ($_SESSION['user_role'] != 'admin') {
    echo "Доступ запрещен.";
    exit();
}

if (isset($_POST['send_notification'])) {
    $user_id = $_POST['user_id']; // ID пользователя или 'all' для всех пользователей
    $short_message = $_POST['short_message'];
    $full_message = $_POST['full_message'];

    if ($user_id == 'all') {
        // Отправить всем пользователям
        $sql = "SELECT id FROM users";
        $result = $mysqli->query($sql);
        while ($row = $result->fetch_assoc()) {
            $insert_notification = "INSERT INTO notifications (user_id, short_message, full_message) VALUES (?, ?, ?)";
            $stmt = $mysqli->prepare($insert_notification);
            $stmt->bind_param("iss", $row['id'], $short_message, $full_message);
            $stmt->execute();
            $stmt->close();
        }
    } else {
        // Отправить конкретному пользователю
        $insert_notification = "INSERT INTO notifications (user_id, short_message, full_message) VALUES (?, ?, ?)";
        $stmt = $mysqli->prepare($insert_notification);
        $stmt->bind_param("iss", $user_id, $short_message, $full_message);
        $stmt->execute();
        $stmt->close();
    }

    echo "Уведомление отправлено.";
}
?>

<!-- Форма отправки уведомления -->
<form method="post" action="">
    <label for="user_id">Пользователь:</label>
    <select name="user_id" id="user_id">
        <option value="all">Все пользователи</option>
        <?php
        $sql = "SELECT id, username FROM users";
        $result = $mysqli->query($sql);
        while ($row = $result->fetch_assoc()) {
            echo '<option value="' . $row['id'] . '">' . htmlspecialchars($row['username']) . '</option>';
        }
        ?>
    </select>
    <br>
    <label for="short_message">Сокращённое уведомление:</label>
    <input type="text" name="short_message" id="short_message" required>
    <br>
    <label for="full_message">Полное уведомление:</label>
    <textarea name="full_message" id="full_message" required></textarea>
    <br>
    <button type="submit" name="send_notification">Отправить уведомление</button>
</form>