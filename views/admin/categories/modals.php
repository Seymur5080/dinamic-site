<!-- Modal for update -->
<div class="modal fade" id="updateCategoriesModal" tabindex="-1" aria-labelledby="updateCategoriesModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="update-categories">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="updateCategoriesModalLabel">Изменить</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-container">
                        <input type="hidden" name="updateId" id="updateId">
                        <div class="mb-4">
                            <label class="label-style" for="updateName">Название категории</label>
                            <input type="text" class="form-control patternName" name="updateName" id="updateName" placeholder="Введите данные" pattern="[A-Za-zА-Яа-яЁё\s]+" required disabled/>
                        </div>
                        <div class="mb-4">
                            <label class="label-style" for="updateDesc">Описание категории</label>
                            <textarea class="form-control" name="updateDesc" id="updateDesc" cols="10" placeholder="Введите данные" required></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="updateCategoriesBtn" id="updateCategoriesBtn" class="btn btn-primary">Изменить</button>
                </div>
            </form>
        </div>
    </div>
</div>