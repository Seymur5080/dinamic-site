<?php
require_once '../../../controllers/sessionInfo.php';
require_once '../../../models/database.php';
require_once '../../../helpers/path.php';

$allCategories = selectAll('categories');
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
                <h2 class="h2 text-center mt-3 mb-3">Добавление записи</h2>
                <div class="form-container mx-auto">
                    <form id="add-posts" enctype="multipart/form-data">
                        <div class="mb-4">
                            <label class="label-style" for="name">Название записи</label>
                            <input type="text" class="form-control" name="addName" id="name" placeholder="Введите данные" aria-label="Запись" required/>
                        </div>
                        <!-- <div class="mb-3">
                            <label class="label-style" for="editor">Содержимое записи</label>
                            <textarea name="" id="editor" cols="30" rows="10"></textarea>
                        </div> -->
                        <div class="mb-4">
                            <label class="label-style" for="desc">Описание записи</label>
                            <textarea class="form-control" name="addDesc" id="desc" cols="10" placeholder="Введите данные" aria-label="Категория" required></textarea>
                        </div>
                        <div class="mb-4">
                            <label class="label-style" for="image" class="form-label">Изображение</label>
                            <input class="form-control" type="file" id="image" name="addImage" aria-label="Изображение" required>
                        </div>
                        <div class="mb-4">
                            <label class="label-style" for="category">Категория</label>
                            <select class="form-select" id="category" aria-label="Категория" name="addCategory" aria-label="Категория" required>
                                <option value="" selected disabled>Выберите категорию</option>
                                <?php if (!empty($allCategories)) : ?>
                                    <?php foreach ($allCategories as $allCategories) : ?>
                                        <option value="<?= $allCategories['id']; ?>"><?= $allCategories['name']; ?></option>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <option>Нет категорий</option>
                                <?php endif; ?>
                            </select>
                        </div>
                        <div class="mb-5">
                            <div class="d-flex align-items-center">
                                <div class="form-check form-check-inline mb-0">
                                    <input class="form-check-input" type="radio" name="addStatus" id="status1" value="0" aria-label="Не опубликовывать">
                                    <label class="form-check-label pt-1" for="status1">Не опубликовывать</label>
                                </div>
                                <div class="form-check form-check-inline mb-0">
                                    <input class="form-check-input" type="radio" name="addStatus" id="status2" value="1" aria-label="Публиковать">
                                    <label class="form-check-label pt-1" for="status2">Публиковать</label>
                                </div>
                            </div>
                        </div>
                        <button type="submit" id="addPostsBtn" class="btn btn-primary" name="addPostsBtn" aria-label="Сохранить">Сохранить</button>
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
    <script src="../../../assets/js/admin/crudPosts.js"></script>
</body>

</html>