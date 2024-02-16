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
    <link rel="icon" type="image/x-icon" href="логотип_страницы">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <title>Авторизация</title>
    <meta name="robots" content="noindex, nofollow" />
</head>
<body>
    <section class="container authorization-box">
        <div class="authorization-box_main">
            <?php
                if (!empty($_SESSION['message'])) {
                    echo '<p class="error">' . $_SESSION['message'] . '</p>';
                }
                unset ($_SESSION['message']);
            ?>
            <h2 class="authorization-box_title">Авторизация</h2>
            <p class="authorization-box_text">
                Рады вас снова видеть на сайте онлайн-школы Design Lab X! Чтобы авторизоваться, введите данные, которые вы указывали при регистрации. 
            </p>
            <form action="php/handler/obr_auth.php" method="post" class="authorization-box_form" id="forma_a">
                <div class="authorization-box_inputbox">
                    <input type="text" name="login" id="login" placeholder="Введите ваше логин">
                    <input type="password" id="password" name="password" placeholder="Введите ваш пароль">
                </div>
                <div class="g-recaptcha" data-sitekey="6LeBxtMmAAAAAHY7ImyB9QdLYe9a50OFjZySI865" style=" display: flex; justify-content: center; margin-top: 30px;"></div>
                <div class="authorization-box_buttonbox">
                    <input class="authorization-box_button authorization-box_button-text" type="submit" name="auth" value="Войти"/>
                    <a href="registration.php" class="authorization-box_link">У вас нет аккаунта?</a>
                </div>   
            </form>
        </div>
        
    </section>
</body>
</html>