<h2 class="h2 text-center mb-3">Записи</h2>

<table class="table">
    <thead>
        <tr>
            <th class="text-center">ID</th>
            <th class="text-center">Имя</th>
            <th class="text-center">Почта</th>
            <th class="text-center">Роль</th>
            <th class="text-center">Дата</th>
            <th class="text-center">Управление</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($allUsers)) : ?>
            <?php $count = 1; ?>
            <?php foreach($allUsers as $user) : ?>
                <tr>
                    <td class="text-center"><?= $count; ?></td>
                    <td class="text-center"><?= !empty($user['username']) ? $user['username'] : "<span class='text-danger'>Нет имени</span>"; ?></td>
                    <td class="text-center"><?= !empty($user['email']) ? $user['email'] : "<span class='text-danger'>Нет почты</span>"; ?></td>
                    <td class="text-center">
                        <?php if (empty($user['admin']) && $user['admin'] === null) : ?>
                            <span class="text-danger">Нет статуса</span>
                        <?php elseif ($user['admin'] == 0) : ?>
                            <a 
                                href="#"
                                class="badge text-bg-primary d-inline-block align-middle statusCharacterBtn"
                                data-id="<?= $user['id']; ?>"
                                data-admin="<?= $user['admin']; ?>"
                            >User</a>
                        <?php elseif ($user['admin'] == 1) : ?>
                            <a 
                                href="#"
                                class="badge text-bg-success d-inline-block align-middle statusCharacterBtn"
                                data-id="<?= $user['id']; ?>"
                                data-admin="<?= $user['admin']; ?>"
                            >Admin</a>
                        <?php endif; ?>
                    </td>
                    <td class="text-center"><?= date('d-m-Y H:i:s', strtotime($user['created_at'])); ?></td>
                    <td class="text-center">
                        <div class="d-flex justify-content-center align-items-center">
                            <button 
                                type="button" 
                                class="btn btn-warning btn-style me-2 updateBtn" 
                                data-bs-toggle="modal" 
                                data-bs-target="#updateUsersModal"
                                data-id="<?= $user['id']; ?>"
                                data-username="<?= $user['username']; ?>"
                                data-email="<?= $user['email']; ?>"
                                data-admin="<?= $user['admin']; ?>"
                            >
                                <i class="fa-solid fa-pen-to-square fa-style"></i>
                            </button>
                            <button 
                                type="button" 
                                class="btn btn-danger btn-style deleteBtn" 
                                data-id="<?= $user['id']; ?>"
                            >
                                <i class="fa-solid fa-trash fa-style"></i>
                            </button>
                        </div>
                    </td>
                </tr>
            <?php $count++; ?>
            <?php endforeach; ?>
        <?php else : ?>
            <tr>
                <td colspan="6" class="text-center"><span class="text-danger">Нет информации</span></td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>