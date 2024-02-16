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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <title>Регистрация</title>
    <meta name="robots" content="noindex, nofollow" />
</head>
<body>
    <section class="container registration-box">
        <div class="registration-box_main">
            <?php
                if (!empty($_SESSION['message'])) {
                    echo '<p class="error">' . $_SESSION['message'] . '</p>';
                }
                unset ($_SESSION['message']);
            ?>
            <h2 class="registration-box_title">Регистрация</h2>
            <p class="registration-box_text">
                Добро пожаловать на сайт онлайн-школы Design Lab X! Чтобы зарегистрироваться, пожалуйста заполните анкету ниже. 
            </p>
            <form action="php/handler/obr_reg.php" method="post" class="registration-box_form" id="forma_r">
                <div class="registration-box_inputbox">
                    <input type="text" name="name" id="name" placeholder="Введите ваше имя">
                    <input type="text" name="surname" id="surname" placeholder="Введите вашу фамилию">
                    <input type="tel" id="phone" name="tel" placeholder="Введите ваш телефон">
                    <input type="email" name="email" id="email" placeholder="Введите ваш email">
                    <input type="text" name="login" id="login" placeholder="Введите ваше логин">
                    <input type="password" id="password" name="password" placeholder="Введите ваш пароль">
                </div>
                <div class="registration-box_buttonbox">
                    <input class="registration-box_button registration-box_button-text" type="submit" name="reg" value="Зарегистрироваться"/>
                    <a href="authorization.php" class="registration-box_link">У вас уже есть аккаунт?</a>
                </div>   
            </form>
            <script>
                $(document).ready(function(){
                $('#phone').mask("+7 (999) 999-99-99");

                $('#forma_r').submit(function(event) {
                    var phoneInput = $('#phone').val();
                    var phoneNumber = phoneInput.replaceAll(/\D+/g, '');
                    $('#phone').val(phoneNumber);         
                });
                });

            </script>
        </div>
        
    </section>
</body>
</html>