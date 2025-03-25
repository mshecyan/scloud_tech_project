$(document).ready(() => {

    const API_URL = '/api/api.php?method=';

    let deleteButton = $('.deleteContactButton');
    let logoutButton = $('.logoutButton');
    let loginForm = $('.loginForm');
    let sendContactsForm = $('.sendContactsForm');
    let errorModalToggle = $('#errorModalToggle');
    let errorModalWindow = $('#errorModalWindow');

    deleteButton.on('click', function() {
        let contactId = $(this).attr('contact-id');
        $.ajax({
            url: API_URL + 'deleteContact',
            method: 'post',
            data: { id: contactId },
            dataType: 'json',

            success: function() {
                location.reload(true);
            },
            error: function(data) {
                showError(data.responseJSON.error.message);
            },
        });
    });

    logoutButton.on('click', function() {
        $.ajax({
            url: API_URL + 'logout',
            method: 'get',
        });

        location.replace('/admin/login.php');
    });

    loginForm.submit(function(event) {
        event.preventDefault();

        $.ajax({
            type: 'post',
            url: API_URL + 'login',
            data: $(this).serialize(),
            dataType: 'json',

            success: function() {
                location.replace('/admin/');
            },
            error: function(data) {
                showError(data.responseJSON.error.message);
            },
        });
    });

    sendContactsForm.submit(function(event) {
        event.preventDefault();

        $.ajax({
            method: 'post',
            url: API_URL + 'sendContacts',
            data: new FormData($(this)[0]),
            contentType: false,
            processData: false,

            success: function() {
                location.reload(true);
            },
            error: function(data) {
                showError(data.responseJSON.error.message);
            },
        });
    });

    function showError(message) {
        errorModalWindow.find('.modal-body').first().text(message ?? 'Произошла внутренняя ошибка.');
        errorModalToggle.click();
    }
});