<?php
session_start();

// Проверяем, авторизован ли пользователь
if (!isset($_SESSION['user_id'])) {
    // Пользователь не авторизован, выводим сообщение
    echo "<p>Вы должны войти в систему, чтобы отправить сообщение. <a href='../RegForm/login.php'>Войти</a> или <a href='../RegForm/index.html'>Зарегистрироваться</a>.</p>";
    exit;
}
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
                <li><a href="../form/index.php">Форма обратной связи</a></li>
            </ul>
    
            <div class="icons-sites">
                <div class="icon_s1"><img src="../images/free-icon-notification-10419399.png" width="30px" class="img_nav"></div>
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

    <main>

        <h1>Форма</h1>

        <div class="content">

            <img src="../images/ssd.png" class="Big_img_ssd">

            <form action="send_mail.php" method="post">
                <fieldset>
                    <div class="label">
                        <h1>Как к вам обращаться</h1>
                        <input type="text" name="username" class="ent_inf" autocomplete="off" required>
                    </div>

                    <div class="label">
                        <h1>Контактный Email</h1>
                        <input type="email" name="email_address" class="ent_inf" autocomplete="off" required>
                    </div>

                    <div class="label">
                        <h1>Номер телефона</h1>
                        <input type="tel" name="phone_number" class="ent_inf" autocomplete="off" required>
                    </div>

                    <textarea name="comment" class="comment" placeholder="Добавьте сюда свой комментарий"></textarea>
                </fieldset>

                <input type="submit" name="submit" value="Отправить" class="btn_s">
            </form>
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



    <script>
        document.querySelector('.ent_inf').addEventListener('click', function() {
            document.querySelector('.label').classList.toggle('active');
        });
    </script>


</body>
</html>
