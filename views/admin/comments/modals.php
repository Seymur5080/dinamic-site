<!-- Modal for update -->
<div class="modal fade" id="updateCommentsModal" tabindex="-1" aria-labelledby="updateCommentsModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="update-comments">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="updateCommentsModalLabel">Изменить</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-container">
                        <input type="hidden" name="updateId" id="updateId">
                        <div class="mb-4">
                            <label class="label-style" for="updateEmail">Почта</label>
                            <input type="text" class="form-control" id="updateEmail" placeholder="Введите данные" aria-label="Почта" disabled/>
                        </div>
                        <div class="mb-4">
                            <label class="label-style" for="updateComments">Комментарий</label>
                            <textarea class="form-control" name="updateComments" id="updateComments" rows="10" placeholder="Введите данные"></textarea>
                        </div>
                        <div>
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
                    <button type="submit" name="updateCommentsBtn" id="updateCommentsBtn" class="btn btn-primary">Изменить</button>
                </div>
            </form>
        </div>
    </div>
</div>