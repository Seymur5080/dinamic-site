<h2 class="h2 text-center mb-3">Записи</h2>
<table class="table">
    <thead>
        <tr>
            <th class="text-center">ID</th>
            <th class="text-center">Автор</th>
            <th class="text-center">Название</th>
            <th class="text-center">Описание</th>
            <th class="text-center">Картинка</th>
            <th class="text-center">Категория</th>
            <th class="text-center">Статус</th>
            <th class="text-center">Топ</th>
            <th class="text-center">Дата</th>
            <th class="text-center">Управление</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($allPosts)) : ?>
            <?php $count = 1; ?>
            <?php foreach ($allPosts as $post) : ?>
                <tr>
                    <td class="text-center"><?= $count; ?></td>
                    <td class="text-center">
                        <?= !empty($post['username']) ? $post['username'] : "<span class='text-danger'>Нет автора</span>"; ?>
                    </td>
                    <td class="text-center">
                        <?php 
                            if (!empty($post['name'])) {
                                if (strlen($post['name']) > 15) {
                                    echo mb_substr($post['name'], 0, 15, 'UTF-8') . '...';
                                } else {
                                    echo $post['name'];
                                }
                            } else {
                                echo "<span class='text-danger'>Нет названия</span>";
                            }
                        ?>
                    </td>
                    <td class="text-center">
                        <?php 
                            if (!empty($post['description'])) {
                                if (strlen($post['description']) > 15) {
                                    echo mb_substr($post['description'], 0, 15, 'UTF-8') . '...';
                                } else {
                                    echo $post['description'];
                                }
                            } else {
                                echo "<span class='text-danger'>Нет описания</span>";
                            }
                        ?>
                    </td>
                    <td class="text-center">
                        <?= !empty($post['image']) ? $post['image'] : "<span class='text-danger'>Нет картинки</span>"; ?>
                    </td>
                    <td class="text-center">
                        <?= !empty($post['name_categories']) ? $post['name_categories'] : "<span class='text-danger'>Нет категории</span>"; ?>
                    </td>
                    <td class="text-center">
                        <?php if ($post['status'] === null) : ?>
                            <span class="text-danger">Не выбрано</span>
                        <?php elseif ($post['status'] == 0) : ?>
                            <a 
                                href="#" 
                                class="badge text-bg-warning d-inline-block align-middle statusBtn" 
                                data-id="<?= $post['id']; ?>"
                                data-status="<?= $post['status']; ?>"
                            >Не опубликовано</a>
                        <?php elseif ($post['status'] == 1) : ?>
                            <a 
                                href="#" 
                                class="badge text-bg-success d-inline-block align-middle statusBtn" 
                                data-id="<?= $post['id']; ?>"
                                data-status="<?= $post['status']; ?>"
                            >Опубликовано</a>
                        <?php endif; ?>
                    </td>
                    <td class="text-center">
                        <?php if ($post['top_status'] === null) : ?>
                            <span class="text-danger">Не выбрано</span>
                        <?php elseif ($post['top_status'] == 0) : ?>
                            <a 
                                href="#" 
                                class="badge text-bg-danger d-inline-block align-middle topStatusBtn" 
                                data-id="<?= $post['id']; ?>"
                                data-top-status="<?= $post['top_status']; ?>"
                            >
                                Нет
                            </a>
                        <?php elseif ($post['top_status'] == 1) : ?>
                            <a 
                                href="#" 
                                class="badge text-bg-success d-inline-block align-middle topStatusBtn" 
                                data-id="<?= $post['id']; ?>"
                                data-top-status="<?= $post['top_status']; ?>"
                            >
                                Да
                            </a>
                        <?php endif; ?>
                    </td>
                    <td class="text-center"><?= date('d-m-Y H:i:s', strtotime($post['created_at'])); ?></td>
                    <td class="text-center">
                        <div class="d-flex justify-content-center align-items-center">
                            <button 
                                type="button" 
                                class="btn btn-warning btn-style me-2 updateBtn" 
                                data-bs-toggle="modal" 
                                data-bs-target="#updatePostsModal"
                                data-id="<?= $post['id']; ?>"
                                data-name="<?= $post['name']; ?>"
                                data-description="<?= $post['description']; ?>"
                                data-id-categories="<?= $post['id_categories']; ?>"
                                data-status="<?= $post['status']; ?>"
                            >
                                <i class="fa-solid fa-pen-to-square fa-style"></i>
                            </button>
                            <button 
                                type="button" 
                                class="btn btn-danger btn-style deleteBtn" 
                                data-id="<?= $post['id']; ?>"
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
                <td colspan="9" class="text-center"><span class="text-danger">Нет информации</span></td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>