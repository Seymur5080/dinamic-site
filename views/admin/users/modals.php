<!-- Modal for update -->
<div class="modal fade" id="updateUsersModal" tabindex="-1" aria-labelledby="updateUsersModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="update-users" enctype="multipart/form-data">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="updateUsersModalLabel">Изменить</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-container">
                        <input type="hidden" name="updateId" id="updateId">
                        <div class="mb-4">
                            <label class="label-style" for="login">Имя</label>
                            <input type="text" class="form-control" name="updateLogin" id="login" placeholder="Введите данные" aria-label="Имя" required/>
                        </div>
                        <div class="mb-4">
                            <label class="label-style" for="email">Почта</label>
                            <input type="text" class="form-control" name="updateEmail" id="email" placeholder="Введите данные" aria-label="Почта" disabled/>
                        </div>
                        <div class="mb-4">
                            <label class="label-style" for="password">Пароль</label>
                            <input type="password" class="form-control" name="updatePassword" id="password" placeholder="Введите данные" aria-label="Пароль" required/>
                        </div>
                        <div class="mb-4">
                            <label class="label-style" for="passwordRepeat">Повторите пароль</label>
                            <input type="password" class="form-control" name="updatePasswordRepeat" id="passwordRepeat" placeholder="Введите данные" aria-label="Повторите пароль" required/>
                        </div>
                        <div class="d-flex align-items-center mb-5">
                            <input class="form-check-input show-password m-0 p-0 me-2" type="checkbox" id="usersCheck" aria-label="Показать пароль">
                            <label class="form-check-label show-password m-0 p-0" for="usersCheck">Показать пароль</label>
                        </div>
                        <div class="mb-5">
                            <div class="d-flex align-items-center">
                                <div class="form-check form-check-inline mb-0">
                                    <input class="form-check-input" type="radio" name="updateCharacter" id="character1" value="0" aria-label="Обычный пользователь">
                                    <label class="form-check-label pt-1" for="character1">User</label>
                                </div>
                                <div class="form-check form-check-inline mb-0">
                                    <input class="form-check-input" type="radio" name="updateCharacter" id="character2" value="1" aria-label="Админ">
                                    <label class="form-check-label pt-1" for="character2">Admin</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="updateUsersBtn" id="updateUsersBtn" class="btn btn-primary">Изменить</button>
                </div>
            </form>
        </div>
    </div>
</div>