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
    <title>Design Lab X | Онлайн-школа курсов по дизайну</title>
    <meta name="description" content="Design Lab X – ваш путь к профессиональному дизайну. Изучайте дизайн онлайн с экспертами индустрии." />
    <meta name="keywords" content="дизайн, онлайн-курсы, школа дизайна, курсы по дизайну, обучение дизайну" />
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
        <div class="container-two intro">
            <div class="intro_main-box">
                <h1 class="intro_title">Создавайте шедевры дизайна с нами!</h1>
                <p class="intro_text">Откройте свой потенциал в мире дизайна с Design Lab X - онлайн-школой, где ваши творческие идеи cтанут реальностью.</p>
                <button class="intro_button intro_button-text" onclick="scrollToTarget()">Начать обучение</button>
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
            <ul class="dropdown-menu_wrapper">
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
    <section class="container section-one">
        <h2 class="section-one_title">Наши курсы</h2>
        <div class="section-one_courses-box" id="courseContainer">
            <?php
            $sql = "SELECT * FROM `courses`";
            $result = mysqli_query($link, $sql);
        
            if (mysqli_num_rows($result) > 0) {
                $nth_child_count = 1;
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
                    echo '<div class="section-one_course-box">';
                    echo '<div class="section-one_course-box-main bg-course-' . $nth_child_count . '">';
            ?>
                    <div class="section-one_additional-information-box">
                        <div class="section-one_additional-button-box">
                            <button class="section-one_additional-button section-one_additional-button-text"><?= $row["duration"] ?></button>
                            <button class="section-one_additional-button section-one_additional-button-text"><?= $russian_date ?> старт</button>
                        </div>
                        <div class="section-one_additional-more-detailed-box" onclick="location.href='course.php?id=<?= $row['id_courses']; ?>'">
                                <p class="section-one_additional-more-detailed-text">подробнее</p>
                                <img src="image/elements/pixelarticons_arrow-left.svg" alt="arrow more detailed" class="section-one_additional-more-detailed-arrow">
                        </div>
                    </div>
                    <div class="section-one_main-information-box">
                        <h3 class="section-one_main-information-title"><?= $row["name"] ?></h3>
                        <p class="section-one_main-information-text"><?= $row["short_description"] ?></p>
                        <button class="section-one_main-information-button section-one_main-information-button-text"><?= $row["basic_cost"] ?> ₽ / месяц</button>
                    </div>
            <?php
            echo '</div></div>';

            $nth_child_count++;
                }
            }
            ?>
        </div>
        <div class="section-one_button-box">
            <button class="section-one_button section-one_button-text" id="toggleButton" onclick="toggleCourses()">Смотреть все</button>
        </div>
    </section>
    <script>
        function toggleCourses() {
        var $courseContainer = $('#courseContainer');
        var $toggleButton = $('#toggleButton');

        if ($courseContainer.hasClass('show-all-courses')) {
            $courseContainer.removeClass('show-all-courses');
            $toggleButton.text('Смотреть все');
        } else {
            $courseContainer.addClass('show-all-courses');
            $toggleButton.text('Скрыть');
        }
        }
    </script>
    <section class="container section-two">
        <div class="section-two_information-box">
            <h2 class="section-two_title"><span class="section-two_title-span"> Design Lab X </span> – ваш путь к творческому успеху!</h2>
            <p class="section-two_text">Design Lab X - это онлайн школа дизайна, где мы 
            вдохновляем, обучаем и поддерживаем начинающих и опытных дизайнеров. Наша цель - развить ваше творческое мышление и передать вам необходимые навыки для успешной карьеры в дизайне. Присоединяйтесь к нам сегодня и откройте для себя мир возможностей в дизайне!</p>
        </div>
        <div class="section-two_advantages-box">
            <div class="section-two_advantage-box">
                <h3 class="section-two_advantage-title">Гибкий график обучения</h3>
                <p class="section-two_advantage-text section-two_width-one">Вы можете учиться в удобное для вас время, не привязываясь к определенному месту и времени.</p>
            </div>
            <div class="section-two_advantage-box">
                <h3 class="section-two_advantage-title">Широкий спектр обучающих программ</h3>
                <p class="section-two_advantage-text section-two_width-two">Мы предлагаем разнообразные курсы и программы обучения, которые позволят вам расширить ваше понимание о различных областях дизайна и найти свое призвание в этой индустрии.</p>
            </div>
            <div class="section-two_advantage-box">
                <h3 class="section-two_advantage-title">Опытные наставники и обратная связь</h3>
                <p class="section-two_advantage-text section-two_width-three">Наши эксперты-профессионалы будут поддерживать вас на протяжении всего обучения, предоставляя ценную обратную связь и помогая вам развиваться как дизайнер.</p>
            </div>
            <div class="section-two_advantage-box">
                <h3 class="section-two_advantage-title">Практическая направленность</h3>
                <p class="section-two_advantage-text section-two_width-four">Мы предлагаем реальные проекты и задания, где вы сможете применить полученные знания на практике. Это поможет вам развить навыки и подготовиться к реальным вызовам в дизайн-индустрии.</p>
            </div>
            <div class="section-two_advantage-box">
                <h3 class="section-two_advantage-title">Карьерная поддержка</h3>
                <p class="section-two_advantage-text section-two_width-five">Design Lab X предлагает карьерные ресурсы и поддержку для студентов, включая помощь с составлением портфолио, резюме и практикумов по поиску работы.</p>
            </div>
        </div>
    </section>
    <section class="section-three">
        <h2 class="section-three_title">Работы студентов</h2>
        <div class="swiper-container section-three_examples-box container-two">
            <div class="swiper-wrapper">
                <div class="section-three_example-box section-three_width-one swiper-slide">
                    <img src="image/elements/example_one.png" alt="example of work" class="section-three_example-image">
                    <div class="section-three_example-button-box">
                        <button class="section-three_example-button section-three_example-button-text">Виктория Лебедева</button>
                        <button class="section-three_example-button-two section-three_example-button-text-two">Графический дизайнер с нуля до PRO</button>
                    </div>
                </div>
                <div class="swiper-slide section-three_example-box section-three_width-two">
                    <img src="image/elements/example_two.png" alt="example of work" class="section-three_example-image">
                    <div class="section-three_example-button-box">
                        <button class="section-three_example-button section-three_example-button-text">Артем Соловьев</button>
                        <button class="section-three_example-button-two section-three_example-button-text-two">3D artist</button>
                    </div>
                </div>
                <div class="swiper-slide section-three_example-box section-three_width-three">
                    <img src="image/elements/example_three.png" alt="example of work" class="section-three_example-image">
                    <div class="section-three_example-button-box">
                        <button class="section-three_example-button section-three_example-button-text">Сергей Волков</button>
                        <button class="section-three_example-button-two section-three_example-button-text-two">UX/UI-дизайнер с нуля до PRO</button>
                    </div>
                </div>
                <div class="section-three_example-box section-three_width-four swiper-slide">
                    <img src="image/elements/example_four.png" alt="example of work" class="section-three_example-image">
                    <div class="section-three_example-button-box">
                        <button class="section-three_example-button section-three_example-button-text">Елена Жукова</button>
                        <button class="section-three_example-button-two section-three_example-button-text-two">3D artist</button>
                    </div>
                </div>
                <div class="section-three_example-box section-three_width-one swiper-slide">
                    <img src="image/elements/example_one.png" alt="example of work" class="section-three_example-image">
                    <div class="section-three_example-button-box">
                        <button class="section-three_example-button section-three_example-button-text">Виктория Лебедева</button>
                        <button class="section-three_example-button-two section-three_example-button-text-two">Графический дизайнер с нуля до PRO</button>
                    </div>
                </div>
                <div class="swiper-slide section-three_example-box section-three_width-two">
                    <img src="image/elements/example_two.png" alt="example of work" class="section-three_example-image">
                    <div class="section-three_example-button-box">
                        <button class="section-three_example-button section-three_example-button-text">Артем Соловьев</button>
                        <button class="section-three_example-button-two section-three_example-button-text-two">3D artist</button>
                    </div>
                </div>
                <div class="swiper-slide section-three_example-box section-three_width-three">
                    <img src="image/elements/example_three.png" alt="example of work" class="section-three_example-image">
                    <div class="section-three_example-button-box">
                        <button class="section-three_example-button section-three_example-button-text">Сергей Волков</button>
                        <button class="section-three_example-button-two section-three_example-button-text-two">UX/UI-дизайнер с нуля до PRO</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="container section-four" id="consultation-form">
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
        <div class="section-four_consultation-form-box">
            <div class="section-four_consultation-form-main">
                <div class="section-four_consultation-form-text-box">
                    <h2 class="section-four_consultation-form-title">Получите консультацию по нашим курсам</h2>
                    <p class="section-four_consultation-form-text">Заполните форму ниже, чтобы получить бесплатную консультацию от нашей команды по выбору подходящих курсов и всех вопросах, которые у вас могут возникнуть.</p>
                </div>
                <div class="section-four_consultation-form-formbox">
                    <form action="php/handler/consultation_obr.php" method="POST" class="section-four_consultation-form-form-main" id="forma_c">
                        <div class="section-four_consultation-form-input-box">
                            <input type="text" name="name" placeholder="Введите ваше имя" required>
                            <input type="email" name="email" placeholder="Введите ваш email" required>
                            <input type="tel" name="tel" id="phone" placeholder="Введите ваш телефон" required>
                        </div>
                        <div class="section-four_personal-data">
                            <input type="checkbox" class="section-four_personal-data-checkbox" name="personal-data" required/>
                            <label class="section-four_personal-data-label" for="personal-data">Нажимая, вы даете согласие на обработку своих персональных данных</label>
                        </div>
                        <input class="section-four_personal-data-button section-four_personal-data-button-text" type="submit" name="consultation" value="Получить консультацию"/>
                    </form>
                    <script>
                        $(document).ready(function(){
                        $('#phone').mask("+7 (999) 999-99-99");

                        $('#forma_c').submit(function(event) {
                            var phoneInput = $('#phone').val();
                            var phoneNumber = phoneInput.replaceAll(/\D+/g, '');
                            $('#phone').val(phoneNumber);         
                        });
                        });

                        function scrollToTarget() {
                            var target = document.getElementById('consultation-form');
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
    <script src="js/errors.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
    <script>
        if (window.innerWidth >= 768 && window.innerWidth <= 1023) {
          document.write('<script src="js/slider2.js"><\/script>');
        } else if (window.innerWidth >= 375 && window.innerWidth <= 767) {
          document.write('<script src="js/slider3.js"><\/script>');
        } else {
          document.write('<script src="js/slider.js"><\/script>');
        }
    </script>
</body>
</html>