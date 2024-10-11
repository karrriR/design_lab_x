var correctAnswersCount = 0;
var id_test = document.currentScript.getAttribute('data-id_test');
var attemptsLeft = 3;
$(document).ready(function() {
    var currentQuestion = 1;
    var totalQuestions = parseInt($('#totalQuestions').data('value'));
  
    function showQuestion(questionNumber) {
      $.ajax({
        url: './php/handler/get_next_question.php',
        type: 'post',
        data: { questionNumber: questionNumber, id_test: id_test },
        dataType: 'json',
        success: function(response) {
          var nextQuestion = response;
  
          $('.section-info_question-title').text(nextQuestion.question);
          $('#answer1_label').text('a) ' + nextQuestion.answer1);
          $('#answer2_label').text('b) ' + nextQuestion.answer2);
          $('#answer3_label').text('c) ' + nextQuestion.answer3);
        }
      });

      // Удалить класс section-info_question-number-active у всех элементов
    $('.section-info_question-number').removeClass('section-info_question-number-active');
    // Добавить класс section-info_question-number-active к текущему вопросу
    $('.section-info_question-number').eq(questionNumber - 1).addClass('section-info_question-number-active');
    }

    $('.section-info_question-number').first().addClass('section-info_question-number-active');
  
    $('.section-info_question-main').on('click', function() {
        $(this).find('input[type="radio"]').prop('checked', true); // Выбрать радио-переключатель, связанный с текущим блоком
        $('.section-info_question-main').css('background-color', ''); // Сбросить цвет для всех блоков
        $(this).css('background-color', '#D8AEF9'); // Изменить цвет текущего блока
    });
    
    // Обработчик события клика по кнопке "Далее"
    $('.section-info_button-then').on('click', function() {
      var selectedAnswer = $('input[name="answer"]:checked').val(); // Получаем значение выбранного ответа
      if (selectedAnswer) {
        $.ajax({
          url: './php/handler/check_answer.php',
          type: 'post',
          data: { selectedAnswer: selectedAnswer, currentQuestion: currentQuestion, id_test: id_test },
          dataType: 'json',
          success: function(response) {
            if (response.result === 'correct') {
              // Ответ правильный - увеличиваем переменную для подсчета правильных ответов
              correctAnswersCount++;
            }

            if (currentQuestion < totalQuestions) {
              currentQuestion++;
              showQuestion(currentQuestion);
              // Сбросить цвет при переключении вопроса и сбросить выбор радио-переключателей
              $('.section-info_question-main').css('background-color', '');
              $('input[type="radio"]').prop('checked', false);
            } else {
              displayResultAndActionButtons();
            }
          }
        });
      } else {
        alert('Пожалуйста, выберите ответ перед тем как перейти к следующему вопросу.');
      }
    });
    
    function resetTest() {
      correctAnswersCount = 0; // Сбросить количество правильных ответов
      currentQuestion = 1; // Сбросить номер текущего вопроса
      $('.section-info_content-for-test').empty(); 
      $('.section-info_content-for-test').hide(); 
      $('.section-info_content-dynamic').show();
      showQuestion(currentQuestion);
    
      // Удалить класс section-info_question-number-active у всех элементов
      $('.section-info_question-number').removeClass('section-info_question-number-active');
      // Добавить класс section-info_question-number-active к текущему вопросу
      $('.section-info_question-number').eq(currentQuestion - 1).addClass('section-info_question-number-active');
    }

    function displayResultAndActionButtons() {
      $('.section-info_content-dynamic').hide(); // Удалить содержимое блока с вопросами
      $('.section-info_content-for-test').show(); 
      var resultText = "Количество правильных ответов: " + correctAnswersCount + " из " + totalQuestions + ".";
      var passTestAgainButton = '<button class="pass-test-again-button">Пройти тест заново</button>';
      var saveAndPassTestAgainButton = '<button class="save-result-button">Сохранить результат</button>' + passTestAgainButton;
      var saveResultsButton = '<button class="save-result-button">Сохранить результат</button>';

      $('.section-info_content-for-test').append('<p class="section-info_content-after-test-text-two">' + resultText + '</p>'); // Вывести количество правильных ответов
      $('.section-info_content-for-test').append('<p class="section-info_content-after-test-text-two">Оставшееся количество попыток: ' + attemptsLeft + '</p>'); // Вывести количество оставшихся попыток
      if (attemptsLeft === 0) {
        $('.pass-test-again-button').hide();  // Прячем кнопку "Пройти тест заново", если попытки исчерпаны
        $('.section-info_content-for-test').append(saveResultsButton); // Отображаем кнопку "Сохранить результат"
      } else if (correctAnswersCount < totalQuestions / 2) {
        // Если количество правильных ответов меньше половины от общего числа вопросов
        $('.section-info_content-for-test').append('<p class="section-info_content-after-test-text-two">Вы не прошли тест. Попытайтесь снова.</p>'); // Вывести сообщение
        $('.section-info_content-for-test').append(passTestAgainButton); // Вывести кнопку "Пройти тест заново"
      } else if (correctAnswersCount < totalQuestions) {
        // Если количество правильных ответов больше половины, но не все вопросы отвечены правильно
        $('.section-info_content-for-test').append('<p class="section-info_content-after-test-text-two">Вы можете попытаться снова пройти тест.</p>'); // Вывести сообщение
        $('.section-info_content-for-test').append( saveAndPassTestAgainButton ); // Вывести кнопку "Сохранить результат и пройти тест заново"
      } else {
        // Если все вопросы отвечены правильно
        $('.section-info_content-for-test').append('<p class="section-info_content-after-test-text-two">Вы прошли тест на 100%. Хорошая работа.</p>');
        $('.section-info_content-for-test').append(saveResultsButton); // Вывести кнопку "Сохранить результат"
      }


      // Обработчик события клика по кнопке "Сохранить результат"
      $('.save-result-button').on('click', function() {
          $.ajax({
          url: './php/handler/save_results.php',
          type: 'post',
          data: { 
            saveResults: true, 
            correctAnswersCount: correctAnswersCount,
            id_test: id_test, 
            attemptsLeft: attemptsLeft  
          },
          success: function(response) {
              alert(response); // Выводим сообщение об успешном сохранении или об ошибке
              $('.section-info_content-for-test').empty();
              $('.section-info_content-for-test').append('<p class="section-info_content-after-test-text">Тест пройден</p>');
              location.reload(true);
          }
      });
      });

      $('.pass-test-again-button').on('click', function() {
        if(attemptsLeft > 0) {
          attemptsLeft--;
          resetTest();
        } else {
          alert("Вы использовали все попытки");
        }
      });

    }
});