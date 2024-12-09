<?php
// Установка часового пояса
date_default_timezone_set('Europe/Moscow');
session_start();

// Подключаемся к базе данных
include('../RegForm/db_connect.php');

// Проверяем, авторизован ли пользователь
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: ../RegForm/login.php');
    exit();
}

// Получаем ID пользователя из сессии
$user_id = $_SESSION['user_id'];
// URL RSS-ленты Samsung Newsroom Russia
$rss_feed_url = 'https://news.samsung.com/ru/tag/ssd/feed';

// Функция для получения и парсинга RSS-ленты с использованием cURL
function getRssFeed($url) {
    // Инициализация cURL
    $ch = curl_init();

    // Настройка опций cURL
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Установка заголовков
    $headers = [
        'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64)',
    ];
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    // Отключаем проверку SSL (если возникают ошибки)
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

    // Выполнение запроса
    $data = curl_exec($ch);

    // Проверка на ошибки
    if (curl_errno($ch)) {
        echo 'Ошибка cURL: ' . curl_error($ch);
        return false;
    }

    // Закрытие cURL
    curl_close($ch);

    // Возвращаем данные
    return simplexml_load_string($data, 'SimpleXMLElement', LIBXML_NOCDATA);
}

// Получение данных
$rss = getRssFeed($rss_feed_url);
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css"> <!-- Ваш файл стилей -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Handjet:wght@100..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Barlow:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Host+Grotesk:ital,wght@0,300..800;1,300..800&family=Hubot+Sans:ital,wght@0,200..900;1,200..900&family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Nunito:ital,wght@0,200..1000;1,200..1000&family=Oswald:wght@200..700&family=Roboto+Mono:ital,wght@0,100..700;1,100..700&display=swap" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Современные твердотельные накопители</title>
    <link rel="icon" href="https://upload.wikimedia.org/wikipedia/commons/thumb/3/3c/Bang_icon_32x32.svg/1024px-Bang_icon_32x32.svg.png" type="image/x-icon">
    <link rel="stylesheet" href="style.css"> <!-- Подключение файла стилей -->
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
                    <a href="../samsung_ssd_news/index.php">Новости</a>
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

    <!-- Основной контент -->
    <!-- Основной контент -->
<!-- Основной контент -->
<main class="site-content">
    <div class="container">
    <?php
    // Проверяем, получили ли мы данные
    if ($rss) {
        $news_found = false;
        foreach ($rss->channel->item as $item) {
            // Объединяем заголовок, описание и категории в одну строку для поиска
            $search_content = mb_strtolower($item->title . ' ' . $item->description);
            foreach ($item->category as $category) {
                $search_content .= ' ' . mb_strtolower($category);
            }

            // Список ключевых слов для поиска
            $keywords = [
                'samsung ssd',
                'ssd',
                'solid state drive',
                'накопитель',
                'жесткий диск',
                'хранение данных',
                'nvme',
                'память',
                'storage',
            ];

            // Проверяем наличие ключевых слов
            $match_found = false;
            foreach ($keywords as $keyword) {
                if (mb_strpos($search_content, mb_strtolower($keyword)) !== false) {
                    $match_found = true;
                    break;
                }
            }

            if ($match_found) {
                $news_found = true;

                // Получаем ссылку на изображение
                $image_url = '';
                $namespaces = $item->getNameSpaces(true);

                // 1. Попытка получить изображение из <media:content>
                if (isset($namespaces['media'])) {
                    $media_content = $item->children($namespaces['media']);
                    if ($media_content->content) {
                        $attributes = $media_content->content->attributes();
                        if ($attributes['url']) {
                            $image_url = (string)$attributes['url'];
                        }
                    }
                }

                // 2. Если изображение не найдено, пробуем извлечь его из <content:encoded>
                if (!$image_url) {
                    $content = $item->children('http://purl.org/rss/1.0/modules/content/');
                    if ($content->encoded) {
                        $content_encoded = (string)$content->encoded;
                        if (preg_match('/<img.*?src=["\'](.*?)["\'].*?>/i', $content_encoded, $matches)) {
                            if (isset($matches[1])) {
                                $image_url = $matches[1];
                            }
                        }
                    }
                }

                // 3. Если изображение не найдено, пробуем извлечь из описания
                if (!$image_url) {
                    $description = html_entity_decode($item->description);
                    if (preg_match('/<img.*?src=["\'](.*?)["\'].*?>/i', $description, $matches)) {
                        if (isset($matches[1])) {
                            $image_url = $matches[1];
                        }
                    }
                }

                // Генерируем уникальный идентификатор для новости на основе её ссылки
                $news_id = md5($item->link);

                // Проверяем, лайкнул ли пользователь эту новость
                // Используем подготовленное выражение для безопасности
                $stmt = $mysqli->prepare("SELECT * FROM likes WHERE user_id = ? AND news_id = ?");
                $stmt->bind_param("is", $user_id, $news_id);
                $stmt->execute();
                $result = $stmt->get_result();
                $is_liked = $result->num_rows > 0;
                $stmt->close();

                // Выводим новость
                echo '<div class="news-item">';

                    if ($image_url) {
                        echo '<div class="news-image">';
                            echo '<img src="'. htmlspecialchars($image_url) .'" alt="'. htmlspecialchars($item->title) .'">';
                        echo '</div>';
                    }

                    echo '<div class="news-content">';
                        echo '<h2><a href="'. htmlspecialchars($item->link) .'" target="_blank">'. htmlspecialchars($item->title) .'</a></h2>';
                        echo '<p class="date">'. date('d.m.Y', strtotime($item->pubDate)) .'</p>';
                    echo '</div>';

                    // Кнопка лайка
                    echo '<span class="like-button" data-news-id="'. $news_id .'">';
                        echo $is_liked ? '<i class="fas fa-heart"></i>' : '<i class="far fa-heart"></i>';
                    echo '</span>';

                echo '</div>'; // Закрываем .news-item
            }
        }
        if (!$news_found) {
            echo '<p>К сожалению, нет новостей, связанных с "Samsung SSD", на данный момент.</p>';
        }
    } else {
        echo '<p>Не удалось получить новости. Пожалуйста, попробуйте позже.</p>';
    }
    ?>
    </div>
</main>

    <!-- Подвал сайта -->
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
$(document).ready(function() {
        $('.like-button').click(function() {
            var button = $(this);
            var newsId = button.data('news-id');

            $.ajax({
                url: 'like.php',
                method: 'POST',
                data: { news_id: newsId },
                success: function(response) {
                    if (response == 'liked') {
                        button.html('<i class="fas fa-heart"></i>');
                    } else if (response == 'unliked') {
                        button.html('<i class="far fa-heart"></i>');
                    } else if (response == 'not_logged_in') {
                        alert('Пожалуйста, войдите в систему, чтобы поставить лайк.');
                    } else {
                        alert('Произошла ошибка. Пожалуйста, попробуйте снова.');
                    }
                },
                error: function() {
                    alert('Произошла ошибка при соединении с сервером.');
                }
            });
        });
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
});
</script>
</body>
</html>


