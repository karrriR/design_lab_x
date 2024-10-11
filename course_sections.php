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
    <title>Курс "веб-дизайнер"</title>
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
    <section class="container course-sections-list">
        <?php
            $idCourse = $_GET["id"];
            $sqlcompleted = "SELECT `completed_sections`, `total_sections` FROM `user_course_progress` WHERE `id_course`='$idCourse' AND `id_user` = '$id'";
            $resultcompleted = mysqli_query($link, $sqlcompleted);
        
            if (mysqli_num_rows($resultcompleted) > 0) {
                while($rowcompleted = mysqli_fetch_assoc($resultcompleted)) {
        ?>
        <h1 class="course-sections-list_title">Курс “веб-дизайнер”</h1>
        <div class="course-sections-list_box-name">
            <h2 class="course-sections-list_box-name-title">Разделы:</h2>
            <div class="course-sections-list_box-counter">
                <p class="course-sections-list_counter-text">
                    <span class="course-sections-list_counter-over"><?= $rowcompleted["completed_sections"] ?></span> / <?= $rowcompleted["total_sections"] ?>
                </p>
            </div>
        </div>
        <?php
                }
            }
            ?>
        <div class="course-sections-list_box-main">
        <?php
        $sqlSections = "SELECT * FROM `course_sections` WHERE `id_course`='$idCourse'";
        $resultSections = mysqli_query($link, $sqlSections);

        if (mysqli_num_rows($resultSections) > 0) {
            while($rowSection = mysqli_fetch_assoc($resultSections)) {
                $idCourseSection = $rowSection['id_course_sections'];
                $sqlSectionProgress = "SELECT `section_completed` FROM `user_section_progress` WHERE `id_section` = '$idCourseSection' AND `id_user` = '$id'";
                $resultSectionProgress = mysqli_query($link, $sqlSectionProgress);

                $backgroundColor = '#EBEBEB';
                $svgFillColor = '#5C59FF';
                $sectionResultText = 'тема не пройдена';

                if (mysqli_num_rows($resultSectionProgress) > 0) {
                    $rowSectionProgress = mysqli_fetch_assoc($resultSectionProgress);
                    if($rowSectionProgress['section_completed'] == 1) {
                        $backgroundColor = '#E5E3FF';
                        $svgFillColor = '#7823D1';
                        $sectionResultText = 'тема пройдена';
                    }
                }

        ?>
             <div class="course-sections-list_box-section" style="background-color: <?= $backgroundColor ?>">
                <div class="course-sections-list_section-main">
                    <svg width="80" height="76" viewBox="0 0 80 76" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M48.4211 76C44.9123 76 41.9298 74.7685 39.4737 72.3056C37.0175 69.8426 35.7895 66.8519 35.7895 63.3333C35.7895 59.8148 37.0175 56.8241 39.4737 54.3611C41.9298 51.8982 44.9123 50.6667 48.4211 50.6667C51.9298 50.6667 54.9123 51.8982 57.3684 54.3611C59.8246 56.8241 61.0526 59.8148 61.0526 63.3333C61.0526 66.8519 59.8246 69.8426 57.3684 72.3056C54.9123 74.7685 51.9298 76 48.4211 76ZM56.8421 46.4444C50.386 46.4444 44.9123 44.1926 40.4211 39.6889C35.9298 35.1852 33.6842 29.6963 33.6842 23.2222C33.6842 16.7481 35.9298 11.2593 40.4211 6.75556C44.9123 2.25185 50.386 0 56.8421 0C63.2982 0 68.7719 2.25185 73.2632 6.75556C77.7544 11.2593 80 16.7481 80 23.2222C80 29.6963 77.7544 35.1852 73.2632 39.6889C68.7719 44.1926 63.2982 46.4444 56.8421 46.4444ZM16.8421 63.3333C12.2105 63.3333 8.24562 61.6796 4.94737 58.3722C1.64912 55.0648 0 51.0889 0 46.4444C0 41.8 1.64912 37.8241 4.94737 34.5167C8.24562 31.2093 12.2105 29.5556 16.8421 29.5556C21.4737 29.5556 25.4386 31.2093 28.7368 34.5167C32.0351 37.8241 33.6842 41.8 33.6842 46.4444C33.6842 51.0889 32.0351 55.0648 28.7368 58.3722C25.4386 61.6796 21.4737 63.3333 16.8421 63.3333Z" fill="<?= $svgFillColor ?>"/>
                    </svg>
                    <div class="course-sections-list_section-namebox">
                        <h3 class="course-sections-list_section-title"><?= $rowSection["name"] ?></h3>
                        <p class="course-sections-list_section-result" style="color: <?= $svgFillColor ?>"><?= $sectionResultText ?></p>
                    </div>
                    <div class="course-sections-list_additional-more-detailed-box" onclick="location.href='section.php?id=<?= $rowSection['id_course_sections']; ?>'">
                        <p class="course-sections-list_additional-more-detailed-text">перейти</p>
                        <svg width="31" height="31" viewBox="0 0 31 31" fill="none" xmlns="http://www.w3.org/2000/svg" class="course-sections-list_additional-more-detailed-arrow"> 
                            <path d="M5.16683 16.7917V14.2084L20.6668 14.2084V11.6251H23.2502V14.2084H25.8335V16.7917H23.2502V19.3751H20.6668V16.7917L5.16683 16.7917ZM18.0835 21.9584H20.6668V19.3751H18.0835V21.9584ZM18.0835 21.9584H15.5002V24.5417H18.0835V21.9584ZM18.0835 9.04175L20.6668 9.04175V11.6251L18.0835 11.6251V9.04175ZM18.0835 9.04175H15.5002V6.45841H18.0835V9.04175Z" fill="<?= $svgFillColor ?>"/>
                        </svg>
                    </div>
                </div>
            </div>
            <?php
                }
            }
            ?>
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
    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
</body>
</html>