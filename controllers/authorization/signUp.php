<?php
/**
 * Connecting files
 */
require_once '../../helpers/clearData.php';
require_once '../../models/database.php';


/**
 * Function for sign up
 */
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['signUpAdd']) && $_POST['signUpAdd'] != 'undefined') {
    $postData   = $_POST;
    $errors     = [];
    $success    = [];

    if (isset($postData)) {
        $clearPostData = clearData($postData);

        $login              = $clearPostData['signUpLogin'];
        $email              = $clearPostData['signUpEmail'];
        $firtyPassword      = $clearPostData['signUpPassword'];
        $secondPassword     = $clearPostData['signUpPasswordRepeat'];


        /** 
         * Conditions for login 
         */
        if (empty($login)) {
            $errors[] = 'Логин не может быть пустым!';
        } else if (mb_strlen($login) < 5) {
            $errors[] = 'Длина логина должно превышать 4 символа!';
        } else if (mb_strlen($login) > 16) {
            $errors[] = 'Длина логина не должно превышать 16 символов!';
        } else if (preg_match("/[а-яА-Я]/u", $login)) {
            $errors[] = 'Логин не должен содержать русские символы!';
        } else if (!preg_match("/[A-Z]/", $login)) {
            $errors[] = 'Логин должен содержать мининмум одну большую английскую букву!';
        } else if (!preg_match("/[.!]/", $login)) {
            $errors[] = 'Логин должен содержать мининмум одну из этих символов (.!)';
        } else if (!preg_match("/\d/", $login)) {
            $errors[] = 'Логин должен содержать мининмум одну цифру!';
        }


        /**
         * Conditions for email 
         */
        if (empty($email)) {
            $errors[] = 'Почта не может быть пустой!';
        } else if (mb_strlen($email) > 255) {
            $errors[] = 'Длина почты не должно превышать 255 символов!';
        } else if (preg_match("/[а-яА-Я]/u", $email)) {
            $errors[] = 'Почта не должна содержать русские символы!';
        } else if (!preg_match("/[@]/", $email)) {
            $errors[] = 'Почта должна содержать символ @';
        } else if (preg_match("/[а-яА-Я]/u", $email)) {
            $errors[] = 'Почта не должна содержать русские символы!';
        }


        /**
         * Conditions for passwords 
         */
        if ($firtyPassword != $secondPassword) {
            $errors[] = 'Пароли должны быть одинаковыми!';
        } else {
            if (empty($firtyPassword)) {
                $errors[] = 'Пароль не может быть пустой!';
            } else if (mb_strlen($firtyPassword) > 255) {
                $errors[] = 'Длина пароля не должно превышать 255 символов!';
            } else if (preg_match("/[а-яА-Я]/u", $firtyPassword)) {
                $errors[] = 'Пароль не должен содержать русские символы!';
            }

            if (empty($secondPassword)) {
                $errors[] = 'Повторный пароль не может быть пустой!';
            } else if (mb_strlen($secondPassword) > 255) {
                $errors[] = 'Длина повторного пароля не должно превышать 255 символов!';
            } else if (preg_match("/[а-яА-Я]/u", $secondPassword)) {
                $errors[] = 'Повторный пароль не должен содержать русские символы!';
            }
        }

        $resultSelectOne = selectOne('users', ['email' => $email]);
        
        if ($resultSelectOne !== false && $resultSelectOne['email'] == $email) {
            $errors[] = 'Данная почта существует!';
        } else {
            if ($firtyPassword == $secondPassword) {
                $passwordHash = password_hash($firtyPassword, PASSWORD_DEFAULT);
            }
        }
    
        if (count($errors) > 0) {
            die(json_encode(['status' => 'warning', 'message' => $errors]));
        }

        $insertData = [
            'admin'     => 0,
            'username'  => $login,
            'email'     => $email,
            'password'  => $passwordHash,
        ];

        insert('users', $insertData);

        $success[] = 'Регистрация успешно пройдена!';

        if (count($success) > 0) {
            die(json_encode(['status' => 'success', 'message' => $success]));
        }
    }
}