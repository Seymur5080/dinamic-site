<?php
require_once '../../controllers/sessionInfo.php';
require_once '../../models/database.php';
require_once '../../helpers/path.php';

$titleCategory                  = selectOne('categories', ['id' => $_GET['id']]);
$selectCategoryWithHisPosts     = selectCategoryWithHisPosts('categories', 'posts', 'users', $_GET['id']);
$fullUrlCategoryPage            = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../../assets/css/main/style.css">
</head>

<body>
    <?php require_once 'header.php'; ?>

    <section class="blog py-5">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2 class="fs-4">Все записи из категории <?= (!empty($titleCategory['name'])) ? $titleCategory['name'] : "<span class='text-danger'>Нет категории</span>"; ?></h2>
                </div>
            </div>
            <div class="row pt-3">
                <div class="col-12 col-md-9 dinamic-blogs">
                    <?php if (!empty($selectCategoryWithHisPosts)) : ?>
                        <?php foreach ($selectCategoryWithHisPosts as $post) : ?>
                            <div class="row mb-3">
                                <div class="col-12 col-md-4">
                                    <img src="<?= BASE_URL . 'assets/img/posts/' . $post['image']; ?>" class="img-thumbnail" alt="<?= $post['name']; ?>" style="max-height: 210px; width: 100%; height:100%; object-fit: cover;">
                                </div>
                                <div class="col-12 col-md-8">
                                    <div class="box bg-white">
                                        <h3>
                                            <a href="<?= BASE_URL . 'views/main/single-blog.php?id=' . $post['id']; ?>" class="title">
                                                <?= (strlen($post['name']) > 20) ? mb_substr($post['name'], 0, 20, 'UTF-8') . '...' : $post['name']; ?>
                                            </a>
                                        </h3>
                                        <p>
                                            <?= (strlen($post['description']) > 250) ? mb_substr($post['description'], 0, 250, 'UTF-8') . '...' : $post['description']; ?>
                                        </p>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="author">
                                                <i class="fa-solid fa-user"></i> <?= $post['username']; ?>
                                            </div>
                                            <div class="date">
                                                <i class="fa-solid fa-calendar-days pe-2"></i>
                                                <?= date("d-m-Y H:i:s", strtotime($post['created_at'])); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <div>
                            <h4 class="fs-4 text-center text-danger">Нет информации</h4>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="col-12 col-md-3">
                    <?php require_once 'sidebar.php'; ?>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <script type="text/javascript" src="../../assets/js/jquery-3.7.1.js"></script>
    <script src="../../assets/js/logOut.js"></script>
    <script src="../../assets/js/admin/crudPosts.js"></script>
</body>

</html>