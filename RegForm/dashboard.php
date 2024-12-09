<?php
session_start();

// Подключаемся к базе данных
include('db_connect.php');

// Проверяем, авторизован ли пользователь
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: login.php');
    exit();
}

// Получаем ID пользователя из сессии
$user_id = $_SESSION['user_id'];

// Получаем информацию о пользователе из базы данных
$sql = "SELECT username, email, status FROM users WHERE id = ?";
if ($stmt = $mysqli->prepare($sql)) {
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $stmt->bind_result($username, $email, $status);
    $stmt->fetch();
    $stmt->close();
} else {
    // Обработка ошибки
    echo "Ошибка базы данных.";
    exit();
}

// Обработка смены пароля
if (isset($_POST['change_password'])) {
    // Получаем данные из формы
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    // Проверяем, что новый пароль и подтверждение совпадают
    if ($new_password != $confirm_password) {
        $error_message = "Новый пароль и подтверждение не совпадают.";
    } else {
        // Получаем хеш пароля из базы данных
        $sql = "SELECT password FROM users WHERE id = ?";
        if ($stmt = $mysqli->prepare($sql)) {
            $stmt->bind_param("i", $user_id);
            $stmt->execute();
            $stmt->bind_result($hashed_password);
            $stmt->fetch();
            $stmt->close();

            // Проверяем текущий пароль
            if (password_verify($current_password, $hashed_password)) {
                // Хешируем новый пароль
                $new_hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

                // Обновляем пароль в базе данных
                $update_sql = "UPDATE users SET password = ? WHERE id = ?";
                if ($update_stmt = $mysqli->prepare($update_sql)) {
                    $update_stmt->bind_param("si", $new_hashed_password, $user_id);
                    if ($update_stmt->execute()) {
                        $success_message = "Пароль успешно обновлен.";
                    } else {
                        $error_message = "Ошибка при обновлении пароля.";
                    }
                    $update_stmt->close();
                } else {
                    $error_message = "Ошибка при подготовке запроса на обновление.";
                }

            } else {
                $error_message = "Текущий пароль неверен.";
            }
        } else {
            $error_message = "Ошибка базы данных при проверке пароля.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Личный кабинет</title>
    <link rel="stylesheet" href="style.css"> <!-- Ваш файл стилей -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Handjet:wght@100..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Barlow:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Host+Grotesk:ital,wght@0,300..800;1,300..800&family=Hubot+Sans:ital,wght@0,200..900;1,200..900&family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Nunito:ital,wght@0,200..1000;1,200..1000&family=Oswald:wght@200..700&family=Roboto+Mono:ital,wght@0,100..700;1,100..700&display=swap" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Современные твердотельные накопители</title>
    <link rel="icon" href="https://upload.wikimedia.org/wikipedia/commons/thumb/3/3c/Bang_icon_32x32.svg/1024px-Bang_icon_32x32.svg.png" type="image/x-icon">
    <link rel="stylesheet" href="style.css"> <!-- Подключение файла стилей -->
    <link rel="stylesheet" href="style2.css"> <!-- Подключение файла стилей -->
    <link rel="stylesheet" href="../styles/Up_content.css"> <!-- Подключение файла стилей -->
    <link rel="stylesheet" href="../styles/footer.css"> <!-- Подключение файла стилей -->
</head>
<body class="body_page2">

    <!-- Ваш header и навигация -->
    <header class="header2">
        <h1>Современные твердотельные накопители (SSD)</h1>
        <p>Введение <cite>SSD</cite> в вашу систему — это шаг к повышению производительности, надежности и удобству использования.</p>
    </header>
    <nav class="nav2">
        <div class="nav_block2">
            <ul class="nav-links2">
                <li><a href="../page1/Introduction to SSD.php">Введение в SSD</a></li>
                <li><a href="../page2/index.php">Руководство по SSD</a></li>
                <li><a href="../page3/index.php">Преимущества SSD</a></li>
                <li><a href="../page4/index.php">Выбор SSD</a></li>
                <li><a href="../samsung_ssd_news/index.php">Новости</a></li>
            </ul>
    
            <div class="icons-sites">
                <div class="icon_s1 notification-icon">
                    <a href="#">
                    <img src="../images/free-icon-notification-10419399.png" alt="уведомления" width="30px" class="img_nav"></a>
                    <!-- Индикатор количества непрочитанных уведомлений -->
                    <span class="notification-count" id="notification-count"></span>
                </div>
                    <!-- Контейнер для выпадающего списка уведомлений -->

                <div class="notification-dropdown" id="notification-dropdown">
                    <div class="notification-content">
                        <div class="notification-header">
                            <h2>Уведомления</h2>
                        </div>
                        <div class="notifications-list-container">
                            <ul id="notifications-list">
                                <!-- Уведомления будут загружены динамически -->
                            </ul>
                        </div>
                        <div class="notification-buttons">
                            <?php if (!isset($_SESSION['user_id'])): ?>
                                <a href="../RegForm/login.php" class="button">Войти</a>
                            <?php else: ?>
                                <a href="../RegForm/dashboard.php" class="button">Профиль</a>
                                <a href="../form/index.php" class="button">Обратная связь</a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                
                <?php if (isset($_SESSION['user_id'])): ?>
                    <!-- Пользователь авторизован -->
                    <div class="icon_s2">
                        <a href="../RegForm/dashboard.php">
                            <img src="../images/free-icon-user-6542999.png" width="75px" alt="Профиль">
                        </a>
                    </div>
                <?php else: ?>
                    <!-- Пользователь не авторизован -->
                    <div class="icon_s2">
                        <a href="../RegForm/login.php" class="icon_s2">
                            <img src="../images/free-icon-user-6542999.png" width="75px" alt="Войти">
                        </a>
                    </div>
                <?php endif; ?>
                <div class="icon_s3"><img src="../images/icons8-телеграм-48.png" width="40px" class="img_nav"></div>
            </div>
        </div>

        <div class="nav_block1">
            <img src="../images/menu.png" width="30px" class="menu-icon">
            <div class="nav1_text">
                <div class="nav_texts">
                    <a href="../page1/Introduction to SSD.php">Введение в SSD</a>
                    <a href="../page2/index.php">Руководство по SSD</a>
                    <a href="../page3/index.php">Преимущества SSD</a>
                    <a href="../page4/index.php">Выбор SSD</a>
                    <a href="../form/index.php">Форма обратной связи</a>
                </div>
                <div class="nav_icons">
                    <div class="icon_s1"><img src="../images/free-icon-notification-10419399.png" width="30px" class="img_nav"></div>
                    <?php if (isset($_SESSION['user_id'])): ?>
                        <!-- Пользователь авторизован -->
                        <div class="icon_s2">
                            <a href="../RegForm/dashboard.php">
                                <img src="../images/free-icon-user-6542999.png" width="50px" alt="Профиль">
                            </a>
                        </div>
                    <?php else: ?>
                        <!-- Пользователь не авторизован -->
                        <div class="icon_s2">
                            <a href="../RegForm/login.php" class="icon_s2">
                                <img src="../images/free-icon-user-6542999.png" width="50px" alt="Войти">
                            </a>
                        </div>
                    <?php endif; ?>
                    <div class="icon_s3"><img src="../images/icons8-телеграм-48.png" width="40px" class="img_nav"></div>
                </div>
            </div>
        </div>
    </nav>
    <?php if (isset($error_message)): ?>
        <div class="message error"><?php echo htmlspecialchars($error_message); ?></div>
    <?php endif; ?>

    <?php if (isset($success_message)): ?>
        <div class="message success"><?php echo htmlspecialchars($success_message); ?></div>
    <?php endif; ?>
    <main>
    <div class="profile-container">
        <h1>Добро пожаловать, <?php echo htmlspecialchars($username); ?>!</h1>

        <div class="user-info">
            <h2>Ваш профиль</h2>
            <p><strong>Имя пользователя:</strong> <?php echo htmlspecialchars($username); ?></p>
            <p><strong>Email:</strong> <?php echo htmlspecialchars($email); ?></p>
            <p><strong>Статус:</strong> <?php echo htmlspecialchars($status); ?></p>
        </div>

        <!-- Форма для смены пароля -->
        <div class="change-password">
            <h2>Сменить пароль</h2>
            <form method="post" action="">
                <div class="form-group">
                    <label for="current_password">Текущий пароль:</label>
                    <input type="password" name="current_password" id="current_password" required>
                </div>

                <div class="form-group">
                    <label for="new_password">Новый пароль:</label>
                    <input type="password" name="new_password" id="new_password" required>
                </div>

                <div class="form-group">
                    <label for="confirm_password">Подтвердите новый пароль:</label>
                    <input type="password" name="confirm_password" id="confirm_password" required>
                </div>

                <button type="submit" name="change_password">Изменить пароль</button>
            </form>
        </div>

        <!-- Добавляем ссылку для выхода из аккаунта -->
        <p><a href="logout.php" class="logout-button">Выйти из аккаунта</a></p>
    </div>
</main>
    <footer>
        <div class="footer_inf">
            <div class="footer_blocks">
                <h1 class="line_down">About Us</h1>
                <p>Мы — команда энтузиастов технологий, которая помогает вам лучше понять мир SSD-накопителей и их значение в современной технике. Наша цель — предоставить надежную и актуальную информацию о твердотельных накопителях, их особенностях, преимуществах и лучших вариантах для разных задач.</p>
            </div>
            <div class="footer_blocks">
                <h1 class="line_down">Qick Links</h1>
                <div class="elements_footer_inf">
                    <a href="#">Введение</a>
                    <a href="#">Руководство</a>
                    <a href="#">Преимущества</a>
                    <a href="#">Выбор SSD</a>
                    <a href="#">Оптимизация</a>
                    <a href="#">Обратная связь</a>
                </div>
            </div>
            <div class="footer_blocks">
                <h1 class="line_down">Qick Links</h1>
                <div class="elements_footer_inf">
                    <a href="#">Введение</a>
                    <a href="#">Руководство</a>
                    <a href="#">Преимущества</a>
                    <a href="#">Выбор SSD</a>
                    <a href="#">Оптимизация</a>
                    <a href="#">Обратная связь</a>
                </div>
            </div>
            <div class="footer_blocks">
                <h1 class="line_down">Contact Us</h1>

                <div class="elements_footer_inf">
                    <div><img src="../adress.png" class="icon_img"><p> 18 Kirovogradskaya Street Moskow 182738, Russia</p></div>
                    <div><img src="../images/phone.png" class="icon_img"><p>+7 985 259 0457<br>+7 978 897 3900</p></div>
                    <div><img src="../images/email.png" class="icon_img"><p>ArtemLaptev@mirea.online</p></div>
                </div>
            </div>
        </div>

        <div class="footer_dn">Created By Artem Laptev</div>
    </footer>
    
<!-- Подключение jQuery (если ещё не подключено) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
// Объявляем переменную для таймера
let hideDropdownTimeout;

// Функция для показа выпадающего окна
function showDropdown() {
    clearTimeout(hideDropdownTimeout); // Отменяем таймер закрытия, если он был установлен
    $('#notification-dropdown').addClass('show');
    loadNotifications(); // Загружаем уведомления
}

// Функция для скрытия выпадающего окна с задержкой
function hideDropdown() {
    hideDropdownTimeout = setTimeout(function() {
        $('#notification-dropdown').removeClass('show');
    }, 500); // Задержка перед закрытием в миллисекундах (500 мс)
}

// Привязываем события к иконке уведомлений
$('.notification-icon').on('mouseenter', function() {
    showDropdown();
});

$('.notification-icon').on('mouseleave', function() {
    hideDropdown();
});

// Привязываем события к самому выпадающему окну
$('#notification-dropdown').on('mouseenter', function() {
    clearTimeout(hideDropdownTimeout); // Отменяем таймер закрытия, если он был установлен
});

$('#notification-dropdown').on('mouseleave', function() {
    hideDropdown();
});

// Функция для загрузки количества непрочитанных уведомлений
function loadNotificationCount() {
    $.ajax({
        url: '../RegForm/notification_count.php',
        method: 'GET',
        dataType: 'json',
        success: function(data) {
            const countElement = document.getElementById('notification-count');
            if (data.unread_count > 0) {
                countElement.textContent = data.unread_count;
                countElement.classList.remove('hidden');
            } else {
                countElement.classList.add('hidden');
            }
        }
    });
}

// Функция для загрузки уведомлений
function loadNotifications() {
    $.ajax({
        url: '../RegForm/get_notifications.php',
        method: 'GET',
        dataType: 'json',
        success: function(data) {
            const notificationsList = document.getElementById('notifications-list');
            notificationsList.innerHTML = ''; // Очищаем список

            if (data.notifications.length === 0) {
                // Если уведомлений нет, отображаем сообщение "Пока пусто"
                const emptyMessage = document.createElement('li');
                emptyMessage.classList.add('empty-message');
                emptyMessage.innerText = 'Пока пусто';
                notificationsList.appendChild(emptyMessage);
            } else {
                data.notifications.forEach(function(notification) {
                    const li = document.createElement('li');

                    // Создаем контейнер для иконки (при необходимости)
                    const iconDiv = document.createElement('div');
                    iconDiv.classList.add('notification-item-icon');
                    const iconImg = document.createElement('img');
                    iconImg.src = '../images/icons8-уведомление-64.png'; // Замените на путь к вашей иконке
                    iconDiv.appendChild(iconImg);

                    // Создаем контейнер для текста уведомления
                    const textDiv = document.createElement('div');
                    textDiv.classList.add('notification-text');

                    // Блок сообщения уведомления
                    const messageDiv = document.createElement('div');
                    messageDiv.classList.add('notification-message');
                    messageDiv.innerText = notification.short_message; // Текст уведомления

                    // Блок времени уведомления
                    const timeDiv = document.createElement('div');
                    timeDiv.classList.add('notification-time');
                    timeDiv.innerText = notification.created_at; // Выводим время уведомления

                    // Добавляем элементы в контейнер текста
                    textDiv.appendChild(messageDiv);
                    textDiv.appendChild(timeDiv);

                    // Добавляем иконку и текст в элемент списка
                    li.appendChild(iconDiv);
                    li.appendChild(textDiv);

                    li.dataset.notificationId = notification.id; // Сохраняем ID уведомления для обработки клика
                    notificationsList.appendChild(li);
                });
            }
        }
    });
}

// Обработка клика на уведомление
$('#notifications-list').on('click', 'li', function() {
    const notificationId = $(this).data('notificationId');
    // Перенаправляем на страницу с полным уведомлением
    window.location.href = '../Notifi/notification.php?id=' + notificationId;
});

// Загрузка количества непрочитанных уведомлений при загрузке страницы
$(document).ready(function() {
    loadNotificationCount();
});

// Обновление количества непрочитанных уведомлений каждые 5 секунд
setInterval(loadNotificationCount, 5000);
</script>
</body>
</html>