<?php session_start(); ?>

<header class="header">
   <div class="container">
      <div class="row">
         <div class="col-md-4">
            <h1 class="h1 m-0"><a href="<?= BASE_URL . 'views'; ?>" class="header__link">My blog</a></h1>
         </div>
         <div class="col-md-8 d-flex justify-content-center align-items-center">
            <nav class="nav">
               <ul class="main-ul">
                  <li><a href="#">Главная</a></li>
                  <li><a href="#">О нас</a></li>
                  <li><a href="#">Услуги</a></li>
                  <li>
                     <?php if (!isset($userName)) : ?>
                        <a href="<?= BASE_URL . 'views/authorization/signIn.php'; ?>"><i class="fa-regular fa-user me-2"></i>Войти</a>
                     <?php else : ?>
                        <div class="dropdown">
                           <a href="#" onclick="event.preventDefault();" class="dropdown-toggle noUser" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                              <i class="fa-regular fa-user me-2"></i><?= $userName; ?>
                           </a>
                           <ul class="dropdown-menu">
                              <?php if ($_SESSION['admin'] == 1) : ?>
                                 <li><a href="<?= BASE_URL . 'views/admin/index.php'; ?>" class="dropdown-item">Админ панель</a></li>
                                 <li><a href="#" class="dropdown-item logOut">Выйти</a></li>
                              <?php else : ?>
                                 <li><a href="#" class="dropdown-item logOut">Выйти</a></li>
                              <?php endif; ?>
                           </ul>
                        </div>
                     <?php endif; ?>
                  </li>
               </ul>
            </nav>
         </div>
      </div>
   </div>
</header>