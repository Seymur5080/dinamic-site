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
            button ? button.attr('disabled', false) : null;

            let message = '';

            for (let i = 0; i < messages.length; i++) {
                message += messages[i] + "<br>";
            }

            Swal.fire({
                title: message,
                icon: "success",
                timer: 2000
            });
        }
    }


    /**
     * Function for formate date 
     * @param {*} time 
     * @returns 
     */
    function formatDate(time) {
        let date = new Date(time);
        let day = date.getDate();
        let month = date.getMonth() + 1;
        let year = date.getFullYear();
        let hours = date.getHours();
        let minutes = date.getMinutes();
        let seconds = date.getSeconds();

        let formattedDate = (day < 10 ? '0' : '') + day + '-' + (month < 10 ? '0' : '') + month + '-' + year;
        let formattedTime = (hours < 10 ? '0' : '') + hours + ':' + (minutes < 10 ? '0' : '') + minutes + ':' + (seconds < 10 ? '0' : '') + seconds;
        let formattedDateTime = formattedDate + ' ' + formattedTime;

        return formattedDateTime;
    }


    /**
    * Ajax for search posts input in main page (blog.php)
    */
    $(document).on('input', '#search-posts', function () {
        $(this).on('keydown', function (event) {
            if (event.keyCode == 13) {
                event.preventDefault();
            }
        });

        let pageUrl = window.location.protocol + '//' + window.location.hostname + '/';

        let formData = new FormData(this);
        formData.append('pageUrl', window.location.href);

        $.ajax({
            url: '../../../controllers/main/search.php',
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function (response) {
                let html = '';

                if (response.data.length > 0) {
                    response.data.forEach(element => {
                        html += `
                        <div class="row mb-3">
                            <div class="col-12 col-md-4">
                                <img src="${pageUrl + 'assets/img/posts/' + element.image}" class="img-thumbnail" alt="Lambo" style="max-height: 210px; width: 100%; height:100%; object-fit: cover;">
                            </div>
                            <div class="col-12 col-md-8">
                                <div class="box bg-white">
                                <h3>
                                    <a href="${pageUrl + 'views/main/single-blog.php?id=' + element.id}" class="title">
                                        ${(element.name.length > 20) ? element.name.substring(0, 20) + '...' : element.name}
                                    </a>
                                </h3>
                                <p>
                                    ${(element.description.length > 250) ? element.description.substring(0, 250) + '...' : element.description}
                                </p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="author">
                                        <i class="fa-solid fa-user"></i> ${element.username}
                                    </div>
                                    <div class="date">
                                        <i cдlass="fa-solid fa-calendar-days pe-2"></i>
                                        ${formatDate(element.created_at)}
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div> 
                    `;
                    });
                } else {
                    html += `
                        <div class="row mb-3">
                            <div class="col-12">
                                <h3 class="fs-5 text-center text-danger m-0">Нет информации</h3>
                            </div>
                        </div>
                    `;
                }

                $('.dinamic-blogs').html(html);
            }
        });
    });


    /**
     * Function for add comment in single blog page
     */
    $(document).on('submit', '#add-comment', function (e) {
        e.preventDefault();

        let formData = new FormData(this);
        formData.append('addCommentBtn', $(this).find('[name="addCommentBtn"]').val());
        formData.append('action', 'addComment');

        $.ajax({
            url: '../../../controllers/main/comment.php',
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function (response) {
                console.log(response);
                let addCommentBtn = $('#addCommentBtn');

                if (response.status === 'auth') {
                    addCommentBtn ? addCommentBtn.attr('disabled', true) : null;

                    Swal.fire({
                        title: "Хотите сделать вход?",
                        text: `${response.message}`,
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Войти",
                        cancelButtonText: 'Отмена'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = '/views/authorization/signIn.php';
                        } else {
                            addCommentBtn ? addCommentBtn.attr('disabled', false) : null;
                        }
                    });
                } else {
                    if (response.status === 'success') {
                        let html = '';

                        if (response.data.length > 1) {
                            response.data.forEach(element => {
                                html += `
                                    <div class="comment-box mb-4">
                                        <div class="d-flex align-items-center mb-3">
                                            <div class="comment-author">${element.username},</div>
                                            <div class="comment-time">${formatDate(element.created_at)}</div>
                                        </div>
                                        <p class="comment-text mb-3">${element.comment}</p>
                                        ${element.email === response.email ? `
                                            <div class="d-flex justify-content-end align-items-center">
                                                <a 
                                                    href="#" 
                                                    class="comment-link deleteCommentBtn"
                                                    data-id="${element.id}"
                                                    data-page-id="${element.page}"
                                                >
                                                    Удалить
                                                </a>
                                            </div>
                                        ` : ''}
                                    </div>
                                `;
                            });
                        } 

                        $('[name="addCommentDesc"]').val('');
                        $('#all-comments').html(html);
                        notification(response.status, response.message, addCommentBtn);
                    } else if (response.status === 'warning') {
                        notification(response.status, response.message, addCommentBtn);
                    }
                }
            }
        });
    });


    /**
     * Delete categories in DB
     */
    $(document).on('click', '.deleteCommentBtn', function (e) {
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
                let pageId = $(this).data('page-id');

                $.ajax({
                    url: '../../../controllers/main/comment.php',
                    method: 'POST',
                    data: {
                        action: 'deleteCommentsInSingleBlogPage',
                        id,
                        pageId
                    },
                    dataType: 'json',
                    success: function (response) {
                        if (response.status == 'success') {
                            let html = '';

                            if (response.data.length > 1) {
                                response.data.forEach(element => {
                                    html += `
                                        <div class="comment-box mb-4">
                                            <div class="d-flex align-items-center mb-3">
                                                <div class="comment-author">${element.username},</div>
                                                <div class="comment-time">${formatDate(element.created_at)}</div>
                                            </div>
                                            <p class="comment-text mb-3">${element.comment}</p>
                                            ${element.email === response.email ? `
                                                <div class="d-flex justify-content-end align-items-center">
                                                    <a 
                                                        href="#" 
                                                        class="comment-link deleteCommentBtn"
                                                        data-id="${element.id}"
                                                        data-page-id="${element.page}"
                                                    >
                                                        Удалить
                                                    </a>
                                                </div>
                                            ` : ''}
                                        </div>
                                    `;
                                });
                            } 

                            $('#all-comments').html(html);
                            notification(response.status, response.message);
                        }
                    }
                });
            }
        });
    });
});