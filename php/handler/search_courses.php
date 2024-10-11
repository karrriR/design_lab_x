<?php
session_start();
require_once '../config/connect.php';
if(empty($_SESSION['user'])) {
    header('Location: authorization.php');
}
$id = $_SESSION['user'] ['id_users'];

$searchText = $_GET['search'];

$sqlSearch = "SELECT courses.id_courses AS course_id, courses.name AS course_name, IFNULL(ROUND(user_course_progress.completed_sections / user_course_progress.total_sections * 100), 0) AS progress_percent FROM user_course_progress JOIN courses ON user_course_progress.id_course = courses.id_courses LEFT JOIN course_registration ON course_registration.id_course = courses.id_courses AND course_registration.id_user = user_course_progress.id_user WHERE user_course_progress.id_user = $id AND course_registration.application_status = 'approved' AND courses.name LIKE '%$searchText%'";
$resultSearch = mysqli_query($link, $sqlSearch);

if (mysqli_num_rows($resultSearch) > 0) {
    while($row = mysqli_fetch_assoc($resultSearch)) {
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
    echo '<p class="profile-courses_not-found">По вашему запросу ничего не найдено</p>';
}
?>