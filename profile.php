<?php
session_start();
require_once 'php/config/connect.php';

if(empty($_SESSION['user'])) {
    header('Location: authorization.php');
}
$id = $_SESSION['user'] ['id_users'];
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="icon" type="image/x-icon" href="image/elements/x-logo.svg">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <title>Личный кабинет</title>
    <meta name="robots" content="noindex, nofollow" />
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
        <div class="container profile-info">
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
            <h1 class="profile-info_title">Личный кабинет</h1>
            <div class="profile-info_box-title-additional">
                <h2 class="profile-info_title-additional">Карточка студента</h2>
                <button class="profile-info_button profile-info_button-text" onclick="location.href='update_info.php'">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 23H23M15.6667 3.72579L19.3333 7.58063M17.5 1.79836C17.9862 1.28718 18.6457 1 19.3333 1C19.6738 1 20.011 1.0705 20.3255 1.20749C20.6401 1.34447 20.9259 1.54525 21.1667 1.79836C21.4074 2.05148 21.5984 2.35196 21.7287 2.68267C21.859 3.01338 21.9261 3.36783 21.9261 3.72579C21.9261 4.08374 21.859 4.43819 21.7287 4.7689C21.5984 5.09961 21.4074 5.40009 21.1667 5.65321L5.88889 21.7151L1 23L2.22222 17.8602L17.5 1.79836Z" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Изменить данные
                </button>
            </div>
            <?php
            $sql = "SELECT * FROM `users` WHERE `id_users`='$id'";
            $result = mysqli_query($link, $sql);
        
            if (mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) {
            ?>
            <div class="profile-info_main-box">
                <div class="profile-info_box">
                    <div class="profile-info_img-box">
                        <img src="php/admin/img/<?= $row["photo_profile"] ?>" alt="foto profile">
                    </div>
                    <div class="profile-info-form">
                        <div class="profile-info_info-box">
                            <div class="profile-info_info-user">
                                <div class="profile-info_info-input">
                                    <h3 class="profile-info_label">Имя:</h3>
                                    <p><?= $row["name"] ?></p>
                                    <div class="profile-info_info-input-line"></div>
                                </div>
                                <div class="profile-info_info-input">
                                    <h3 class="profile-info_label">Фамилия:</h3>
                                    <p><?= $row["surname"] ?></p>
                                    <div class="profile-info_info-input-line"></div>
                                </div>
                                <div class="profile-info_info-input">
                                    <h3 class="profile-info_label">Телефон:</h3>
                                    <?php 
                                    $telephone = $row["telephone"]; 
                                    $formattedTelephone = preg_replace('/(\d{1})(\d{3})(\d{3})(\d{2})(\d{2})/', '+$1 ($2) $3-$4-$5', $telephone);
                                    ?>
                                    <p><?= $formattedTelephone ?></p>
                                    <div class="profile-info_info-input-line"></div>
                                </div>
                                <div class="profile-info_info-input">
                                    <h3 class="profile-info_label">email:</h3>
                                    <p><?= $row["email"] ?></p>
                                    <div class="profile-info_info-input-line"></div>
                                </div>
                                <div class="profile-info_info-input">
                                    <h3 class="profile-info_label">Логин:</h3>
                                    <p><?= $row["login"] ?></p>
                                    <div class="profile-info_info-input-line"></div>
                                </div>
                                <div class="profile-info_info-input">
                                    <h3 class="profile-info_label">Страна:</h3>
                                    <p><?= $row["country"] ?></p>
                                    <div class="profile-info_info-input-line"></div>
                                </div>
                                <div class="profile-info_info-input">
                                    <h3 class="profile-info_label">Город:</h3>
                                    <p><?= $row["city"] ?></p>
                                    <div class="profile-info_info-input-line"></div>
                                </div>
                                <div class="profile-info_info-input">
                                    <h3 class="profile-info_label">Дата рождения:</h3>
                                    <p><?= $row["datebd"] ?></p>
                                    <div class="profile-info_info-input-line"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
                <?php
                    $querycourses = "SELECT * FROM `courses`";
                    $coursesResult = mysqli_query($link, $querycourses);
                    
                    if (mysqli_num_rows($coursesResult) > 0) {
                        while($courseRow = mysqli_fetch_assoc($coursesResult)) {
                ?>
                <li class="dropdown-menu_list"><a href="course.php?id=<?= $courseRow['id_courses']; ?>" class="dropdown-menu_link"><?= $courseRow["name"] ?></a></li>
                <?php
                    }
                }
                ?>
            </ul>
            <ul class="dropdown-menu_wrapper" onclick="location.href='contacts.php'">
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
    <section class="container profile-update-password">
        <div class="profile-update-password_box-title">
            <h2 class="profile-update-password_title">Пароль</h2>
            <button class="profile-update-password_arrow" id="toggle-button">
                <svg width="22" height="13" viewBox="0 0 22 13" fill="none" xmlns="http://www.w3.org/2000/svg" id="arrow-icon">
                    <path d="M2 2L11 11L20 2" stroke="black" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg" id="cross-icon" style="display: none;">
                    <path d="M20 2L2 20M2 2L20 20" stroke="black" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </button>
        </div>
        <div class="profile-update-password_box" id="password-box" style="display: none;">
            <div class="profile-update-password_content-static">
                <input type="password" value="<?= $row["password"] ?>" readonly>
                <input type="password" value="<?= $row["password"] ?>" readonly>
                <button class="profile-update-password_button profile-update-password_button-text" id="edit-button">Изменить пароль</button>
            </div>
            <div class="profile-update-password_content-dynamic">
                <form action="php/handler/obr_update_pass.php" method="POST" id="update_pass" class="profile-update-password_form">
                    <input type="password" name="oldPassword" placeholder="Введите старый пароль" class="profile-update-password_content-dynamic-input" required>
                    <input type="password" name="newPassword" placeholder="Введите новый пароль" class="profile-update-password_content-dynamic-input" required>
                    <input type="password" name="confirmPassword" placeholder="Повторите новый пароль" class="profile-update-password_content-dynamic-input" required>
                    <input type="hidden" name="idd" value="<?= $row["id_users"] ?>">
                    <input class="profile-update-password_button profile-update-password_button-text" type="submit" name="update" value="Сохранить пароль"/>
                    <a class="profile-update-password_button-two profile-update-password_button-text-two" id="cancel-button">Отменить</a>
                </form>
            </div>
        </div>
        <div class="profile-update-password_line"></div>
    </section>
    <?php
            }
        }
    ?>
    <section class="container profile-delete">
        <div class="profile-delete_box-title">
            <h2 class="profile-delete_title">Удаление аккаунта</h2>
            <button class="profile-delete_arrow" id="toggle-button-two">
                <svg width="22" height="13" viewBox="0 0 22 13" fill="none" xmlns="http://www.w3.org/2000/svg" id="arrow-icon-two">
                    <path d="M2 2L11 11L20 2" stroke="black" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg" id="cross-icon-two" style="display: none;">
                    <path d="M20 2L2 20M2 2L20 20" stroke="black" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </button>
        </div>
        <div class="profile-delete_box" id="delete-box" style="display: none;">
            <div class="profile-delete_content-static">
                <p class="profile-delete_text">Уважаемый студент, обращаем внимание, что при удалении аккаунта:</p>
                <ul class="profile-delete_list">
                    <li class="profile-delete_li">все личные данные, включая информацию о прохождении курсов, предпочтения, будут удалены;</li>
                    <li class="profile-delete_li">вы потеряете возможность восстановления аккаунта в будущем, если вам понадобится доступ к обучающим материалам;</li>
                    <li class="profile-delete_li">вы потеряете доступ к материалам курсов.</li>
                </ul>
                <p class="profile-delete_text">Восстановление аккаунта в дальнейшем будет невозможным.</p>
                <p class="profile-delete_text">Чтобы удалить ваш аккаунт и все связанные с ним действия, нажмите на кнопку ниже или обратитесь по бесплатному номеру 8 (800) 700-88-66 в Единую службу информации, и наши операторы помогут вам удалить аккаунт.</p>
                <form action="php/handler/delete_profile.php" method="POST" class="profile-delete_box-button" onsubmit="return confirm('Вы точно хотите удалить профиль?')">
                    <button type="submit" class="profile-delete_button profile-delete_button-text">Удалить профиль</button>
                </form>
            </div>
        </div>
        <div class="profile-delete_line"></div>
    </section>
    <section class="container profile-courses">
        <div class="profile-courses_box">
            <div class="profile-courses_namebox">
                <h2 class="profile-courses_title">Мои курсы:</h2>
            </div>
            <div class="profile-courses_buttonbox">
                <button class="profile-courses_button profile-courses_active current-courses">Текущие</button>
                <button class="profile-courses_button profile-courses_noactive completed-courses">Пройденные</button>
            </div>
            <div class="profile-courses_search-container">
                <input type="text" id="searchInput" class="profile-courses_searchText" placeholder="Введите название курса">
                <span class="profile-courses_search-icon">
                    <img src="image/elements/search-icon.svg" alt="search">
                </span>
            </div>
        </div>
        <div class="profile-courses_result">
        <p class="no-courses-message profile-courses_not-found" style="display: none;">Нет пройденных курсов</p>
            <div class="profile-courses_result-course">
                <?php
                $sqlPassingCourse = "
                        SELECT 
                            courses.id_courses AS course_id,
                            courses.name AS course_name,
                            IFNULL(ROUND(user_course_progress.completed_sections / user_course_progress.total_sections * 100), 0) AS progress_percent
                        FROM 
                            user_course_progress
                        JOIN courses ON user_course_progress.id_course = courses.id_courses
                        LEFT JOIN course_registration ON course_registration.id_course = courses.id_courses AND course_registration.id_user = user_course_progress.id_user
                        WHERE 
                            user_course_progress.id_user = $id 
                            AND course_registration.application_status = 'approved'";
                
                $resultPassingCourse = mysqli_query($link, $sqlPassingCourse);
                
                if ($resultPassingCourse->num_rows > 0) {
                  while($row = $resultPassingCourse->fetch_assoc()) {
                ?>
                <div class="profile-courses_coursebox" onclick="location.href='course_sections.php?id=<?= $row['course_id']; ?>'">
                    <div class="profile-courses_coursemain">
                        <h3 class="profile-courses_course-name"><?= $row["course_name"] ?></h3>
                        <div class="profile-courses_course-openbox">
                            <p class="profile-courses_course-procent">
                                <span class="profile-courses_procent-now"><?= $row["progress_percent"] ?>%</span> / 100%
                            </p>
                            <div class="profile-courses_additional-more-detailed-box">
                                    <p class="profile-courses_additional-more-detailed-text">перейти</p>
                                    <img src="image/elements/pixelarticons_arrow-left-blue.svg" alt="arrow more detailed" class="profile-courses_additional-more-detailed-arrow">
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                }
                    } else {
                ?>
                <p class="profile-courses_not-found">Пока нет курсов</p>
                <?php
                }
                ?>
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
    <script src="js/profile-list.js"></script>
    <script src="js/errors.js"></script>
    <script src="js/filterCourses.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
    <script>
        document.getElementById('searchInput').addEventListener('input', function() {
            var searchText = this.value; // Получаем содержимое поля ввода поиска
            // Отправляем асинхронный запрос на сервер для получения результатов поиска
            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'php/handler/search_courses.php?search=' + searchText, true);
            xhr.onload = function() {
                if(xhr.status === 200) {
                    // Обновляем содержимое блока результатов поиска
                    document.querySelector('.profile-courses_result-course').innerHTML = xhr.responseText;
                }
            };
            xhr.send();
        });
    </script>
</body>
</html>