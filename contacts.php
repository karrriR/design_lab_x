<?php
session_start();
require_once 'php/config/connect.php';

?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <link rel="icon" type="image/x-icon" href="логотип_страницы">
    <title>Контакты | Design Lab X</title>
    <meta name="description" content="Свяжитесь с нами для получения дополнительной информации о курсах по дизайну в онлайн-школе Design Lab X. Мы готовы помочь ответить на ваши вопросы." />
    <meta name="keywords" content="контакты, обратная связь, Design Lab X, онлайн-школа, дизайн" />
    <meta name="robots" content="index" />
</head>
<body>
    <header class="header">
        <div class="container">
            <nav class="main-menu">
                <ul class="main-menu_wrapper">
                    <li class="main-menu_list"><a href="index.php" class="main-menu_link"><img src="image/elements/Logo.svg" alt="logo"></a></li>
                </ul>
                <ul class="main-menu_wrapper">
                    <li class="main-menu_list">
                        <a href="#" class="main-menu_link button-open">
                            <svg class="main-menu_svg-close" width="26" height="24" viewBox="0 0 26 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M2 12H24" stroke="black" stroke-width="4" stroke-linecap="round"/>
                                <path d="M2 2L24 2" stroke="black" stroke-width="4" stroke-linecap="round"/>
                                <path d="M2 22L24 22" stroke="black" stroke-width="4" stroke-linecap="round"/>
                            </svg>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
        <div class="container-two contacts-info">
            <div class="contacts-info_main-box">
                <h1 class="contacts-info_title">Контактная информация</h1>
                <p class="contacts-info_text">Адрес:  г. Москва, ул. Проспект Вернадского, д.6<br>
                    Email:  design_lab_x@mail.ru<br>
                    Телефон:  +7 996 895-73-66</p>
                <button class="contacts-info_button contacts-info_button-text" onclick="scrollToTarget()">Написать нам</button>
            </div>
        </div>
    </header>
    <div class="overlay"></div>
    <div class="dropdown-menu">
        <div class="dropdown-menu_close-box">
            <button class="dropdown-menu_button">
                <svg class="dropdown-menu_svg-close" width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M15 17.6513L21.6287 24.2813C21.9805 24.633 22.4576 24.8306 22.955 24.8306C23.4524 24.8306 23.9295 24.633 24.2812 24.2813C24.633 23.9295 24.8306 23.4525 24.8306 22.955C24.8306 22.4576 24.633 21.9805 24.2812 21.6288L17.65 15L24.28 8.37127C24.4541 8.1971 24.5922 7.99035 24.6863 7.76282C24.7805 7.5353 24.829 7.29145 24.8289 7.0452C24.8288 6.79895 24.7803 6.55512 24.686 6.32764C24.5917 6.10016 24.4535 5.89347 24.2794 5.71939C24.1052 5.54531 23.8985 5.40723 23.6709 5.31305C23.4434 5.21887 23.1996 5.17042 22.9533 5.17048C22.7071 5.17054 22.4632 5.2191 22.2357 5.31339C22.0083 5.40768 21.8016 5.54585 21.6275 5.72002L15 12.3488L8.37124 5.72002C8.19836 5.54085 7.99154 5.39792 7.76283 5.29954C7.53411 5.20117 7.2881 5.14933 7.03914 5.14705C6.79018 5.14477 6.54326 5.1921 6.31279 5.28626C6.08232 5.38043 5.8729 5.51956 5.69677 5.69552C5.52064 5.87149 5.38132 6.08077 5.28693 6.31115C5.19255 6.54154 5.14499 6.78841 5.14704 7.03738C5.14908 7.28634 5.20069 7.5324 5.29885 7.7612C5.397 7.99 5.53975 8.19697 5.71874 8.37002L12.35 15L5.71999 21.6288C5.36825 21.9805 5.17064 22.4576 5.17064 22.955C5.17064 23.4525 5.36825 23.9295 5.71999 24.2813C6.07174 24.633 6.5488 24.8306 7.04624 24.8306C7.54368 24.8306 8.02075 24.633 8.37249 24.2813L15 17.65V17.6513Z" fill="white"/>
                </svg>
            </button>
        </div>
        <div class="dropdown-menu_main-box">
            <ul class="dropdown-menu_wrapper" onclick="location.href='index.php'">
                <h2 class="dropdown-menu_title">Главная</h2>
            </ul>
            <ul class="dropdown-menu_wrapper">
                <h2 class="dropdown-menu_title dropdown-menu_title-margin">Наши курсы</h2>
                <li class="dropdown-menu_list"><a href="course.php" class="dropdown-menu_link">веб-дизайнер</a></li>
                <li class="dropdown-menu_list"><a href="course.php" class="dropdown-menu_link">моушн-дизайнер</a></li>
                <li class="dropdown-menu_list"><a href="course.php" class="dropdown-menu_link">3D artist</a></li>
                <li class="dropdown-menu_list"><a href="course.php" class="dropdown-menu_link">коммерческий иллюстратор</a></li>
                <li class="dropdown-menu_list"><a href="course.php" class="dropdown-menu_link">дизайнер интерактивных медиа</a></li>
                <li class="dropdown-menu_list"><a href="course.php" class="dropdown-menu_link">UX/UI-дизайнер</a></li>
                <li class="dropdown-menu_list"><a href="course.php" class="dropdown-menu_link">режиссер видеомонтажа | NEW</a></li>
            </ul>
            <ul class="dropdown-menu_wrapper">
                <h2 class="dropdown-menu_title">Контакты</h2>
            </ul>
            <?php
                if(!empty($_SESSION['user'])) {
                    echo '<ul class="dropdown-menu_wrapper" onclick="location.href=\'profile.php\'">
                    <h2 class="dropdown-menu_title">Личный кабинет</h2>
                    </ul>';
                    echo '<ul class="dropdown-menu_wrapper" onclick="location.href=\'php/handler/exit.php\'">
                        <h2 class="dropdown-menu_title">Выйти</h2>
                    </ul>';
                } else {
                    echo '<ul class="dropdown-menu_wrapper" onclick="location.href=\'authorization.php\'">
                    <h2 class="dropdown-menu_title">Личный кабинет</h2>
                    </ul>';
                }
            ?>
        </div>  
    </div>
    <section class="container section-director-info">
        <div class="section-director-info_img-box">
            <img src="image/elements/foto_director.png" alt="foto">
        </div>
        <div class="section-director-info_text-box">
            <h2 class="section-director-info_title">Добро пожаловать в Design Lab X - здесь ваше творческое воображение станет лучшим инструментом!</h2>
            <p class="section-director-info_text">Привет! Я — Екатерина Когаль, директор онлайн школы дизайна Design Lab X.
                Если у вас возникли трудности и вам есть, о чем рассказать, можете смело писать мне напрямую!</p>
            <div class="section-director-info_social-network-box">
                <a href="#" class="section-director-info_link"><img src="image/elements/icon_email_black.svg" alt="social network"></a>
                <a href="#" class="section-director-info_link"><img src="image/elements/icon_telegtam_black.svg" alt="social network"></a>
                <a href="#" class="section-director-info_link"><img src="image/elements/icon_vk_black.svg" alt="social network"></a>
            </div>
        </div>
    </section>
    <section class="container section-answer-form" id="answer-form">
            <?php
                if (!empty($_SESSION['message'])) {
                    echo '<p class="error">' . $_SESSION['message'] . '</p>';
                }
                unset ($_SESSION['message']);
            ?>
        <div class="section-answer-form_box">
            <div class="section-answer-form_main">
                <div class="section-answer-form_text-box">
                    <h2 class="section-answer-form_title">Возникли вопросы?Свяжитесь с нами!</h2>
                    <p class="section-answer-form_text">Заполните форму ниже, чтобы связаться с нами. Мы будем рады ответить на ваши вопросы, предоставить дополнительную информацию или помочь с чем-либо, что вам понадобится. Не стесняйтесь обращаться к нам!</p>
                </div>
                <div class="section-answer-form_formbox">
                    <form action="php/handler/answer-form_obr.php" method="POST" class="section-answer-form_form-main" id="forma_answer">
                        <div class="section-answer-form_input-box">
                            <input type="text" name="name" placeholder="Введите ваше имя">
                            <input type="email" name="email" placeholder="Введите ваш email">
                            <input type="tel" name="tel" id="phone" placeholder="Введите ваш телефон">
                            <textarea maxlength="30" name="message" placeholder="Введите ваш вопрос"></textarea>
                        </div>
                        <div class="section-answer-form_personal-data">
                            <input type="checkbox" class="section-answer-form_personal-data-checkbox" name="personal-data"/>
                            <label class="section-answer-form_personal-data-label" for="personal-data">Нажимая, вы даете согласие на обработку своих персональных данных</label>
                        </div>
                        <input class="section-answer-form_personal-data-button section-answer-form_personal-data-button-text" type="submit" name="answer" value="Отправить"/>
                    </form>
                    <script>
                        $(document).ready(function(){
                        $('#phone').mask("+7 (999) 999-99-99");

                        $('#forma_answer').submit(function(event) {
                            var phoneInput = $('#phone').val();
                            var phoneNumber = phoneInput.replaceAll(/\D+/g, '');
                            $('#phone').val(phoneNumber);         
                        });
                        });

                        function scrollToTarget() {
                            var target = document.getElementById('answer-form');
                            target.scrollIntoView({ behavior: 'smooth' });
                        }
                    </script>
                </div>
            </div>
        </div>
    </section>
    <footer class="footer">
        <div class="footer_main-box">
            <div class="container footer_main">
                <ul class="footer_main-wrapper">
                    <li class="footer_main-list"><a href="index.php" class="footer_main-link"><img src="image/elements/Logo.svg" alt="logo" class="footer_main-wrapper-logo"></a></li>
                </ul>
                <ul class="footer_main-wrapper footer_main-wrapper-info">
                    <li class="footer_main-list">г. Москва, ул. Проспект Вернадского, д.6</li>
                    <li class="footer_main-list">Email: design_lab_x@mail.ru</li>
                    <li class="footer_main-list">Tel: +7 996 895-73-66</li>
                </ul>
                <ul class="footer_main-wrapper footer_main-wrapper-apps">
                    <li class="footer_main-list"><a href="#" class="footer_main-link"><img src="image/elements/icon_telegtam_purple.svg" alt="telegram"></a></li>
                    <li class="footer_main-list"><a href="#" class="footer_main-link"><img src="image/elements/icon_vk_purple.svg" alt="vk"></a></li>
                    <li class="footer_main-list"><a href="#" class="footer_main-link"><img src="image/elements/icon_pinterest_purple.svg" alt="pinterest"></a></li>
                </ul>
            </div>
        </div>
        <div class="footer_aditional-box">
            <p class="footer_aditional-text">© Design Lab X —онлайн-школа дизайна 2023</p>
        </div>
    </footer>
    <script src="js/menu.js"></script>
</body>
</html>