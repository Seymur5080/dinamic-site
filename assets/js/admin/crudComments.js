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
                window.location.href = '/views/admin/comments/main.php';
            }, 3000);
        }
    }

    /**
     * Receipt values in modal for update  
     */
    $(document).on('click', '.updateBtn', function () {
        let id = $(this).data('id');
        let email = $(this).data('email');
        let comment = $(this).data('comment');

        $('#updateId').val(id);
        $('#updateEmail').val(email);
        $('#updateComments').val(comment);
    });


    /**
     * Ajax for update comments in DB
     */
    $(document).on('submit', '#update-comments', function (e) {
        e.preventDefault();

        let formData = new FormData(this);
        formData.append('updateCommentsBtn', $(this).find('[name="updateCommentsBtn"]').val());
        formData.append('action', 'updateComments');

        $.ajax({
            url: '../../../../controllers/admin/crudComments.php',
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function (response) {
                let updateButton = $('#updateCommentsBtn');

                if (response.status === 'success') {
                    $('#updateCommentsModal').modal('hide');
                    notification(response.status, response.message, updateButton);
                } else if (response.status === 'warning') {
                    notification(response.status, response.message, updateButton);
                }
            }
        });
    });


    /**
     * Change character status in posts 
     */
    $(document).on('click', '.statusBtn', function (e) {
        e.preventDefault();

        let id          = $(this).data('id');
        let status      = $(this).data('status');

        $.ajax({
            url: '../../../../controllers/admin/crudComments.php',
            method: 'POST',
            data: {
                id,
                status,
                action: 'statusBtn'
            },
            dataType: 'json',
            success: function (response) {
                if (response.status == 'success') {
                    window.location.reload();
                }
            }
        });
    });


    /**
     * Delete categories in DB
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
                    url: '../../../../controllers/admin/crudComments.php',
                    method: 'POST',
                    data: {
                        action: 'deleteComments',
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
});