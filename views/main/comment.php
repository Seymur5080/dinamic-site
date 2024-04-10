<div class="form-container-comment">
    <h4 class="fs-5 mb-3">Добавить комментарий</h4>
    <form id="add-comment">
        <input type="hidden" name="addCommentPageId" value="<?= $_GET['id']; ?>">
        <div class="mb-4">
            <textarea class="form-control" name="addCommentDesc" cols="10" placeholder="Введите комментарий" aria-label="Введите комментарий" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary mb-5" id="addCommentBtn" name="addCommentBtn" aria-label="Добавить">Добавить</button>
    </form>
    <h4 class="fs-5 m-0 mb-3">Все комментарии</h4>
    <div id="all-comments">
        <?php if (!empty($allCommentsByPage)) : ?>
            <?php foreach ($allCommentsByPage as $comment) : ?>
                <div class="comment-box mb-4">
                    <div class="d-flex align-items-center mb-3">
                        <div class="comment-author"><?= $comment['username']; ?>,</div>
                        <div class="comment-time">
                            <?= date("d-m-Y H:i:s", strtotime($comment['created_at'])); ?>
                        </div>
                    </div>
                    <p class="comment-text mb-3">
                        <?= $comment['comment']; ?>
                    </p>
                    <?php if ($_SESSION['email'] == $comment['email']) : ?>
                        <div class="d-flex justify-content-end align-items-center">
                            <a 
                                href="#" 
                                class="comment-link deleteCommentBtn" 
                                data-id="<?= $comment['id']; ?>"
                                data-page-id="<?= $comment['page']; ?>"
                            >
                                Удалить
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>