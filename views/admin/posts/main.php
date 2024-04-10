<?php
require_once '../../../controllers/sessionInfo.php';
require_once '../../../models/database.php';
require_once '../../../helpers/path.php';

$allPosts           = selectAllFromPostsWithUsers('posts', 'users', 'categories');
$allCategories      = selectAll('categories');
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
                <h2 class="h2 text-center mb-3">Управление записями</h2>
                <div class="d-flex justify-content-center align-items-center mb-5">
                    <a href="<?= BASE_URL . 'views/admin/posts/add.php'; ?>" class="btn btn-success me-3">Добавить</a>
                    <button class="btn btn-warning">Редактировать</button>
                </div>
                <?php
                require_once 'table.php';
                require_once 'modals.php';
                ?>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <script type="text/javascript" src="../../../assets/js/jquery-3.7.1.js"></script>
    <script src="../../../assets/js/logOut.js"></script>
    <script src="../../../assets/js/admin/crudPosts.js"></script>
</body>

</html>