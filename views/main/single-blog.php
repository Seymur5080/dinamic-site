<?php

session_start();

require_once '../../controllers/sessionInfo.php';
require_once '../../helpers/path.php';
require_once '../../models/database.php';

$onePost                = selectOnePostByMain('posts', 'users', $_GET['id']);
$fullUrlSingleBlogPage  = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
$allCommentsByPage      = selectAllCommentsByPageNumber('comments', 'users', $_GET['id']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Dinamic web site</title>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
   <link rel="stylesheet" href="../../assets/css/icon.css">
   <link rel="stylesheet" href="../../assets/css/reset.css">
   <link rel="stylesheet" href="../../assets/css/main/style.css">
</head>

<body>
   <?php require_once 'header.php'; ?>

   <section class="single-blog py-5">
      <div class="container">
         <div class="row pt-3">
            <?php if (!empty($onePost)) : ?>
               <div class="col-12 col-md-9">
                  <h2 class="title mb-4">
                     <?= $onePost['name']; ?>
                  </h2>
                  <img src="<?= BASE_URL . 'assets/img/posts/' . $onePost['image']; ?>" class="img-thumbnail img-fluid single-blog__image w-100 mb-3" alt="Single blog image" />
                  <div class="d-flex align-items-center mb-4">
                     <div class="author me-4">
                        <i class="fa-solid fa-user me-1"></i>
                        <span><?= $onePost['username']; ?></span>
                     </div>
                     <div class="date">
                        <i class="fa-solid fa-calendar-days me-1"></i>
                        <span><?= date('d-m-Y H:i:s', strtotime($onePost['created_at'])); ?></span>
                     </div>
                  </div>
                  <p class="text mb-5"><?= $onePost['description']; ?></p>
                  <?php require_once 'comment.php'; ?>
               </div>
            <?php endif; ?>
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
   <script src="../../assets/js/main/script.js"></script>
</body>

</html>