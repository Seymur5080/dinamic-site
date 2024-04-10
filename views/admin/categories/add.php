<?php
require_once '../../../controllers/sessionInfo.php';
require_once '../../../helpers/path.php';
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
                <h2 class="h2 text-center mt-3 mb-5">Добавление категории</h2>
                <div class="form-container mx-auto">
                    <form id="add-categories">
                        <div class="mb-4">
                            <label class="label-style" for="addName">Название категории</label>
                            <input type="text" class="form-control patternName" name="addName" id="addName" placeholder="Введите данные" pattern="[A-Za-zА-Яа-яЁё\s]+" required />
                        </div>
                        <div class="mb-4">
                            <label class="label-style" for="addDesc">Описание категории</label>
                            <textarea class="form-control" name="addDesc" id="addDesc" cols="10" placeholder="Введите данные" required></textarea>
                            <!-- <div id="editor">
                                <p>Введите данные</p>
                            </div> -->
                        </div>
                        <button type="submit" name="addCategoriesBtn" id="addCategoriesBtn" class="btn btn-primary">Сохранить</button>
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
    <script src="../../../assets/js/admin/crudCategories.js"></script>
</body>

</html>