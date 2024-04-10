$(document).ready(function () {
    /**
     * Notification for swal information
     * @param {*} status 
     * @param {*} messages 
     */
    function notification(status, messages, button) {
        if (status == 'warning') {
            button ? button.attr('disabled', true) : null;

            let div = $("<div></div>");
            let message = '';

            for (let i = 0; i < messages.length; i++) {
                message += messages[i] + "<br/>";
            }

            div.html(message);

            Swal.fire({
                title: "Ошибка!",
                html: div,
                icon: "warning"
            }).then((result) => {
                if (result.isConfirmed) {
                    button ? button.attr('disabled', false) : null;
                } else {
                    button ? button.attr('disabled', false) : null;
                }
            });
        } else if (status == 'success') {
            button ? button.attr('disabled', true) : null;

            let message = '';

            for (let i = 0; i < messages.length; i++) {
                message += messages[i] + "<br>";
            }

            Swal.fire({
                title: message,
                icon: "success"
            });

            setTimeout(function () {
                window.location.href = '/views/admin/users/main.php';
            }, 3000);
        }
    }

    /**
    * Function for show password
    */
    $(document).on('click', '#usersCheck', function () {
        if (
            $('#password').attr('type') == 'password' &&
            $('#passwordRepeat').attr('type') == 'password'
        ) {
            $('#password').attr('type', 'text');
            $('#passwordRepeat').attr('type', 'text');
        } else {
            $('#password').attr('type', 'password');
            $('#passwordRepeat').attr('type', 'password');
        }
    });

    /**
     * Ajax for insert users in DB
     */
    $(document).on('submit', '#add-users', function (e) {
        e.preventDefault();

        let formData = new FormData(this);
        formData.append('addUsersBtn', $(this).find('[name="addUsersBtn"]').val());
        formData.append('action', 'addUsers');

        $.ajax({
            url: '../../../../controllers/admin/crudUsers.php',
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function(response) {
                let addBtn = $('#addUsersBtn');
                if (response.status === 'success') {
                    notification(response.status, response.message, addBtn);
                } else if (response.status === 'warning') {
                    notification(response.status, response.message, addBtn);
                }
            }
        })
    });


    /**
     * Receipt values in modal for update  
     */
    $(document).on('click', '.updateBtn', function (e) {
        let id = $(this).data('id');
        let username = $(this).data('username');
        let email = $(this).data('email');
        let admin = $(this).data('admin');

        $('#updateId').val(id);
        $('#login').val(username);
        $('#email').val(email);

        admin == 0 ? $('#character1').prop('checked', true) : $('#character2').prop('checked', true);
    });


    /**
     * Ajax for update users in DB
     */
    $(document).on('submit', '#update-users', function (e) {
        e.preventDefault();

        let formData = new FormData(this);
        formData.append('updateUsersBtn', $(this).find('[name="updateUsersBtn"]').val());
        formData.append('action', 'updateUsers');

        $.ajax({
            url: '../../../../controllers/admin/crudUsers.php',
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function (response) {
                let updateButton = $('#updateUsersBtn');

                if (response.status === 'success') {
                    $('#updateUsersModal').modal('hide');
                    notification(response.status, response.message, updateButton);
                } else if (response.status === 'warning') {
                    notification(response.status, response.message, updateButton);
                }
            }
        });
    });


    /**
     * Ajax for delete users in DB
     */
    $(document).on('click', '.deleteBtn', function (e) {
        e.preventDefault();

        Swal.fire({
            title: "Предупреждение",
            text: "Вы уверены, что хотите удалить?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#28A745",
            cancelButtonColor: "#d33",
            cancelButtonText: 'Отмена',
            confirmButtonText: "Удалить"
        }).then((result) => {
            if (result.isConfirmed) {
                let id = $(this).data('id');

                $.ajax({
                    url: '../../../../controllers/admin/crudUsers.php',
                    method: 'POST',
                    data: {
                        action: 'deleteUsers',
                        id,
                    },
                    dataType: 'json',
                    success: function (response) {
                        notification(response.status, response.message);
                    }
                });
            }
        });
    });


    /**
     * Change character status in users 
     */
    $(document).on('click', '.statusCharacterBtn', function (e) {
        e.preventDefault();

        let id          = $(this).data('id');
        let character   = $(this).data('admin');


        $.ajax({
            url: '../../../../controllers/admin/crudUsers.php',
            method: 'POST',
            data: {
                id,
                character,
                action: 'statusCharacterBtn'
            },
            dataType: 'json',
            success: function (response) {
                if (response.status == 'success') {
                    window.location.reload();
                }
            }
        });
    });
});