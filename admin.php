<?php
session_start();
require_once 'php/config/connect.php';

if(empty($_SESSION['user'])) {
    header('Location: authorization.php');
} else {
    $id_access_rights = $_SESSION['user']['id_access_rights'];
    if($id_access_rights == 1) {
        header('Location: profile.php');
    }
}
$id = $_SESSION['user'] ['id_users'];
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <link rel="icon" type="image/x-icon" href="image/elements/x-logo.svg">
    <title>Административная панель</title>
    <meta name="robots" content="noindex, nofollow" />
</head>
<body class="admin-panel">
    <div class="admin-panel_sidebar">
        <h1 class="admin-panel_sidebar-title" onclick="location.href='admin.php'">Admin.</h1>
        <ul class="admin-panel_sidebar-link">
            <li data-table-name="answers">Вопросы</li>
            <li data-table-name="consultations">Запросы на консультацию</li>
            <li data-table-name="courses">Курсы</li>
            <li data-table-name="users">Пользователи</li>
            <li data-table-name="course_registration">Регистрация на курс</li>
            <li data-table-name="course_sections">Разделы курса</li>
            <li data-table-name="lectures">Лекции</li>
            <li data-table-name="reference_documents">Дополнительные ссылки</li>
            <li data-table-name="tests">Тесты</li>
            <li data-table-name="test_questions">Вопросы для теста</li>
            <li data-table-name="user_course_progress">Прохождение курса</li>
            <li data-table-name="user_section_progress">Прохождение раздела курса</li>
            <li data-table-name="user_test_progress">Прохождение теста</li>
        </ul>
        <p class="admin-panel_sidebar-exit" onclick="location.href='php/handler/exit.php'">Выйти</p>
    </div>
    <div class="admin-panel_main">
        <div class="admin-panel_header">
            <div class="admin-panel_table-info">
                <h2 class="admin-panel_table-info-nametable">Название таблицы</h2>
                <button class="admin-panel_table-info-button">Добавить запись</button>
            </div>
            <div class="admin-panel_user-info">
            <?php
                $sql = "SELECT * FROM `users` WHERE `id_users`='$id'";
                $result = mysqli_query($link, $sql);
                
                if (mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) {
            ?>
                <div class="admin-panel_user-info-main">
                    <p class="admin-panel_user-info-nameuser"><?= $row["login"] ?></p>
                    <p class="admin-panel_user-info-emailuser"><?= $row["email"] ?></p>
                </div>
                <img src="php/admin/img/admin_foto_base.png" alt="foto_profile">
            </div>
        </div>
        <div class="admin-panel_welcome-block">
            <h3 class="admin-panel_welcome-block-title">Добро пожаловать на панель администратора, <?= $row["login"] ?></h3>
            <p class="admin-panel_welcome-block-text">Хорошего дня и продуктивной работы!</p>
        </div>
        <?php
                }
            }
        ?>
        <div class="admin-panel_table-container">

        </div>
    </div>
    <div id="addRecordModal" class="admin-panel_modalAddData">
        <div class="admin-panel_modal-content">
            <svg class="admin-panel_svg-close" width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M15 17.6513L21.6287 24.2813C21.9805 24.633 22.4576 24.8306 22.955 24.8306C23.4524 24.8306 23.9295 24.633 24.2812 24.2813C24.633 23.9295 24.8306 23.4525 24.8306 22.955C24.8306 22.4576 24.633 21.9805 24.2812 21.6288L17.65 15L24.28 8.37127C24.4541 8.1971 24.5922 7.99035 24.6863 7.76282C24.7805 7.5353 24.829 7.29145 24.8289 7.0452C24.8288 6.79895 24.7803 6.55512 24.686 6.32764C24.5917 6.10016 24.4535 5.89347 24.2794 5.71939C24.1052 5.54531 23.8985 5.40723 23.6709 5.31305C23.4434 5.21887 23.1996 5.17042 22.9533 5.17048C22.7071 5.17054 22.4632 5.2191 22.2357 5.31339C22.0083 5.40768 21.8016 5.54585 21.6275 5.72002L15 12.3488L8.37124 5.72002C8.19836 5.54085 7.99154 5.39792 7.76283 5.29954C7.53411 5.20117 7.2881 5.14933 7.03914 5.14705C6.79018 5.14477 6.54326 5.1921 6.31279 5.28626C6.08232 5.38043 5.8729 5.51956 5.69677 5.69552C5.52064 5.87149 5.38132 6.08077 5.28693 6.31115C5.19255 6.54154 5.14499 6.78841 5.14704 7.03738C5.14908 7.28634 5.20069 7.5324 5.29885 7.7612C5.397 7.99 5.53975 8.19697 5.71874 8.37002L12.35 15L5.71999 21.6288C5.36825 21.9805 5.17064 22.4576 5.17064 22.955C5.17064 23.4525 5.36825 23.9295 5.71999 24.2813C6.07174 24.633 6.5488 24.8306 7.04624 24.8306C7.54368 24.8306 8.02075 24.633 8.37249 24.2813L15 17.65V17.6513Z" fill="black"/>
            </svg>
            <h2 class="admin-panel_modal-title"></h2>
            <form class="admin-panel_modal-form" id="addRecordForm" method="POST">
            </form>
        </div>
    </div>
    <script>
        $('.admin-panel_sidebar-link li').on('click', function() {
            var tableName = $(this).data('table-name');
            $.ajax({
            url: 'php/admin/get_table_records.php',
            method: 'POST',
            data: { tableName: tableName }, 
            dataType: 'json',
            success: function(response) {
                $('.admin-panel_table-info-nametable').text(tableName);
                $('.admin-panel_table-info').css('display', 'flex');
                $('.admin-panel_table-container').css('display', 'block');
                $('.admin-panel_table-container').css('margin-top', '182px');
                $('.admin-panel_welcome-block').css('display', 'none');
                
                var tableContainer = $('.admin-panel_table-container');
                tableContainer.empty(); 

                var headerRow = '<div class="table-row">';
                for (var key in response.data[0]) {
                    headerRow += '<div class="table-header">' + key + '</div>'; 
                }
                headerRow += '<div class="table-header">Actions</div>'; 
                headerRow += '</div>';
                tableContainer.append(headerRow);

                $.each(response.data, function(index, record) {
                    var row = '<div class="table-row">';
                    for (var key in record) {
                        row += '<div class="table-cell">' + record[key] + '</div>'; 
                    }
                    row += '<div class="table-cell"><img src="image/elements/admin_icon_update.svg"><img src="image/elements/admin_icon_basket.svg"></div>';
                    row += '</div>';
                    tableContainer.append(row); 
                });
            },
            error: function(xhr, status, error) {
            }
        });
        });
    </script>
    <script src="js/admin_add_data.js"></script>
</body>
</html>