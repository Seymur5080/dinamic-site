<?php
require_once '../controllers/sessionInfo.php';
require_once '../models/database.php';
require_once '../helpers/path.php';

// require_once '../helpers/helper.php';

$pageNumber                = (isset($_GET['page']) && $_GET['page'] != 0) ? $_GET['page'] : 1;
$limitPosts                = 10;
$offset                    = ($pageNumber - 1) * $limitPosts;
$totalPosts                = ceil(countRowInMainPage('posts') / $limitPosts);

$allPosts                  = selectAllPostsByMain('posts', 'users', $limitPosts, $offset);
$allPostByTopCategories    = selectPostByTopCategories('posts', 'categories');
// dd($totalPosts);
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Blog</title>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
   <link rel="stylesheet" href="../assets/css/main/style.css">
</head>

<body>
   <?php require_once 'main/header.php'; ?>

   <?php require_once 'main/carousel.php'; ?>

   <?php require_once 'main/blog.php'; ?>

   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
   </script>
   <script type="text/javascript" src="../assets/js/jquery-3.7.1.js"></script>
   <script src="../assets/js/logOut.js"></script>
   <script src="../assets/js/main/script.js"></script>
</body>

</html>