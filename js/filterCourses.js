function filterCourses(filterType) {
    const courses = document.querySelectorAll('.profile-courses_coursebox');
    let anyCourseDisplayed = false;

    courses.forEach(course => {
        const progress = course.querySelector('.profile-courses_procent-now').textContent.replace('%', '');

        if (filterType === 'current' && progress < 100) {
            course.style.display = 'block';
            anyCourseDisplayed = true;
        } else if (filterType === 'completed' && progress == 100) {
            course.style.display = 'block';
            anyCourseDisplayed = true;
        } else {
            course.style.display = 'none';
        }
    });

    const noCoursesMessage = document.querySelector('.no-courses-message');
    if (filterType === 'completed' && !anyCourseDisplayed) {
        noCoursesMessage.style.display = 'block';
    } else {
        noCoursesMessage.style.display = 'none';
    }
}

document.querySelector('.profile-courses_button.completed-courses').addEventListener('click', () => { 
    filterCourses('completed'); 
    document.querySelector('.profile-courses_button.completed-courses').classList.remove('profile-courses_noactive'); 
    document.querySelector('.profile-courses_button.completed-courses').classList.add('profile-courses_active'); 
    document.querySelector('.profile-courses_button.current-courses').classList.remove('profile-courses_active'); 
    document.querySelector('.profile-courses_button.current-courses').classList.add('profile-courses_noactive'); 
}); 

document.querySelector('.profile-courses_button.current-courses').addEventListener('click', () => { 
    filterCourses('current'); 
    document.querySelector('.profile-courses_button.current-courses').classList.remove('profile-courses_noactive'); 
    document.querySelector('.profile-courses_button.current-courses').classList.add('profile-courses_active'); 
    document.querySelector('.profile-courses_button.completed-courses').classList.remove('profile-courses_active'); 
    document.querySelector('.profile-courses_button.completed-courses').classList.add('profile-courses_noactive'); 
});