document.getElementById('start-button').addEventListener('click', function() {
    document.querySelector('.section-info_content-static').style.display = 'none';
    document.querySelector('.section-info_content-dynamic').style.display = 'block';
});
  
document.getElementById('button-back').addEventListener('click', function() {
    document.querySelector('.section-info_content-static').style.display = 'block';
    document.querySelector('.section-info_content-dynamic').style.display = 'none';
});