$('.admin-panel_table-info-button').on('click', function() {
    var selectedTableName = $('.admin-panel_table-info-nametable').text();
    $('#addRecordForm').attr('data-table', selectedTableName);

    if (selectedTableName === 'users' || selectedTableName === 'lectures') {
        $('#addRecordForm').attr('enctype', 'multipart/form-data');
    } else {
        $('#addRecordForm').removeAttr('enctype');
    }
    if (selectedTableName === 'user_course_progress' || selectedTableName === 'user_section_progress' || selectedTableName === 'user_test_progress') {
        alert("В данную таблицу нельзя вносить данные со стороны администратора");
        return;
    }
    
    $.ajax({
        url: './php/admin/get_table_fields.php',
        method: 'POST',
        data: { tableName: selectedTableName }, 
        dataType: 'json',
        success: function(response) {
            $('.admin-panel_modalAddData').css('display', 'block');
            $('.admin-panel_modal-title').text('Добавить запись');
            var modalForm = $('#addRecordForm');
            modalForm.empty();
            $.each(response, function(index, field) {
                if (field.type === 'tel') {
                    modalForm.append('<input type="' + field.type + '" name="' + field.name + '" id="' + field.id + '" placeholder="' + field.placeholder + '">');
                } else if (field.name === 'photo_profile') {
                    modalForm.append('<input type="file" name="img" />');
                } else if (field.name === 'document') {
                    modalForm.append('<input type="file" name="doc" />');
                } else if (field.name === 'application_status') {
                    modalForm.append('<input type="hidden" name="' + field.name + '" placeholder="' + field.placeholder + '">');
                } else {
                    modalForm.append('<input type="' + field.type + '" name="' + field.name + '" placeholder="' + field.placeholder + '">');
                }
            });
            $('#phone').mask('+7(000)000-00-00');
            modalForm.append('<input type="submit" value="Добавить" name="addRecordButton">');
            modalForm.append('<input type="hidden" name="action" value="addRecordButton">');
        },
        error: function(xhr, status, error) {
        }
    });
});

$('.admin-panel_svg-close').on('click', function() {
    $('.admin-panel_modalAddData').css('display', 'none'); 
    $('#addRecordForm').removeAttr('data-table');
});

$('.admin-panel_table-container').on('click', '.table-cell img[src="image/elements/admin_icon_basket.svg"]', function() {
    var row = $(this).closest('.table-row');
    var idColumnName = $('.table-header:first').text().trim();
    var id = row.find('.table-cell:first').text();
    var tableName = $('.admin-panel_table-info-nametable').text();

    if (tableName === 'user_course_progress' || tableName === 'user_section_progress') {
        alert("Вы не можете удалять данные из этой таблицы");
        return;
    }

    $.ajax({
        url: './php/admin/delete_record.php',
        method: 'POST',
        data: { tableName: tableName, idColumnName: idColumnName, id: id }, 
        success: function(response) {
            var data = JSON.parse(response);
                if (data.message) {
                    alert(data.message);
                } else if (data.error) {
                    alert(data.error);
                }
        },
        error: function(xhr, status, error) {
        }
    });
});

$('.admin-panel_table-container').on('click', '.table-cell img[src="image/elements/admin_icon_update.svg"]', function() {
    var row = $(this).closest('.table-row');
    var idColumnName = $('.table-header:first').text().trim();
    var id = row.find('.table-cell:first').text();
    var tableName = $('.admin-panel_table-info-nametable').text();

    $('#addRecordForm').attr('data-table', tableName);
    if (tableName === 'users' || tableName === 'lectures') {
        $('#addRecordForm').attr('enctype', 'multipart/form-data');
    } else {
        $('#addRecordForm').removeAttr('enctype');
    }
    if (tableName === 'user_course_progress' || tableName === 'user_section_progress' || tableName === 'user_test_progress') {
        alert("В данную таблицу нельзя вносить изменения");
        return;
    }

    $.ajax({
        url: './php/admin/get_table_fields.php',
        method: 'POST',
        data: { tableName: tableName, idColumnName: idColumnName, id: id }, 
        dataType: 'json',
        success: function(response) {
            $('.admin-panel_modalAddData').css('display', 'block');
            $('.admin-panel_modal-title').text('Изменить запись');
            var modalForm = $('#addRecordForm');
            modalForm.empty();
            $.each(response.fields, function(index, field) {
                var value = response.record ? response.record[field.name] : ''; 
                if (field.type === 'tel') {
                    modalForm.append('<input type="' + field.type + '" name="' + field.name + '" id="' + field.id + '" placeholder="' + field.placeholder + '" value="' + value + '">');
                } else if (field.name === 'photo_profile') {
                    modalForm.append('<input type="' + field.type + '" name="' + field.name + '" value="' + value + '" readonly>');
                    modalForm.append('<input type="file" name="img" />');
                } else if (field.type === 'password') {
                    modalForm.append('<input type="' + field.type + '" name="' + field.name + '" placeholder="Введите пароль только если хотите его изменить">');
                } else if (field.name === 'document') {
                    modalForm.append('<input type="text" placeholder="Загрузите документ только если хотите его изменить" readonly>');
                    modalForm.append('<input type="file" name="doc" />');
                } else {
                    modalForm.append('<input type="' + field.type + '" name="' + field.name + '" placeholder="' + field.placeholder + '" value="' + value + '">');
                }
            });
            $('#phone').mask('+7(000)000-00-00');
            modalForm.append('<input type="submit" value="Обновить" name="updateRecordButton">');
            modalForm.append('<input type="hidden" name="action" value="updateRecordButton">');
        },
        error: function(xhr, status, error) {
        }
    });
});

$('#addRecordForm').submit(function(event) {
    event.preventDefault();
    var tableName = $(this).attr('data-table');
    var formData = new FormData(this);

    $.ajax({
        url: './php/admin/add_upd_to_' + tableName + '.php',
        method: 'POST',
        data: formData,
        processData: false,  // Предотвратить обработку данных jQuery
        contentType: false,  // Предотвратить установку типа контента jQuery
        success: function(response) {
            var data = JSON.parse(response);
            if (data.message) {
                alert(data.message);
                $('.admin-panel_modalAddData').css('display', 'none');
                $('#addRecordForm')[0].reset();
            } else if (data.error) {
                alert(data.error);
            }
        },
        error: function(xhr, status, error) {
            // Обработать ошибку
        }
    });
});