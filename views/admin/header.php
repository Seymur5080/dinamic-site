<?php session_start(); ?>

<header class="header">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <h1 class="h1 m-0"><a href="<?= BASE_URL . 'views'; ?>" class="header__link">My blog</a></h1>
            </div>
            <div class="col-md-8 d-flex justify-content-end align-items-center">
                <nav class="nav">
                    <ul class="main-ul">
                        <li>
                            <div class="dropdown">
                                <a href="#" onclick="event.preventDefault();" class="dropdown-toggle noUser" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa-regular fa-user me-2"></i><?= $userName; ?>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a href="logOut.php" class="dropdown-item logOut">Выйти</a></li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</header>