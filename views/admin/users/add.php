<?php
require_once '../../../controllers/sessionInfo.php';
require_once '../../../helpers/path.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../../../assets/css/admin/style.css">
</head>

<body>
    <?php require_once '../header.php'; ?>

    <div class="container-fluid">
        <div class="row mt-3">
            <div class="col-3">
                <?php require_once '../sidebar.php'; ?>
            </div>
            <div class="col-9">
                <h2 class="h2 text-center mt-3 mb-3">Добавление пользователя</h2>
                <div class="form-container mx-auto">
                    <form id="add-users">
                        <div class="mb-4">
                            <label class="label-style" for="login">Имя</label>
                            <input type="text" class="form-control" name="addLogin" id="login" placeholder="Введите данные" aria-label="Имя" required/>
                        </div>
                        <div class="mb-4">
                            <label class="label-style" for="email">Почта</label>
                            <input type="text" class="form-control" name="addEmail" id="email" placeholder="Введите данные" aria-label="Почта" required/>
                        </div>
                        <div class="mb-4">
                            <label class="label-style" for="password">Пароль</label>
                            <input type="password" class="form-control" name="addPassword" id="password" placeholder="Введите данные" aria-label="Пароль" required/>
                        </div>
                        <div class="mb-4">
                            <label class="label-style" for="passwordRepeat">Повторите пароль</label>
                            <input type="password" class="form-control" name="addPasswordRepeat" id="passwordRepeat" placeholder="Введите данные" aria-label="Повторите пароль" required/>
                        </div>
                        <div class="d-flex align-items-center mb-5">
                            <input class="form-check-input show-password m-0 p-0 me-2" type="checkbox" id="usersCheck" aria-label="Показать пароль">
                            <label class="form-check-label show-password m-0 p-0" for="usersCheck">Показать пароль</label>
                        </div>
                        <div class="mb-5">
                            <div class="d-flex align-items-center">
                                <div class="form-check form-check-inline mb-0">
                                    <input class="form-check-input" type="radio" name="addCharacter" id="character1" value="0" aria-label="Обычный пользователь">
                                    <label class="form-check-label pt-1" for="character1">User</label>
                                </div>
                                <div class="form-check form-check-inline mb-0">
                                    <input class="form-check-input" type="radio" name="addCharacter" id="character2" value="1" aria-label="Админ">
                                    <label class="form-check-label pt-1" for="character2">Admin</label>
                                </div>
                            </div>
                        </div>
                        <button type="submit" name="addUsersBtn" id="addUsersBtn" class="btn btn-primary" aria-label="Сохранить">Сохранить</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <script src="https://cdn.ckeditor.com/ckeditor5/41.1.0/classic/ckeditor.js"></script>
    <script type="text/javascript" src="../../../assets/js/jquery-3.7.1.js"></script>
    <script src="../../../assets/js/logOut.js"></script>
    <script src="../../../assets/js/admin/crudUsers.js"></script>
</body>

</html>