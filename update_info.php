<?php
session_start();
require_once 'php/config/connect.php';

if(empty($_SESSION['user'])) {
    header('Location: authorization.php');
}
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
    <title>Изменение персональных данных</title>
    <meta name="robots" content="noindex, nofollow" />
</head>
<body>
    <section class="container update-box">
        <div class="update-box_main">
            <?php
                if (!empty($_SESSION['message'])) {
                    echo '<p class="error">' . $_SESSION['message'] . '</p>';
                }
                unset ($_SESSION['message']);
            ?>
            <h2 class="update-box_title">Изменение данных</h2>
            <form enctype="multipart/form-data" action="php/handler/update_users.php" method="POST" id="update_user" class="update-box_form">
                <div class="update-box_inputbox">
                    <input type="text" name="name" placeholder="Имя" value="<?= $_SESSION['user'] ['name'] ?>">
                    <input type="text" name="surname" placeholder="Фамилия" value="<?= $_SESSION['user'] ['surname'] ?>">
                    <input type="tel" name="tel" id="phone" placeholder="Телефон" value="<?= $_SESSION['user'] ['telephone'] ?>">
                    <input type="email" name="email" placeholder="email" value="<?= $_SESSION['user'] ['email'] ?>">
                    <input type="text" name="login" placeholder="Логин" value="<?= $_SESSION['user'] ['login'] ?>">
                    <input type="password" name="password" placeholder="Пароль" value="<?= $_SESSION['user'] ['password'] ?>">
                    <input type="text" name="country" placeholder="Страна" value="<?= $_SESSION['user'] ['country'] ?>">
                    <input type="text" name="city" placeholder="Город" value="<?= $_SESSION['user'] ['city'] ?>">
                    <input type="date" name="date" placeholder="Дата рождения" value="<?= $_SESSION['user'] ['dateofbd'] ?>">
                    <input type="text" name="foto" value="<?= $_SESSION['user'] ['photo_profile'] ?>">
                    <input type="file" name="img" />
                    <input type="hidden" name="id_access_rights" value="<?= $_SESSION['user'] ['id_access_rights'] ?>">
                </div>
                <div class="update-box_buttonbox">
                    <input class="update-box_button update-box_button-text" type="submit" name="update" value="Изменить"/>
                    <a href="profile.php" class="update-box_link">Вернуться назад</a>
                </div>   
            </form>
            <script>
                $(document).ready(function(){
                $('#phone').mask("+7 (999) 999-99-99");

                $('#update_user').submit(function(event) {
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