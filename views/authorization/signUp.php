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
   <title>Sign Up</title>
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
               <h2 class="title text-center mb-4">Регистрация</h2>
               <div class="row">
                  <div class="col-12">
                     <div class="form-container mx-auto">
                        <form id="signUpForm">
                           <div class="mb-4">
                              <label class="fs-6 mb-2" for="signUpLogin">Логин</label>
                              <input type="text" class="form-control" name="signUpLogin" id="signUpLogin" aria-label="Логин" placeholder="Введите данные" required/>
                           </div>
                           <div class="mb-4">
                              <label class="fs-6 mb-2" for="signUpEmail">Почта</label>
                              <input type="text" class="form-control" name="signUpEmail" id="signUpEmail" aria-label="Почта" placeholder="Введите данные" required/>
                           </div>
                           <div class="mb-4">
                              <label class="fs-6 mb-2" for="signUpPassword">Пароль</label>
                              <input type="password" class="form-control" name="signUpPassword" id="signUpPassword" aria-label="Пароль" placeholder="Введите данные" required/>
                           </div>
                           <div class="mb-4">
                              <label class="fs-6 mb-2" for="signUpPasswordRepeat">Повторите пароль</label>
                              <input type="password" class="form-control" name="signUpPasswordRepeat" id="signUpPasswordRepeat" aria-label="Повторите пароль" placeholder="Введите данные" required/>
                           </div>
                           <div class="d-flex align-items-center mb-5">
                              <input class="form-check-input show-password m-0 p-0 me-2" type="checkbox" id="signUpCheck">
                              <label class="form-check-label show-password m-0 p-0" for="signUpCheck">Показать пароль</label>
                           </div>
                           <div class="d-flex justify-content-between align-items-center">
                              <button type="submit" id="signUpAddBtn" class="btn btn-primary" name="signUpAdd">
                                 <i class="fa-solid fa-user-plus me-2"></i>Регистрация
                              </button>
                              <a href="<?= BASE_URL . 'views/authorization/signIn.php'; ?>" class="link">Вход</a>
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
   <script src="../../assets/js/authorization/signUp.js"></script>
</body>

</html>