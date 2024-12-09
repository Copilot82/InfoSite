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

        <div class="text_baz">
            <h1>Руководство по SSD</h1>
            <div class="t_block1">
                <h2>Основные компоненты SSD</h2>
                <ul>
                    <li>Контроллер: Центральный компонент, управляющий операциями чтения и записи данных. Контроллер отвечает за распределение данных по ячейкам памяти и управление ошибками.</li>
                    <li>Флеш-память NAND: Хранит данные. Существует несколько типов флеш-памяти NAND (SLC, MLC, TLC, QLC), различающихся по скорости и долговечности.</li>
                    <li>DRAM-кэш: Временное хранилище для ускорения доступа к данным. Позволяет повысить общую производительность SSD.</li>
                    <li>Интерфейс подключения: Определяет способ подключения SSD к материнской плате (SATA, PCIe, NVMe и др.).</li>
                </ul>
            </div>

            <div class="video-container">
                <div class="line"></div> <!-- Линия сверху -->

                <iframe width="560" height="315" src="https://www.youtube.com/embed/9SASPYJpfnQ" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

                
                <div class="line"></div> <!-- Линия снизу -->
            </div>

            <div class="t_block2">
                <h2>Установка SSD</h2>
                <ol>
                    <li> Подготовка:
                        <ul>
                            <li>Выключите компьютер и отключите его от сети.</li>
                            <li>Заземлите себя, чтобы избежать статического электричества.</li>
                        </ul>
                    </li>
                    <li> Открытие корпуса:
                        <ul>
                            <li>Снимите крышку корпуса компьютера, используя соответствующие инструменты.</li>
                        </ul>
                    </li>
                    <li> Подключение SSD:
                        <ul>
                            <li>Для 2.5" SSD: Вставьте накопитель в соответствующий отсек и подключите кабель SATA и питание.</li>
                            <li>Для M.2 SSD: Вставьте накопитель в разъем M.2 на материнской плате и закрепите винтом.</li>
                        </ul>
                    </li>
                    <li> Закрытие корпуса:
                        <ul>
                            <li>Убедитесь, что все соединения надежны, затем закройте корпус компьютера.</li>
                        </ul>
                    </li>
                    <li> Настройка системы:
                        <ul>
                            <li>Включите компьютер и войдите в BIOS/UEFI.</li>
                            <li>Убедитесь, что новый SSD распознан системой.</li>
                            <li>Установите SSD в качестве основного загрузочного устройства, если планируете установить на него операционную систему.</li>
                        </ul>
                    </li>
                </ol>
            </div>





            <div class="t_block2" >
                <h2>Установка операционной системы на SSD</h2>
                <ol>
                    <li> Создание загрузочного носителя:
                        <ul>
                            <li>Скачайте образ операционной системы и создайте загрузочную флешку с помощью программ, таких как Rufus.</li>
                        </ul>
                    </li>
                    <li> Установка ОС:
                        <ul>
                            <li>Вставьте загрузочную флешку и перезагрузите компьютер.</li>
                            <li>Следуйте инструкциям установщика для установки операционной системы на SSD.</li>
                        </ul>
                    </li>
                    <li> Настройка загрузки:
                        <ul>
                            <li>После установки убедитесь, что SSD установлен как первое загрузочное устройство в BIOS/UEFI.</li>
                        </ul>
                    </li>
                </ol>
            </div>




            <div class="t_block2">
                <h2>Обслуживание и уход за SSD</h2>
                <ol>
                    <li> Мониторинг состояния:
                        <ul>
                            <li>Используйте программы, такие как CrystalDiskInfo, для отслеживания состояния SSD.</li>
                        </ul>
                    </li>
                    <li> Обновление прошивки:
                        <ul>
                            <li>Регулярно проверяйте обновления прошивки на сайте производителя и устанавливайте их для улучшения производительности и стабильности.</li>
                        </ul>
                    </li>
                    <li> Резервное копирование данных:
                        <ul>
                            <li>Регулярно создавайте резервные копии важных данных, чтобы избежать потери информации.</li>
                        </ul>
                    </li>
                </ol>
            </div>
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
