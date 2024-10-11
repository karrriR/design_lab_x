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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <link rel="icon" type="image/x-icon" href="image/elements/x-logo.svg">
    <title>Курс по дизайну | Design Lab X</title>
    <meta name="description" content="Изучайте удивительные курсы по дизайну в онлайн-школе Design Lab X. Получите знания и навыки, необходимые для успешной карьеры в области дизайна." />
    <meta name="keywords" content="дизайн, курсы, онлайн-школа, обучение, навыки, Design Lab X" />
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
        <?php
            $idC = $_GET["id"];
            $sql = "SELECT * FROM `courses` WHERE `id_courses`='$idC'";
            $result = mysqli_query($link, $sql);
        
            if (mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) {
                    $date_from_db = $row["date_begin"];
                    $date = new DateTime($date_from_db);
                    $formatted_date = $date->format('j F');
                    $russian_months = [
                        'January' => 'января',
                        'February' => 'февраля',
                        'March' => 'марта',
                        'April' => 'апреля',
                        'May' => 'мая',
                        'June' => 'июня',
                        'July' => 'июля',
                        'August' => 'августа',
                        'September' => 'сентября',
                        'October' => 'октября',
                        'November' => 'ноября',
                        'December' => 'декабря'
                    ];

                    $russian_date = strtr($formatted_date, $russian_months);
        ?>
        <div class="container-two course-info">
            <div class="course-info_main-box">
                <h1 class="course-info_title">Профессия <br> <?= $row["name"] ?></h1>
                <p class="course-info_text"><?= $row["long_description"] ?></p>
                <button class="course-info_button course-info_button-text" onclick="scrollToTarget()">Записаться на курс</button>
            </div>
        </div>
        <div class="container course-aditional-info">
            <div class="course-aditional-info_button-box">
                <button class="course-aditional-info_button course-aditional-info_button-text">Длительность</button>
                <button class="course-aditional-info_button-two course-aditional-info_button-text-two"><?= $row["duration"] ?></button>
            </div>
            <div class="course-aditional-info_button-box">
                <button class="course-aditional-info_button course-aditional-info_button-text">Старт</button>
                <button class="course-aditional-info_button-two course-aditional-info_button-text-two"><?= $russian_date ?></button>
            </div>
            <div class="course-aditional-info_button-box">
                <button class="course-aditional-info_button course-aditional-info_button-text">Формат</button>
                <button class="course-aditional-info_button-two course-aditional-info_button-text-two"><?= $row["format_course"] ?></button>
            </div>
            <div class="course-aditional-info_button-box">
                <button class="course-aditional-info_button course-aditional-info_button-text">Занятость</button>
                <button class="course-aditional-info_button-two course-aditional-info_button-text-two"><?= $row["busyness"] ?></button>
            </div>
        </div>
        <?php
                }
            }
        ?>
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
    <section class="container section-study-programme">
        <h2 class="section-study-programme_title">Программа обучения</h2>
        <div class="section-study-programme_box">
            <div class="section-study-programme_programme-box">
                <div class="section-study-programme_programme-name-box">
                    <h3 class="section-study-programme_programme-name">figma</h3>
                    <div class="section-study-programme_programme-add-box">
                        <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg" class="section-study-programme_close">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M15 17.6513L21.6287 24.2813C21.9805 24.633 22.4576 24.8306 22.955 24.8306C23.4524 24.8306 23.9295 24.633 24.2812 24.2813C24.633 23.9295 24.8306 23.4525 24.8306 22.955C24.8306 22.4576 24.633 21.9805 24.2812 21.6288L17.65 15L24.28 8.37127C24.4541 8.1971 24.5922 7.99035 24.6863 7.76282C24.7805 7.5353 24.829 7.29145 24.8289 7.0452C24.8288 6.79895 24.7803 6.55512 24.686 6.32764C24.5917 6.10016 24.4535 5.89347 24.2794 5.71939C24.1052 5.54531 23.8985 5.40723 23.6709 5.31305C23.4434 5.21887 23.1996 5.17042 22.9533 5.17048C22.7071 5.17054 22.4632 5.2191 22.2357 5.31339C22.0083 5.40768 21.8016 5.54585 21.6275 5.72002L15 12.3488L8.37124 5.72002C8.19836 5.54085 7.99154 5.39792 7.76283 5.29954C7.53411 5.20117 7.2881 5.14933 7.03914 5.14705C6.79018 5.14477 6.54326 5.1921 6.31279 5.28626C6.08232 5.38043 5.8729 5.51956 5.69677 5.69552C5.52064 5.87149 5.38132 6.08077 5.28693 6.31115C5.19255 6.54154 5.14499 6.78841 5.14704 7.03738C5.14908 7.28634 5.20069 7.5324 5.29885 7.7612C5.397 7.99 5.53975 8.19697 5.71874 8.37002L12.35 15L5.71999 21.6288C5.36825 21.9805 5.17064 22.4576 5.17064 22.955C5.17064 23.4525 5.36825 23.9295 5.71999 24.2813C6.07174 24.633 6.5488 24.8306 7.04624 24.8306C7.54368 24.8306 8.02075 24.633 8.37249 24.2813L15 17.65V17.6513Z" fill="black"/>
                        </svg>
                    </div>
                </div>
                <div class="section-study-programme_main-info">
                    <p class="section-study-programme_main-info-text">Программа обучения включает в себя освоение редактора Figma — мощного инструмента для дизайна интерфейсов. 
                        Студенты будут изучать основы создания макетов, прототипирования и совместной работы в Figma, а также углубляться в темы организации рабочего процесса и 
                        создания анимированных прототипов. Наша программа дает возможность студентам получить навыки, необходимые для успешной карьеры в области UX/UI дизайна.</p>
                    <h3 class="section-study-programme_main-info-title">Почему Figma так популярен?</h3>
                    <p class="section-study-programme_main-info-text">Изучение Figma полезно из-за его широкой популярности в индустрии дизайна интерфейсов. Figma предоставляет
                        мощные инструменты для создания и прототипирования дизайна, а также позволяет легко совместно работать над проектами. Зная Figma, вы сможете легко 
                        взаимодействовать с другими дизайнерами и разработчиками, улучшая свою эффективность и профессионализм. Благодаря облачной инфраструктуре Figma, вы 
                        можете работать над проектами с любого устройства в реальном времени, что делает его незаменимым инструментом для современных дизайнеров.</p>
                    <h3 class="section-study-programme_main-info-title">Темы:</h3>
                    <ul class="section-study-programme_main-info-list">
                        <li>Введение в Figma</li>
                        <li>Работа с макетами и элементами в Figma</li>
                        <li>Коллаборация и работа в команде в Figma</li>
                        <li>Работа с сеткой и адаптивный дизайн в Figma</li>
                        <li>Итоговый тест по теме</li>
                    </ul>
                </div>
            </div>
            <div class="section-study-programme_programme-box">
                <div class="section-study-programme_programme-name-box">
                    <h3 class="section-study-programme_programme-name">Основы дизайна</h3>
                    <div class="section-study-programme_programme-add-box">
                        <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg" class="section-study-programme_close">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M15 17.6513L21.6287 24.2813C21.9805 24.633 22.4576 24.8306 22.955 24.8306C23.4524 24.8306 23.9295 24.633 24.2812 24.2813C24.633 23.9295 24.8306 23.4525 24.8306 22.955C24.8306 22.4576 24.633 21.9805 24.2812 21.6288L17.65 15L24.28 8.37127C24.4541 8.1971 24.5922 7.99035 24.6863 7.76282C24.7805 7.5353 24.829 7.29145 24.8289 7.0452C24.8288 6.79895 24.7803 6.55512 24.686 6.32764C24.5917 6.10016 24.4535 5.89347 24.2794 5.71939C24.1052 5.54531 23.8985 5.40723 23.6709 5.31305C23.4434 5.21887 23.1996 5.17042 22.9533 5.17048C22.7071 5.17054 22.4632 5.2191 22.2357 5.31339C22.0083 5.40768 21.8016 5.54585 21.6275 5.72002L15 12.3488L8.37124 5.72002C8.19836 5.54085 7.99154 5.39792 7.76283 5.29954C7.53411 5.20117 7.2881 5.14933 7.03914 5.14705C6.79018 5.14477 6.54326 5.1921 6.31279 5.28626C6.08232 5.38043 5.8729 5.51956 5.69677 5.69552C5.52064 5.87149 5.38132 6.08077 5.28693 6.31115C5.19255 6.54154 5.14499 6.78841 5.14704 7.03738C5.14908 7.28634 5.20069 7.5324 5.29885 7.7612C5.397 7.99 5.53975 8.19697 5.71874 8.37002L12.35 15L5.71999 21.6288C5.36825 21.9805 5.17064 22.4576 5.17064 22.955C5.17064 23.4525 5.36825 23.9295 5.71999 24.2813C6.07174 24.633 6.5488 24.8306 7.04624 24.8306C7.54368 24.8306 8.02075 24.633 8.37249 24.2813L15 17.65V17.6513Z" fill="black"/>
                        </svg>
                    </div>
                </div>
                <div class="section-study-programme_main-info">
                    <p class="section-study-programme_main-info-text">Раздел "Основы дизайна" предназначен для ознакомления студентов с основными принципами дизайна интерфейсов. 
                        В этом разделе вы узнаете о важности композиции, типографики, цветовых решений и визуальной грамотности в создании удобных и привлекательных интерфейсов.</p>
                    <h3 class="section-study-programme_main-info-title">Почему важно изучать основы дизайна?</h3>
                    <p class="section-study-programme_main-info-text">Изучение основ дизайна важно для понимания принципов, создания удобных интерфейсов, соответствия 
                        требованиям рынка и улучшения взаимодействия в команде. Это формирует креативное мышление и помогает развивать профессиональный потенциал в области UX/UI дизайна.</p>
                    <h3 class="section-study-programme_main-info-title">Темы:</h3>
                    <ul class="section-study-programme_main-info-list">
                        <li>Введение в основы дизайна</li>
                        <li>Макетирование и композиция</li>
                        <li>Визуальные элементы интерфейса</li>
                        <li>Итоговый тест по теме</li>
                    </ul>
                </div>
            </div>
            <div class="section-study-programme_programme-box">
                <div class="section-study-programme_programme-name-box">
                    <h3 class="section-study-programme_programme-name">погружение в ux</h3>
                    <div class="section-study-programme_programme-add-box">
                        <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg" class="section-study-programme_close">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M15 17.6513L21.6287 24.2813C21.9805 24.633 22.4576 24.8306 22.955 24.8306C23.4524 24.8306 23.9295 24.633 24.2812 24.2813C24.633 23.9295 24.8306 23.4525 24.8306 22.955C24.8306 22.4576 24.633 21.9805 24.2812 21.6288L17.65 15L24.28 8.37127C24.4541 8.1971 24.5922 7.99035 24.6863 7.76282C24.7805 7.5353 24.829 7.29145 24.8289 7.0452C24.8288 6.79895 24.7803 6.55512 24.686 6.32764C24.5917 6.10016 24.4535 5.89347 24.2794 5.71939C24.1052 5.54531 23.8985 5.40723 23.6709 5.31305C23.4434 5.21887 23.1996 5.17042 22.9533 5.17048C22.7071 5.17054 22.4632 5.2191 22.2357 5.31339C22.0083 5.40768 21.8016 5.54585 21.6275 5.72002L15 12.3488L8.37124 5.72002C8.19836 5.54085 7.99154 5.39792 7.76283 5.29954C7.53411 5.20117 7.2881 5.14933 7.03914 5.14705C6.79018 5.14477 6.54326 5.1921 6.31279 5.28626C6.08232 5.38043 5.8729 5.51956 5.69677 5.69552C5.52064 5.87149 5.38132 6.08077 5.28693 6.31115C5.19255 6.54154 5.14499 6.78841 5.14704 7.03738C5.14908 7.28634 5.20069 7.5324 5.29885 7.7612C5.397 7.99 5.53975 8.19697 5.71874 8.37002L12.35 15L5.71999 21.6288C5.36825 21.9805 5.17064 22.4576 5.17064 22.955C5.17064 23.4525 5.36825 23.9295 5.71999 24.2813C6.07174 24.633 6.5488 24.8306 7.04624 24.8306C7.54368 24.8306 8.02075 24.633 8.37249 24.2813L15 17.65V17.6513Z" fill="black"/>
                        </svg>
                    </div>
                </div>
                <div class="section-study-programme_main-info">
                    <p class="section-study-programme_main-info-text">Раздел "Погружение в UX" представляет собой комплексное введение в область пользовательского опыта (UX) и его 
                        влияние на дизайн интерфейсов. В этом разделе вы узнаете о ключевых принципах UX, методах и инструментах, которые помогают создавать удобные и привлекательные 
                        пользовательские интерфейсы. <br> Изучение этого раздела важно, поскольку понимание UX позволяет создавать продукты и сервисы, которые удовлетворяют потребности 
                        пользователей, повышая их уровень удовлетворенности и лояльности. Изучение "Погружение в UX" поможет вам освоить основные концепции и инструменты, необходимые 
                        для разработки эффективных пользовательских интерфейсов, а также 
                        лучше понять, как важен пользовательский опыт для успеха любого продукта или сервиса.</p>
                    <h3 class="section-study-programme_main-info-title">Темы:</h3>
                    <ul class="section-study-programme_main-info-list">
                        <li>Основы UX-дизайна</li>
                        <li>Информационная архитектура</li>
                        <li>UX и UI дизайн</li>
                        <li>Инструменты для UX-дизайна</li>
                        <li>Итоговый тест по теме</li>
                    </ul>
                </div>
            </div>
            <div class="section-study-programme_programme-box">
                <div class="section-study-programme_programme-name-box">
                    <h3 class="section-study-programme_programme-name">3d-графика в blender</h3>
                    <div class="section-study-programme_programme-add-box">
                        <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg" class="section-study-programme_close">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M15 17.6513L21.6287 24.2813C21.9805 24.633 22.4576 24.8306 22.955 24.8306C23.4524 24.8306 23.9295 24.633 24.2812 24.2813C24.633 23.9295 24.8306 23.4525 24.8306 22.955C24.8306 22.4576 24.633 21.9805 24.2812 21.6288L17.65 15L24.28 8.37127C24.4541 8.1971 24.5922 7.99035 24.6863 7.76282C24.7805 7.5353 24.829 7.29145 24.8289 7.0452C24.8288 6.79895 24.7803 6.55512 24.686 6.32764C24.5917 6.10016 24.4535 5.89347 24.2794 5.71939C24.1052 5.54531 23.8985 5.40723 23.6709 5.31305C23.4434 5.21887 23.1996 5.17042 22.9533 5.17048C22.7071 5.17054 22.4632 5.2191 22.2357 5.31339C22.0083 5.40768 21.8016 5.54585 21.6275 5.72002L15 12.3488L8.37124 5.72002C8.19836 5.54085 7.99154 5.39792 7.76283 5.29954C7.53411 5.20117 7.2881 5.14933 7.03914 5.14705C6.79018 5.14477 6.54326 5.1921 6.31279 5.28626C6.08232 5.38043 5.8729 5.51956 5.69677 5.69552C5.52064 5.87149 5.38132 6.08077 5.28693 6.31115C5.19255 6.54154 5.14499 6.78841 5.14704 7.03738C5.14908 7.28634 5.20069 7.5324 5.29885 7.7612C5.397 7.99 5.53975 8.19697 5.71874 8.37002L12.35 15L5.71999 21.6288C5.36825 21.9805 5.17064 22.4576 5.17064 22.955C5.17064 23.4525 5.36825 23.9295 5.71999 24.2813C6.07174 24.633 6.5488 24.8306 7.04624 24.8306C7.54368 24.8306 8.02075 24.633 8.37249 24.2813L15 17.65V17.6513Z" fill="black"/>
                        </svg>
                    </div>
                </div>
                <div class="section-study-programme_main-info">
                    <p class="section-study-programme_main-info-text">Раздел "3D-графика в Blender" предоставляет уникальную возможность погрузиться в захватывающий мир трехмерного моделирования 
                        и анимации с использованием популярного инструмента Blender. В течение трех лекций вы получите фундаментальные знания и практические навыки работы с 3D-графикой, начиная 
                        с основ моделирования и текстурирования и заканчивая созданием анимированных сцен и рендерингом.</p>
                    <h3 class="section-study-programme_main-info-title">Темы:</h3>
                    <ul class="section-study-programme_main-info-list">
                        <li>Введение в Blender и основные принципы 3D-моделирования </li>
                        <li>Текстурирование и материалы в Blender</li>
                        <li>Анимация и рендеринг в Blender</li>
                        <li>Итоговый тест по теме</li>
                    </ul>
                </div>
            </div>
            <div class="section-study-programme_programme-box">
                <div class="section-study-programme_programme-name-box">
                    <h3 class="section-study-programme_programme-name">портфолио, фриланс, менеджмент</h3>
                    <div class="section-study-programme_programme-add-box">
                        <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg" class="section-study-programme_close">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M15 17.6513L21.6287 24.2813C21.9805 24.633 22.4576 24.8306 22.955 24.8306C23.4524 24.8306 23.9295 24.633 24.2812 24.2813C24.633 23.9295 24.8306 23.4525 24.8306 22.955C24.8306 22.4576 24.633 21.9805 24.2812 21.6288L17.65 15L24.28 8.37127C24.4541 8.1971 24.5922 7.99035 24.6863 7.76282C24.7805 7.5353 24.829 7.29145 24.8289 7.0452C24.8288 6.79895 24.7803 6.55512 24.686 6.32764C24.5917 6.10016 24.4535 5.89347 24.2794 5.71939C24.1052 5.54531 23.8985 5.40723 23.6709 5.31305C23.4434 5.21887 23.1996 5.17042 22.9533 5.17048C22.7071 5.17054 22.4632 5.2191 22.2357 5.31339C22.0083 5.40768 21.8016 5.54585 21.6275 5.72002L15 12.3488L8.37124 5.72002C8.19836 5.54085 7.99154 5.39792 7.76283 5.29954C7.53411 5.20117 7.2881 5.14933 7.03914 5.14705C6.79018 5.14477 6.54326 5.1921 6.31279 5.28626C6.08232 5.38043 5.8729 5.51956 5.69677 5.69552C5.52064 5.87149 5.38132 6.08077 5.28693 6.31115C5.19255 6.54154 5.14499 6.78841 5.14704 7.03738C5.14908 7.28634 5.20069 7.5324 5.29885 7.7612C5.397 7.99 5.53975 8.19697 5.71874 8.37002L12.35 15L5.71999 21.6288C5.36825 21.9805 5.17064 22.4576 5.17064 22.955C5.17064 23.4525 5.36825 23.9295 5.71999 24.2813C6.07174 24.633 6.5488 24.8306 7.04624 24.8306C7.54368 24.8306 8.02075 24.633 8.37249 24.2813L15 17.65V17.6513Z" fill="black"/>
                        </svg>
                    </div>
                </div>
                <div class="section-study-programme_main-info">
                    <p class="section-study-programme_main-info-text">"Портфолио, фриланс, менеджмент" - это раздел курса, который предназначен для освоения ключевых навыков, необходимых веб-дизайнеру
                        для успешного развития карьеры и управления своей деятельностью. В этом разделе студенты узнают, как создавать профессиональное портфолио, привлекать клиентов на фрилансе и 
                        эффективно управлять своими проектами. <br>
                        Через серию лекций и практических материалов учащиеся узнают, как эффективно представить свои работы в портфолио и какие элементы привлекут наибольшее внимание потенциальных 
                        работодателей или клиентов. Они также изучат стратегии поиска заказов на фрилансе, включая взаимодействие с клиентами и заключение договоров.</p>
                    <h3 class="section-study-programme_main-info-title">Почему важно знать такие вещи?</h3>
                    <p class="section-study-programme_main-info-text">Важно знать навыки создания профессионального портфолио, привлечения клиентов на фрилансе и управления проектами, потому что эти 
                        навыки необходимы для успешной карьеры веб-дизайнера. Создание убедительного портфолио поможет привлечь потенциальных работодателей или клиентов, а умение привлекать клиентов
                        на фрилансе открывает новые возможности для работы и заработка.</p>
                    <h3 class="section-study-programme_main-info-title">Темы:</h3>
                    <ul class="section-study-programme_main-info-list">
                        <li>Составление успешного портфолио веб-дизайнера</li>
                        <li>Фриланс в веб-дизайне: поиск заказов и работа с клиентами</li>
                        <li>Управление проектами и временем в веб-дизайне</li>
                        <li>Итоговый тест по теме</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <section class="container section-record-form">
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
        <div class="section-record-form_box">
            <div class="section-record-form_main">
                <div class="section-record-form_text-box">
                    <h2 class="section-record-form_title">Запишитесь на онлайн-курс Design Lab X!</h2>
                    <p class="section-record-form_text">Design Lab X предлагает интенсивные курсы по различным направлениям дизайна. Заполните форму ниже, чтобы записаться на один из наших курсов.</p>
                </div>
                <div class="section-record-form_formbox">
                    <form action="php/handler/registration_course_obr.php" method="POST" class="section-record-form_form-main" id="forma_record">
                    <input type="hidden" name="id_course" value="<?= $idC ?>"/>    
                    <div class="section-record-form_input-box">
                            <input type="text" name="name" placeholder="Введите ваше имя" required>
                            <input type="email" name="email" placeholder="Введите ваш email" required>
                            <input type="tel" name="tel" id="phone" placeholder="Введите ваш телефон" required> 
                        </div>
                        <div class="section-record-form_rate-box">
                            <p class="section-record-form_rate-title">Тариф:</p>
                            <div class="section-record-form_rate">
                                <input type="radio" id="basic" name="rate" value="basic">
                                <label for="basic">Базовый</label>
                            </div>
                            <div class="section-record-form_rate">
                                <input type="radio" id="optimal" name="rate" value="optimal">
                                <label for="optimal">Оптимальный</label>
                            </div>
                            <div class="section-record-form_rate">
                                <input type="radio" id="vip" name="rate" value="vip">
                                <label for="vip">VIP</label>
                            </div>
                        </div>
                        <div class="section-record-form_personal-data">
                            <input type="checkbox" class="section-record-form_personal-data-checkbox" name="personal-data" required/>
                            <label class="section-record-form_personal-data-label" for="personal-data">Нажимая, вы даете согласие на обработку своих персональных данных</label>
                        </div>
                        <input class="section-record-form_personal-data-button section-record-form_personal-data-button-text" type="submit" name="registration_course" value="Записаться на курс"/>
                    </form>
                    <script>
                        $(document).ready(function(){
                        $('#phone').mask("+7 (999) 999-99-99");

                        $('#forma_record').submit(function(event) {
                            var phoneInput = $('#phone').val();
                            var phoneNumber = phoneInput.replaceAll(/\D+/g, '');
                            $('#phone').val(phoneNumber);         
                        });
                        });
                    </script>
                </div>
            </div>
        </div>
    </section>
    <section class="container section-rates">
        <div class="section-rates_title-box">
            <h2 class="section-rates_title">Выберите тариф, который поможет вам получить максимум пользы от обучения</h2>
            <p class="section-rates_text">В течение короткого времени после получения вашего запроса, наш менеджер свяжется с вами, чтобы обсудить подробности и предоставить все необходимые сведения о наших условиях.</p>
        </div>
        <div class="section-rates_rates-box">
            <div class="section-rates_rate-box">
                <div class="section-rates_rate-start">
                    <h3 class="section-rates_rate-title">Базовый</h3>
                    <ul class="section-rates_rate-list">
                        <li class="section-rates_rate-row">Обратная связь по темам курса и заданиям от менторов</li>
                        <li class="section-rates_rate-row">Интерактивные вебинары</li>
                        <li class="section-rates_rate-row">Помощь и техническая поддержка от координаторов</li>
                        <li class="section-rates_rate-row">Закрытое комьюнити в мессенджер</li>
                        <li class="section-rates_rate-row">Доступ к материалам курса и обновлениям навсегда</li>
                    </ul>
                    <h4 class="section-rates_rate-bonus-title">Бонус</h4>
                    <ul class="section-rates_rate-bonus-list">
                        <li class="section-rates_rate-bonus-row">Программа трудоустройства</li>
                    </ul>
                </div>
                <div class="section-rates_rate-end">
                    <div class="section-rates_rate-price-box">
                        <p class="section-rates_rate-old-price">6 813  ₽ / мес</p>
                        <p class="section-rates_rate-new-price"><span class="section-rates_rate-new-price-span">3 406</span> ₽ / месяц <br><span class="section-rates_rate-installment">при рассрочке на 24 месяца</span></p>
                    </div>
                    <div class="section-rates_rate-button-box">
                        <button class="section-rates_rate-button section-rates_rate-button-text" value="basic">Выбрать базовый тариф</button>
                    </div>
                </div>
            </div>
            <div class="section-rates_rate-boxx">
                <div class="section-rates_rate-popular-box">
                    <button class="section-rates_rate-popular-button section-rates_rate-popular-button-text">Самый популярный</button>
                </div>
                <div class="section-rates_rate-box">
                    <div class="section-rates_rate-start">
                        <h3 class="section-rates_rate-title section-rates_rate-popular-title">Оптимальный</h3>
                        <ul class="section-rates_rate-list">
                            <li class="section-rates_rate-row">Все опции базового тарифа</li>
                            <li class="section-rates_rate-row">Дополнительный курс по программе Adobe Photoshop</li>
                        </ul>
                        <h4 class="section-rates_rate-bonus-title">Бонус</h4>
                        <ul class="section-rates_rate-bonus-list">
                            <li class="section-rates_rate-bonus-row">8 индивидуальных часовых консультаций с ментором</li>
                            <li class="section-rates_rate-bonus-row">Групповые практические онлайн-воркшопы</li>
                            <li class="section-rates_rate-bonus-row">Тестовое собеседование с экспертом в дизайне</li>
                            <li class="section-rates_rate-bonus-row">Разбор портфолио</li>
                            <li class="section-rates_rate-bonus-row">Ревью резюме</li>
                        </ul>
                    </div>
                    <div class="section-rates_rate-end">
                        <div class="section-rates_rate-price-box">
                            <p class="section-rates_rate-old-price">10 031  ₽ / мес</p>
                            <p class="section-rates_rate-new-price"><span class="section-rates_rate-new-price-span">5 015</span> ₽ / месяц <br><span class="section-rates_rate-installment">при рассрочке на 24 месяца</span></p>
                        </div>
                        <div class="section-rates_rate-button-box">
                            <button class="section-rates_rate-button section-rates_rate-button-text section-rates_rate-popular-button" value="optimal">Выбрать оптимальный тариф</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="section-rates_rate-box">
                <div class="section-rates_rate-start">
                    <h3 class="section-rates_rate-title">VIP</h3>
                    <ul class="section-rates_rate-list">
                        <li class="section-rates_rate-row">Все опции базового и оптимального тарифов</li>
                        <li class="section-rates_rate-row">Дополнительный курс по продвинутому функционалу Blender</li>
                    </ul>
                    <h4 class="section-rates_rate-bonus-title">Бонус</h4>
                    <ul class="section-rates_rate-bonus-list">
                        <li class="section-rates_rate-bonus-row">Еженедельные созвоны, ответы на любые вопросы по теории и практике</li>
                        <li class="section-rates_rate-bonus-row">Совместная работа с ментором над вашим проектом онлайн</li>
                        <li class="section-rates_rate-bonus-row">2 индивидуальные консультации с топовыми экспертами рынка</li>
                        <li class="section-rates_rate-bonus-row">Дополнительная карьерная консультация</li>
                    </ul>
                </div>
                <div class="section-rates_rate-end">
                    <div class="section-rates_rate-price-box">
                        <p class="section-rates_rate-old-price">22 500  ₽ / мес</p>
                        <p class="section-rates_rate-new-price"><span class="section-rates_rate-new-price-span">9 000</span> ₽ / месяц <br><span class="section-rates_rate-installment">при рассрочке на 24 месяца</span></p>
                    </div>
                    <div class="section-rates_rate-button-box">
                        <button class="section-rates_rate-button section-rates_rate-button-text" value="vip">Выбрать VIP тариф</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        $(document).ready(function() {
        $('.section-rates_rate-button').click(function() {
            var selectedRate = $(this).val();

            $('input[name="rate"][value="' + selectedRate + '"]').prop('checked', true);
        });
        });
    </script>
    <section class="section-reviews">
        <h2 class="section-reviews_title">Студенты рекомендуют нас</h2>
        <div class="swiper-container section-reviews_boxs container-two">
            <div class="swiper-wrapper section-reviews_wrapper">
                <div class="section-reviews_box swiper-slide">
                    <div class="section-reviews_box-name">
                        <img src="image/elements/foto1.png" alt="foto" class="section-reviews_img">
                        <button class="section-reviews_button section-reviews_button-text">Виктория Лебедева</button>
                    </div>
                    <div class="section-reviews_box-text">
                        <p class="section-reviews_text">Я очень довольна курсом веб-дизайнера! Этот курс предоставил мне все необходимые знания и навыки, чтобы стать успешным веб-дизайнером. Преподаватели были высококвалифицированными и профессиональными, объясняли материал доступно...</p>
                    </div>
                </div>
                <div class="section-reviews_box swiper-slide">
                    <div class="section-reviews_box-name">
                        <img src="image/elements/foto2.png" alt="foto" class="section-reviews_img">
                        <button class="section-reviews_button section-reviews_button-text">Александра Соколова</button>
                    </div>
                    <div class="section-reviews_box-text">
                        <p class="section-reviews_text">Я очень довольна курсом веб-дизайнера! Этот курс предоставил мне все необходимые знания и навыки, чтобы стать успешным веб-дизайнером. Преподаватели были высококвалифицированными и профессиональными, объясняли материал доступно...</p>
                    </div>
                </div>
                <div class="section-reviews_box swiper-slide">
                    <div class="section-reviews_box-name">
                        <img src="image/elements/foto3.png" alt="foto" class="section-reviews_img">
                        <button class="section-reviews_button section-reviews_button-text">Дмитрий Михайлов</button>
                    </div>
                    <div class="section-reviews_box-text">
                        <p class="section-reviews_text">Я очень довольна курсом веб-дизайнера! Этот курс предоставил мне все необходимые знания и навыки, чтобы стать успешным веб-дизайнером. Преподаватели были высококвалифицированными и профессиональными, объясняли материал доступно...</p>
                    </div>
                </div>
                <div class="section-reviews_box swiper-slide">
                    <div class="section-reviews_box-name">
                        <img src="image/elements/foto1.png" alt="foto" class="section-reviews_img">
                        <button class="section-reviews_button section-reviews_button-text">Виктория Лебедева</button>
                    </div>
                    <div class="section-reviews_box-text">
                        <p class="section-reviews_text">Я очень довольна курсом веб-дизайнера! Этот курс предоставил мне все необходимые знания и навыки, чтобы стать успешным веб-дизайнером. Преподаватели были высококвалифицированными и профессиональными, объясняли материал доступно...</p>
                    </div>
                </div>
                <div class="section-reviews_box swiper-slide">
                    <div class="section-reviews_box-name">
                        <img src="image/elements/foto1.png" alt="foto" class="section-reviews_img">
                        <button class="section-reviews_button section-reviews_button-text">Виктория Лебедева</button>
                    </div>
                    <div class="section-reviews_box-text">
                        <p class="section-reviews_text">Я очень довольна курсом веб-дизайнера! Этот курс предоставил мне все необходимые знания и навыки, чтобы стать успешным веб-дизайнером. Преподаватели были высококвалифицированными и профессиональными, объясняли материал доступно...</p>
                    </div>
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
    <script src="js/programme.js"></script>
    <script src="js/errors.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
    <script>
        if (window.innerWidth >= 768 && window.innerWidth <= 1023) {
          document.write('<script src="js/reviews2.js"><\/script>');
        } else if (window.innerWidth >= 375 && window.innerWidth <= 767) {
          document.write('<script src="js/reviews3.js"><\/script>');
        } else {
          document.write('<script src="js/reviews.js"><\/script>');
        }

        function scrollToTarget() {
            var target = document.getElementById('forma_record');
            target.scrollIntoView({ behavior: 'smooth' });
        }
      </script>
</body>
</html>