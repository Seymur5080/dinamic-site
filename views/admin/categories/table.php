<h2 class="h2 text-center mb-3">Категории</h2>

<table class="table">
    <thead>
        <tr>
            <th class="text-center">ID</th>
            <th class="text-center">Название</th>
            <th class="text-center">Описание</th>
            <th class="text-center">Дата</th>
            <th class="text-center">Управление</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($allCategories)) : ?>
            <?php $count = 1; ?>
            <?php foreach ($allCategories as $categories) : ?>
                <tr>
                    <td class="text-center"><?= $count; ?></td>
                    <td class="text-center"><?= $categories['name']; ?></td>
                    <td class="text-center"><?= $categories['description']; ?></td>
                    <td class="text-center"><?= date('d-m-Y H:i:s', strtotime($categories['created_at'])); ?></td>
                    <td class="text-center">
                        <div class="d-flex justify-content-center align-items-center">
                            <button 
                                type="button" 
                                class="btn btn-warning btn-style me-2 updateBtn" 
                                data-bs-toggle="modal" 
                                data-bs-target="#updateCategoriesModal"
                                data-id="<?= $categories['id']; ?>"
                                data-name="<?= $categories['name']; ?>"
                                data-description="<?= $categories['description']; ?>"
                            >
                                <i class="fa-solid fa-pen-to-square fa-style"></i>
                            </button>
                            <button 
                                type="button" 
                                class="btn btn-danger btn-style deleteBtn" 
                                data-id="<?= $categories['id']; ?>"
                            >
                                <i class="fa-solid fa-trash fa-style"></i>
                            </button>
                        </div>
                    </td>
                </tr>
            <?php $count++; ?>
            <?php endforeach; ?>
        <?php else: ?>
            <td colspan="5" class="text-center"><span class="text-danger">Нет информации</span></td>
        <?php endif; ?>
    </tbody>
</table>