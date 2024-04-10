<?php 
session_start();

require_once '../../helpers/path.php'; 

if(!empty($_SESSION['username'] && $_SESSION['email'])) {
   header('Location: ' . BASE_URL . 'views');
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Sign in</title>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
   <link rel="stylesheet" href="../../assets/css/icon.css">
   <link rel="stylesheet" href="../../assets/css/reset.css">
   <link rel="stylesheet" href="../../assets/css/authorization/authorization.css">
</head>

<body>
   <section class="authorization">
      <div class="container">
         <div class="row">
            <div class="col-12">
               <h2 class="title text-center mb-4">Вход</h2>
               <div class="row">
                  <div class="col-12">
                     <div class="form-container mx-auto">
                        <form id="signInForm">
                           <div class="mb-4">
                              <label class="fs-6 mb-2" for="signInEmail">Почта</label>
                              <input type="text" class="form-control" name="signInEmail" id="signInEmail" aria-label="Почта" placeholder="Введите данные" required />
                           </div>
                           <div class="mb-4">
                              <label class="fs-6 mb-2" for="signInPassword">Пароль</label>
                              <input type="password" class="form-control" name="signInPassword" id="signInPassword" aria-label="Пароль" placeholder="Введите данные" required />
                           </div>
                           <div class="d-flex align-items-center mb-5">
                              <input class="form-check-input show-password m-0 p-0 me-2" type="checkbox" id="signInCheck" />
                              <label class="form-check-label show-password m-0 p-0" for="signInCheck">Показать пароль</label>
                           </div>
                           <div class="d-flex justify-content-between align-items-center">
                              <button type="submit" id="signInAddBtn" class="btn btn-primary" name="signInAdd">
                                 <i class="fa-solid fa-arrow-right-to-bracket me-2"></i>Войти
                              </button>
                              <a href="<?= BASE_URL . 'views/authorization/signUp.php'; ?>" class="link">Регистрация</a>
                           </div>
                        </form>
                     </div>
                  </div>
               </div>
               <div class="row mt-5">
                  <div class="col-12 text-center">
                     <a href="<?= BASE_URL . 'views'; ?>" class="btn btn-secondary">Главная</a>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </section>

   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
   </script>
   <script type="text/javascript" src="../../assets/js/jquery-3.7.1.js"></script>
   <script src="../../assets/js/authorization/signIn.js"></script>
</body>

</html>