document.getElementById('edit-button').addEventListener('click', function() {
    document.querySelector('.profile-update-password_content-static').style.display = 'none';
    document.querySelector('.profile-update-password_content-dynamic').style.display = 'flex';
});
  
document.getElementById('cancel-button').addEventListener('click', function() {
    document.querySelector('.profile-update-password_content-static').style.display = 'flex';
    document.querySelector('.profile-update-password_content-dynamic').style.display = 'none';
});

document.getElementById('toggle-button').addEventListener('click', function() {
  var passwordBox = document.getElementById('password-box');
  var arrowIcon = document.getElementById('arrow-icon');
  var crossIcon = document.getElementById('cross-icon');
  var lineDiv = document.querySelector('.profile-update-password_line');

  if (passwordBox.style.display === 'none') {
    passwordBox.style.display = 'block';
    arrowIcon.style.display = 'none';
    crossIcon.style.display = 'block';
    lineDiv.style.display = 'none';
  } else {
    passwordBox.style.display = 'none';
    arrowIcon.style.display = 'block';
    crossIcon.style.display = 'none';
    lineDiv.style.display = 'block';
  }
});

document.getElementById('toggle-button-two').addEventListener('click', function() {
  var deleteBox = document.getElementById('delete-box');
  var arrowIcon = document.getElementById('arrow-icon-two');
  var crossIcon = document.getElementById('cross-icon-two');
  var lineDiv = document.querySelector('.profile-delete_line');

  if (deleteBox.style.display === 'none') {
    deleteBox.style.display = 'block';
    arrowIcon.style.display = 'none';
    crossIcon.style.display = 'block';
    lineDiv.style.display = 'none';
  } else {
    deleteBox.style.display = 'none';
    arrowIcon.style.display = 'block';
    crossIcon.style.display = 'none';
    lineDiv.style.display = 'block';
  }
});