<?php
session_start();

// Подключаемся к базе данных
include('../RegForm/db_connect.php');
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
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

    <main>

        <h1>Выбор SSD</h1>

        <div class="t_block2">
            <h2>Критерии выбора SSD</h2>
            <ol>
                <li> Объем памяти:
                    <ul>
                        <li>256 ГБ: Подходит для базовых задач, таких как работа с документами и веб-серфинг.</li>
                        <li>512 ГБ: Оптимален для большинства пользователей, обеспечивая достаточное пространство для операционной системы, программ и данных.</li>
                        <li>1 ТБ и более: Рекомендуется для геймеров, профессионалов и тех, кто работает с большими объемами данных.</li>
                    </ul>
                </li>
                <li> Тип флеш-памяти NAND:
                    <ul>
                        <li>SLC (Single-Level Cell): Высокая скорость и долговечность, но высокая стоимость. Подходит для промышленных и серверных решений.</li>
                        <li>MLC (Multi-Level Cell): Баланс между скоростью, долговечностью и стоимостью.</li>
                        <li>TLC (Triple-Level Cell): Большая емкость по более низкой цене, подходит для большинства потребителей.</li>
                        <li>QLC (Quad-Level Cell): Максимальная плотность хранения, но меньшая долговечность. Идеален для хранения больших объемов данных.</li>
                    </ul>
                </li>
                <li> Интерфейс подключения:
                    <ul>
                        <li>SATA: Доступный и широко поддерживаемый интерфейс, но с ограниченной скоростью.</li>
                        <li>PCIe/NVMe: Высокоскоростные интерфейсы, обеспечивающие максимальную производительность. Подходят для требовательных задач.</li>
                    </ul>
                </li>
                <li> Форм-фактор:
                    <ul>
                        <li>2.5": Стандартный форм-фактор, подходящий для большинства настольных компьютеров и ноутбуков.</li>
                        <li>M.2: Компактный форм-фактор, позволяющий устанавливать SSD непосредственно на материнскую плату.</li>
                        <li>U.2: Используется в серверных решениях и рабочих станциях, поддерживает высокую производительность.</li>
                    </ul>
                </li>
                <li> Производитель и гарантия:
                    <ul>
                        <li>Выбирайте проверенных производителей с хорошей репутацией.</li>
                        <li>Обратите внимание на срок гарантии и условия ее предоставления.</li>
                    </ul>
                </li>
            </ol>
        </div>


        <div class="img_carts">
            <div class="cart">
                <img src = "../images/samsungSSD.jpeg" width = "300px" class="img_of_cart">
                <div class="text_of_cart">
                    <h1>Samsung 970 EVO Plus:</h1>
                    <ul>
                        <li>Преимущества: Высокая скорость чтения/записи, надежность, поддержка NVMe.</li>
                        <li>Идеально подходит для: Геймеров, профессионалов и пользователей, требующих высокой производительности.</li>
                    </ul>
                </div>
            </div>
            <div class="cart">
                <img src = "../images/WestSSD.jpeg" width = "300px" class="img_of_cart">
                <div class="text_of_cart">
                    <h1>Western Digital Blue SN550:</h1>
                    <ul>
                        <li>Преимущества: Отличное соотношение цены и качества, поддержка NVMe.</li>
                        <li>Идеально подходит для: Повседневных задач и апгрейда старых систем.</li>
                    </ul>
                </div> 
            </div>
            <div class="cart">
                <img src = "../images/CrucSSD.jpeg" width = "300px" class="img_of_cart">
                <div class="text_of_cart">
                    <h1>Crucial MX500:</h1>
                    <ul>
                        <li>Преимущества: Высокая надежность, поддержка SATA, хорошая цена.</li>
                        <li>Идеально подходит для: Апгрейда ноутбуков и настольных компьютеров, требующих надежного SATA SSD.</li>
                    </ul>
                </div>
            </div>
            <div class="cart">
                <img src = "../images/KingSSD.jpeg" width = "300px" class="img_of_cart">
                <div class="text_of_cart">
                    <h1>Kingston A2000:</h1>
                    <ul>
                        <li>Преимущества: Доступная цена, поддержка NVMe, хороший баланс между производительностью и стоимостью.</li>
                        <li>Идеально подходит для: Пользователей, ищущих бюджетный NVMe SSD.</li>
                    </ul>
                </div>
            </div>
        </div>




        <div class="t_block1">
            <h2>Советы по выбору</h2>
            <ul>
                <li><b>Определите свои потребности:</b> Для работы с большими файлами и профессиональных задач выберите SSD с высокой скоростью и емкостью. Для базовых задач подойдут модели с меньшей емкостью и более доступной ценой.</li>
                <li><b>Проверяйте совместимость:</b> Убедитесь, что выбранный SSD совместим с вашим устройством по интерфейсу и форм-фактору.</li>
                <li><b>Читайте отзывы:</b> Ознакомьтесь с отзывами пользователей и профессиональными обзорами, чтобы узнать о реальной производительности и надежности модели.</li>
                <li><b>Сравнивайте цены:</b> Сравните цены на различные модели SSD, чтобы найти оптимальное соотношение цены и качества.</li>
            </ul>
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
