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
                message += messages[i] + "<br>";
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
                window.location.href = '/views/authorization/signIn.php';
            }, 3000);
        }
    }


    /**
    * Function for show password
    */
    $(document).on('click', '#signUpCheck', function () {
        if (
            $('#signUpPassword').attr('type') == 'password' &&
            $('#signUpPasswordRepeat').attr('type') == 'password'
        ) {
            $('#signUpPassword').attr('type', 'text');
            $('#signUpPasswordRepeat').attr('type', 'text');
        } else {
            $('#signUpPassword').attr('type', 'password');
            $('#signUpPasswordRepeat').attr('type', 'password');
        }
    });


    /**
     * Ajax for insert in DB
     */
    $(document).on('submit', '#signUpForm', function (e) {
        e.preventDefault();

        let formData = $(this).serialize();
        formData += '&signUpAdd=' + encodeURIComponent($(this).find('[name="signUpAdd"]').val());

        $.ajax({
            url: '../../../controllers/authorization/signUp.php',
            type: 'POST',
            data: formData,
            dataType: 'json',
            success: function (response) {
                let addButton = $('#signUpAddBtn');
                
                if (response.status === 'success') {
                    notification(response.status, response.message, addButton);
                } else if (response.status === 'warning') {
                    notification(response.status, response.message, addButton);
                }
            },
        });
    });
});