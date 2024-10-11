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
    <title>Раздел курса</title>
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
    <section class="container section-info">
        <?php
            $idD = $_GET["id"];
            $sql = "SELECT * FROM `course_sections` WHERE `id_course`='1' AND `id_course_sections`='$idD'";
            $result = mysqli_query($link, $sql);
        
            if (mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) {
        ?>
        <h1 class="section-info_title"><?= $row["name"] ?></h1>
        <p class="section-info_text"><?= $row["description"] ?></p>
        <?php
                }
            }
            ?>
        <div class="section-info_box">
        <?php
            $sql1 = "SELECT * FROM `lectures` WHERE `id_section`='$idD'";
            $result1 = mysqli_query($link, $sql1);
        
            if (mysqli_num_rows($result1) > 0) {
                while($row1 = mysqli_fetch_assoc($result1)) {
                    $idlec = $row1["id_lectures"];
        ?>
            <div class="section-info_material-box">
                <div class="section-info_material-name-box">
                    <input type="hidden" value="<?= $idlec ?>">
                    <h2 class="section-info_material-name"><?= $row1["name"] ?></h2>
                    <div class="section-info_material-add-box">
                        <svg width="22" height="13" viewBox="0 0 22 13" fill="none" xmlns="http://www.w3.org/2000/svg" id="arrow-icon">
                            <path d="M2 2L11 11L20 2" stroke="black" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg" id="cross-icon" style="display: none;">
                            <path d="M20 2L2 20M2 2L20 20" stroke="black" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                </div>
                <div class="section-info_openbox">
                    <div class="section-info_main-info">
                        <p class="section-info_main-info-text"><?= $row1["description"] ?></p>
                        <?php
                         $base64_document = base64_encode($row1["document"]);
                         $data_uri = "data:application/pdf;base64," . $base64_document;
                         echo '<iframe src="' . $data_uri . '" width="850" height="500" style="display: flex; justify-content: center; margin: 0 auto;"></iframe>';
                        ?>
                    </div>
                    <div class="section-info_additional-materials-box">
                        <div class="section-info_additional-materials">
                            <h3 class="section-info_additional-materials-title">Материалы лекции:</h3>
                            <?php
                                $sql2 = "SELECT `link` FROM `reference_documents` 
                                JOIN `lectures` ON `reference_documents`.`id_lecture` = `lectures`.`id_lectures`
                                WHERE `lectures`.`id_lectures`='$idlec'";
                                $result2 = mysqli_query($link, $sql2);
                            
                                if (mysqli_num_rows($result2) > 0) {
                                    while($row2 = mysqli_fetch_assoc($result2)) {
                            ?>
                            <a href="#" class="section-info_additional-materials-link"><?= $row2["link"] ?></a>
                            <?php
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
                
            </div>
            <?php
                }
            }
            ?>
            <div class="section-info_material-box">
                <div class="section-info_material-name-box">
                    <h2 class="section-info_material-name">Итоговый тест по теме</h2>
                    <div class="section-info_material-add-box">
                        <svg width="22" height="13" viewBox="0 0 22 13" fill="none" xmlns="http://www.w3.org/2000/svg" id="arrow-icon">
                            <path d="M2 2L11 11L20 2" stroke="black" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg" id="cross-icon" style="display: none;">
                            <path d="M20 2L2 20M2 2L20 20" stroke="black" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                </div>
                <div class="section-info_openbox">
                    <div class="section-info_content-static">
                    <?php
                        $sqldesc = "SELECT `id_tests`, `description` FROM `tests` WHERE `id_course`='1' AND `id_section`='$idD'";
                        $resultdesc = mysqli_query($link, $sqldesc);
                    
                        if (mysqli_num_rows($resultdesc) > 0) {
                            while($rowdesc = mysqli_fetch_assoc($resultdesc)) {
                                $id_test = $rowdesc["id_tests"];
                    ?>
                        <p class="section-info_content-static-text"><?= $rowdesc["description"] ?></p>
                        <button class="section-info_content-static-button section-info_content-static-button-text" id="start-button">Начать</button>
                        <?php
                            }
                        }
                        ?>
                    </div>
                    <div class="section-info_content-dynamic">
                        <?php
                        $sql_count = "SELECT COUNT(*) AS total_questions
                        FROM tests
                        JOIN test_questions ON tests.id_tests = test_questions.id_test
                        WHERE tests.id_section = $idD AND tests.id_course = 1";
                        $result_count = mysqli_query($link, $sql_count);
                        $total_questions = 0;
                    
                        if ($result_count->num_rows > 0) {
                            $row_count = $result_count->fetch_assoc();
                            $total_questions = $row_count["total_questions"];
                        }

                        echo "<div class='section-info_question-number-box'>";
                        for ($i = 1; $i <= $total_questions; $i++) {
                        echo "<span class='section-info_question-number'>" . $i . "</span>";
                        }
                        echo "</div>";
                        ?>
                        <?php
                        echo "<div id='totalQuestions' data-value='$total_questions'></div>";
                        ?>
                        <div class="section-info_question-box">
                        <?php
                        $sql_questions = "SELECT test_questions.question, test_questions.answer1, test_questions.answer2, test_questions.answer3
                        FROM tests
                        JOIN test_questions ON tests.id_tests = test_questions.id_test
                        WHERE tests.id_section = $idD AND tests.id_course = 1 AND tests.id_tests = $id_test
                        LIMIT 1";
                        $result_questions = mysqli_query($link, $sql_questions);

                        if ($result_questions->num_rows > 0) {
                            while($row_questions = $result_questions->fetch_assoc()) {
                        ?>
                            <h3 class="section-info_question-title"><?= $row_questions["question"] ?></h3>
                            <div class="section-info_questions-main">
                                <div class="section-info_question-main">
                                    <input type="radio" id="answer1" name="answer" value="answer1" class="section-info_radio-box-question"/>
                                    <p class="section-info_answer" id="answer1_label">a) <?= $row_questions["answer1"] ?></p>
                                </div>
                                <div class="section-info_question-main">
                                    <input type="radio" id="answer2" name="answer" value="answer2" class="section-info_radio-box-question"/>
                                    <p class="section-info_answer" id="answer2_label">b) <?= $row_questions["answer2"] ?></p>
                                </div>
                                <div class="section-info_question-main">
                                    <input type="radio" id="answer3" name="answer" value="answer3" class="section-info_radio-box-question"/>
                                    <p class="section-info_answer" id="answer3_label">c) <?= $row_questions["answer3"] ?></p>
                                </div>
                            </div>
                            <div class="section-info_question-button-box">
                                <button class="section-info_button-then">Далее</button>
                                <button class="section-info_button-back" id="button-back">Вернуться к началу теста</button>
                            </div>
                        <?php
                            }
                        }
                        ?>
                        </div>
                    </div>
                    <?php
                    $sqlfor_IDTets = "SELECT tests.id_tests
                    FROM tests
                    JOIN test_questions ON tests.id_tests = test_questions.id_test
                    JOIN user_test_progress ON tests.id_tests = user_test_progress.id_test
                    WHERE tests.id_course = 1
                    AND tests.id_section = $idD
                    AND user_test_progress.id_user = $id";
                    $resultfor_IDTets = mysqli_query($link, $sqlfor_IDTets);
                    if ($resultfor_IDTets->num_rows > 0) {
                    $rowfor_IDTets = $resultfor_IDTets->fetch_assoc();
                    $id_test = $rowfor_IDTets["id_tests"];

                    $sqlCheckProgress = "SELECT * FROM `user_test_progress` WHERE `id_user` = '".$_SESSION['user']['id_users']."' AND `id_test` = $id_test";
                    $resultCheckProgress = mysqli_query($link, $sqlCheckProgress);

                    if ($resultCheckProgress && mysqli_num_rows($resultCheckProgress) > 0) {
                        echo '<script type="text/javascript">
                        $(".section-info_content-static").hide();
                        $(".section-info_content-dynamic").hide();
                        $(".section-info_content-after-test").show(); // показываем блок section-info_content-after-test
                        </script>';
                    } else {
                        echo '<script type="text/javascript">
                        $(".section-info_content-after-test").hide(); // скрываем блок section-info_content-after-test
                        </script>';
                    }
                    ?>
                    <div class="section-info_content-after-test">
                        <?php
                        if ($resultCheckProgress) {
                            $row = mysqli_fetch_assoc($resultCheckProgress);
                            $test_completed = $row['test_completed'];
                            if ($test_completed == 1) {
                                echo '<p class="section-info_content-after-test-text">Тест пройден</p>';
                            } else {
                                echo '<p class="section-info_content-after-test-text">Тест не пройден</p>';
                            }
                        }
                    }
                        ?>
                    </div>
                    <div class="section-info_content-for-test">
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
    <script src="js/section-test.js"></script>
    <script src="js/section-list.js"></script>
    <script src="js/quiz.js" data-id_test="<?php echo $id_test; ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
</body>
</html>