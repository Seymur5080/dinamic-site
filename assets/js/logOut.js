$(document).ready(function () {
    /**
     * Notification for swal information
     * @param {*} status 
     * @param {*} messages 
     */
    function notification(status, messages) {
        if (status == 'warning') {
            let div = $("<div></div>");
            let message = '';

            for (let i = 0; i < messages.length; i++) {
                message += messages[i] + "<br>";
            }

            div.html(message);

            Swal.fire({
                title: "Ошибка!",
                html: div,
                icon: "warning"
            });
        } else if (status == 'success') {
            let message = '';

            for (let i = 0; i < messages.length; i++) {
                message += messages[i] + "<br>";
            }

            Swal.fire({
                title: message,
                icon: "success"
            });

            setTimeout(function () {
                window.location.href = '/views';
            }, 3000);
        }
    }

    /**
     * Function for logOut
     */
    $(document).on('click', '.logOut', function (e) {
        e.preventDefault();

        Swal.fire({
            title: "Предупреждение",
            text: "Вы уверены, что хотите выйти?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#28A745",
            cancelButtonColor: "#d33",
            cancelButtonText: 'Отмена',
            confirmButtonText: "Выйти"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/controllers/logOut.php',
                    method: 'POST',
                    data: {
                        
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