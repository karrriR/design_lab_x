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
    <link rel="icon" type="image/x-icon" href="image/elements/x-logo.svg">
    <title>Регистрация</title>
    <meta name="robots" content="noindex, nofollow" />
</head>
<body>
        <?php
            if (!empty($_SESSION['message'])) {
                echo '<div id="myModal" class="modal">
                        <div class="modal_content">
                        <svg class="modal_close" width="22" height="22" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M15 17.6513L21.6287 24.2813C21.9805 24.633 22.4576 24.8306 22.955 24.8306C23.4524 24.8306 23.9295 24.633 24.2812 24.2813C24.633 23.9295 24.8306 23.4525 24.8306 22.955C24.8306 22.4576 24.633 21.9805 24.2812 21.6288L17.65 15L24.28 8.37127C24.4541 8.1971 24.5922 7.99035 24.6863 7.76282C24.7805 7.5353 24.829 7.29145 24.8289 7.0452C24.8288 6.79895 24.7803 6.55512 24.686 6.32764C24.5917 6.10016 24.4535 5.89347 24.2794 5.71939C24.1052 5.54531 23.8985 5.40723 23.6709 5.31305C23.4434 5.21887 23.1996 5.17042 22.9533 5.17048C22.7071 5.17054 22.4632 5.2191 22.2357 5.31339C22.0083 5.40768 21.8016 5.54585 21.6275 5.72002L15 12.3488L8.37124 5.72002C8.19836 5.54085 7.99154 5.39792 7.76283 5.29954C7.53411 5.20117 7.2881 5.14933 7.03914 5.14705C6.79018 5.14477 6.54326 5.1921 6.31279 5.28626C6.08232 5.38043 5.8729 5.51956 5.69677 5.69552C5.52064 5.87149 5.38132 6.08077 5.28693 6.31115C5.19255 6.54154 5.14499 6.78841 5.14704 7.03738C5.14908 7.28634 5.20069 7.5324 5.29885 7.7612C5.397 7.99 5.53975 8.19697 5.71874 8.37002L12.35 15L5.71999 21.6288C5.36825 21.9805 5.17064 22.4576 5.17064 22.955C5.17064 23.4525 5.36825 23.9295 5.71999 24.2813C6.07174 24.633 6.5488 24.8306 7.04624 24.8306C7.54368 24.8306 8.02075 24.633 8.37249 24.2813L15 17.65V17.6513Z" fill="gray"/>
                        </svg>
                            <p class="modal_error">' . $_SESSION['message'] . '</p>
                        </div>
                    </div>';
            }
            unset($_SESSION['message']);
        ?>
    <section class="registration-box">
    <div class="container">
        <div class="registration-box_main">
            <h1 class="registration-box_title">Регистрация</h1>
            <p class="registration-box_text">
                Добро пожаловать на сайт онлайн-школы Design Lab X! Чтобы зарегистрироваться, пожалуйста заполните анкету ниже. 
            </p>
            <form action="php/handler/obr_reg.php" method="post" class="registration-box_form" id="forma_r">
                <div class="registration-box_inputbox">
                    <input type="email" name="email" id="email" placeholder="Введите ваш email" required>
                    <input type="text" name="login" id="login" placeholder="Введите логин" required>
                    <input type="password" id="password" name="password" placeholder="Введите пароль" required>
                    <input type="password" id="password" name="confirmPassword" placeholder="Повторно введите пароль" required>
                </div>
                <div class="registration-box_buttonbox">
                    <input class="registration-box_button registration-box_button-text" type="submit" name="reg" value="Зарегистрироваться"/>
                    <a href="authorization.php" class="registration-box_link">У вас уже есть аккаунт?</a>
                    <a href="index.php" class="registration-box_back-link">
                        <img src="image/elements/icon-back-index-page.svg" alt="back to index page">
                        Вернуться на главную страницу
                    </a>
                </div>   
            </form>
        </div>
    </div>
    </section>
    <script src="js/errors.js"></script>
</body>
</html>