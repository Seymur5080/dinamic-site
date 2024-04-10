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
                window.location.href = '/views/admin/posts/main.php';
            }, 3000);
        }
    }


    /**
     * Ajax for insert posts in DB
     */
    $(document).on('submit', '#add-posts', function (e) {
        e.preventDefault();

        let formData = new FormData(this);
        formData.append('addPostsBtn', $(this).find('[name="addPostsBtn"]').val());
        formData.append('action', 'addPosts');

        $.ajax({
            url: '../../../../controllers/admin/crudPosts.php',
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function (response) {
                let addButton = $('#addPostsBtn');

                if (response.status === 'success') {
                    notification(response.status, response.message, addButton);
                } else if (response.status === 'warning') {
                    notification(response.status, response.message, addButton);
                }
            }
        });
    });


    /**
     * Receipt values in modal for update  
     */
    $(document).on('click', '.updateBtn', function (e) {
        let id = $(this).data('id');
        let name = $(this).data('name');
        let description = $(this).data('description');
        let idCategories = $(this).data('id-categories');
        let status = $(this).data('status');

        $('#updateId').val(id);
        $('#updateName').val(name);
        $('#updateDesc').val(description);

        $.ajax({
            url: '../../../../controllers/admin/crudPosts.php',
            method: 'POST',
            data: {
                action: 'ajaxForIdCategory',
                idCategories,
            },
            dataType: 'json',
            success: function (response) {
                $('#updateOption').val(response.data.id);
                $('#updateOption').html(response.data.name);
            }
        });

        status == 0 ? $('#updateStatus1').prop('checked', true) : $('#updateStatus2').prop('checked', true);
    });


    /**
     * Ajax for update posts in DB
     */
    $(document).on('submit', '#update-posts', function (e) {
        e.preventDefault();

        let formData = new FormData(this);
        formData.append('updatePostsBtn', $(this).find('[name="updatePostsBtn"]').val());
        formData.append('action', 'updatePosts');

        $.ajax({
            url: '../../../../controllers/admin/crudPosts.php',
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function (response) {
                let updateButton = $('#updatePostsBtn');

                if (response.status === 'success') {
                    $('#updatePostsModal').modal('hide');
                    notification(response.status, response.message, updateButton);
                } else if (response.status === 'warning') {
                    notification(response.status, response.message, updateButton);
                }
            }
        });
    });


    /**
     * Ajax for delete posts in DB
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
                    url: '../../../../controllers/admin/crudPosts.php',
                    method: 'POST',
                    data: {
                        action: 'deletePosts',
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
     * Change character status in posts 
     */
    $(document).on('click', '.statusBtn', function (e) {
        e.preventDefault();

        let id          = $(this).data('id');
        let status      = $(this).data('status');

        $.ajax({
            url: '../../../../controllers/admin/crudPosts.php',
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
     * Change character top status in posts 
     */
    $(document).on('click', '.topStatusBtn', function (e) {
        e.preventDefault();

        let id          = $(this).data('id');
        let topStatus   = $(this).data('top-status');

        $.ajax({
            url: '../../../../controllers/admin/crudPosts.php',
            method: 'POST',
            data: {
                id,
                topStatus,
                action: 'topStatusBtn'
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