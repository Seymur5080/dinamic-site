<?php

session_start();

require_once '../models/database.php';

if (!empty($_SESSION)) {
    $admin          = $_SESSION['admin'];
    $username       = $_SESSION['username'];
    $email          = $_SESSION['email'];
    $error          = [];
    $success        = [];
    
    $resultSelectOne = selectOne('users', ['email' => $email]);

    if ($email == $resultSelectOne['email']) {
        session_destroy();

        $success[] = 'Выход выполнен успешно!';
    } else {
        $error[] = 'Произошла системная ошибка!';
    }

    if (count($error) > 0) {
        die(json_encode(['status' => 'warning', 'message' => $error]));
    }
    
    if (count($success) > 0) {
        die(json_encode(['status' => 'success', 'message' => $success]));
    }
}