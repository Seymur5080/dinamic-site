<!-- Modal for update -->
<div class="modal fade" id="updatePostsModal" tabindex="-1" aria-labelledby="updatePostsModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="update-posts" enctype="multipart/form-data">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="updatePostsModalLabel">Изменить</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-container">
                        <input type="hidden" name="updateId" id="updateId">
                        <div class="mb-4">
                            <label class="label-style" for="updateName">Название записи</label>
                            <input type="text" class="form-control" name="updateName" id="updateName" placeholder="Введите данные" />
                        </div>
                        <div class="mb-4">
                            <label class="label-style" for="updateDesc">Описание категории</label>
                            <textarea class="form-control" name="updateDesc" id="updateDesc" cols="10" placeholder="Введите данные"></textarea>
                        </div>
                        <div class="mb-4">
                            <label class="label-style" for="updateImage" class="form-label">Файл</label>
                            <input class="form-control" type="file" id="updateImage" name="updateImage">
                        </div>
                        <div class="mb-4">
                            <label class="label-style" for="updateCategory">Категория</label>
                            <select class="form-select" id="updateCategory" name="updateCategory">
                                <option selected disabled>Выберите категорию</option>
                                <option id="updateOption" selected></option>
                                <?php if (!empty($allCategories)) : ?>
                                    <?php foreach ($allCategories as $category) : ?>
                                        <option value="<?= $category['id']; ?>"><?= $category['name']; ?></option>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <option>Нет категорий</option>
                                <?php endif; ?>
                            </select>
                        </div>
                        <div class="mb-5">
                            <div class="d-flex align-items-center">
                                <div class="form-check form-check-inline mb-0">
                                    <input class="form-check-input" type="radio" name="updateStatus" id="updateStatus1" value="0">
                                    <label class="form-check-label pt-1" for="updateStatus1">Не публиковать</label>
                                </div>
                                <div class="form-check form-check-inline mb-0">
                                    <input class="form-check-input" type="radio" name="updateStatus" id="updateStatus2" value="1">
                                    <label class="form-check-label pt-1" for="updateStatus2">Публиковать</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="updatePostsBtn" id="updatePostsBtn" class="btn btn-primary">Изменить</button>
                </div>
            </form>
        </div>
    </div>
</div>