<?php
/**
 * Session start
 */
session_start();


/**
 * Connecting files
 */
require_once '../../helpers/clearData.php';
require_once '../../models/database.php';


/**
 * Function for sign in
 */
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['signInAdd']) && $_POST['signInAdd'] != 'undefined') {
    $postData   = $_POST;
    $errors     = [];
    $success    = [];

    if (isset($postData)) {
        $resultClearData = clearData($postData);
        
        $email      = $resultClearData['signInEmail'];
        $password   = $resultClearData['signInPassword'];
        
        $resultSelectOne = selectOne('users', ['email' => $email]);

        if (!$resultSelectOne) {
            $errors[] = 'Вы ввели неправильную почту или пароль!';
        } else {
            if ($resultSelectOne['email'] != $email) {
                $errors[] = 'Вы ввели неправильную почту или пароль!';
            }

            if (!password_verify($password, $resultSelectOne['password'])) {
                $errors[] = 'Вы ввели неправильную почту или пароль!';
            }
        }
        
        if (count($errors) > 0) {
            die(json_encode(['status' => 'warning', 'message' => $errors]));
        }

        $_SESSION = [
            'id'            => $resultSelectOne['id'],
            'admin'         => $resultSelectOne['admin'],
            'username'      => $resultSelectOne['username'],
            'email'         => $resultSelectOne['email'],
        ];
        
        $success[] = 'Вход выполнен успешно!';

        if (count($success) > 0) {
            die(json_encode(['status' => 'success', 'message' => $success]));
        }
    }
}