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
                window.location.href = '/views/admin/categories/main.php';
            }, 3000);
        }
    }


    /**
     * Regex for categories name
     */
    $(document).on('input', '.patternName', function () {
        var inputValue = $(this).val();
        var regex = /^[A-Za-zА-Яа-яЁё\s]+$/;

        if (!regex.test(inputValue)) {
            $(this).val(inputValue.replace(/[^A-Za-zА-Яа-яЁё\s]+/g, ''));
        }
    });


    /**
     * Ajax for insert categories in DB
     */
    $(document).on('submit', '#add-categories', function (e) {
        e.preventDefault();

        let formData = new FormData(this);
        formData.append('addCategoriesBtn', $(this).find('[name="addCategoriesBtn"]').val());
        formData.append('action', 'addCategories');

        $.ajax({
            url: '../../../../controllers/admin/crudCategories.php',
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function (response) {
                let addButton = $('#addCategoriesBtn');

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
    $(document).on('click', '.updateBtn', function () {
        let id = $(this).data('id');
        let name = $(this).data('name');
        let description = $(this).data('description');

        $('#updateId').val(id);
        $('#updateName').val(name);
        $('#updateDesc').val(description);
    });


    /**
     * Ajax for update categories in DB
     */
    $(document).on('submit', '#update-categories', function (e) {
        e.preventDefault();

        let formData = new FormData(this);
        formData.append('updateCategoriesBtn', $(this).find('[name="updateCategoriesBtn"]').val());
        formData.append('action', 'updateCategories');

        $.ajax({
            url: '../../../../controllers/admin/crudCategories.php',
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function (response) {
                let updateButton = $('#updateCategoriesBtn');

                if (response.status === 'success') {
                    $('#updateCategoriesModal').modal('hide');
                    notification(response.status, response.message, updateButton);
                } else if (response.status === 'warning') {
                    notification(response.status, response.message, updateButton);
                }
            }
        });
    })


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
                    url: '../../../../controllers/admin/crudCategories.php',
                    method: 'POST',
                    data: {
                        action: 'deleteCategories',
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