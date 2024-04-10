<h2 class="h2 text-center mb-3">Записи</h2>
<table class="table">
    <thead>
        <tr>
            <th class="text-center">ID</th>
            <th class="text-center">Автор</th>
            <th class="text-center">Комментарий</th>
            <th class="text-center">Id страницы</th>
            <th class="text-center">Статус</th>
            <th class="text-center">Дата</th>
            <th class="text-center">Управление</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($allComments)) : ?>
            <?php $count = 1; ?>
            <?php foreach ($allComments as $comment) : ?>
                <tr>
                    <td class="text-center"><?= $count; ?></td>
                    <td class="text-center">
                        <?= !empty($comment['email']) ? $comment['email'] : "<span class='text-danger'>Нет автора</span>"; ?>
                    </td>
                    
                    <td class="text-center">
                        <?php 
                            // if (!empty($comment['comment'])) {
                            //     if (strlen($comment['comment']) > 15) {
                            //         echo mb_substr($comment['comment'], 0, 15, 'UTF-8') . '...';
                            //     } else {
                            //         echo $comment['comment'];
                            //     }
                            // } else {
                            //     echo "<span class='text-danger'>Нет комментария</span>";
                            // }
                            echo $comment['comment'];
                        ?>
                    </td>
                    <td class="text-center">
                        <?= !empty($comment['page']) ? $comment['page'] : "<span class='text-danger'>Нет страницы</span>"; ?>
                    </td>
                    <td class="text-center">
                        <?php if ($comment['status'] === null) : ?>
                            <span class="text-danger">Не выбрано</span>
                        <?php elseif ($comment['status'] == 0) : ?>
                            <a 
                                href="#" 
                                class="badge text-bg-warning d-inline-block align-middle statusBtn" 
                                data-id="<?= $comment['id']; ?>"
                                data-status="<?= $comment['status']; ?>"
                            >Не опубликовано</a>
                        <?php elseif ($comment['status'] == 1) : ?>
                            <a 
                                href="#" 
                                class="badge text-bg-success d-inline-block align-middle statusBtn" 
                                data-id="<?= $comment['id']; ?>"
                                data-status="<?= $comment['status']; ?>"
                            >Опубликовано</a>
                        <?php endif; ?>
                    </td>
                    <td class="text-center"><?= date('d-m-Y H:i:s', strtotime($comment['created_at'])); ?></td>
                    <td class="text-center">
                        <div class="d-flex justify-content-center align-items-center">
                            <button 
                                type="button" 
                                class="btn btn-warning btn-style me-2 updateBtn" 
                                data-bs-toggle="modal" 
                                data-bs-target="#updateCommentsModal"
                                data-id="<?= $comment['id']; ?>"
                                data-email="<?= $comment['email']; ?>"
                                data-comment="<?= $comment['comment']; ?>"
                            >
                                <i class="fa-solid fa-pen-to-square fa-style"></i>
                            </button>
                            <button 
                                type="button" 
                                class="btn btn-danger btn-style deleteBtn" 
                                data-id="<?= $comment['id']; ?>"
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