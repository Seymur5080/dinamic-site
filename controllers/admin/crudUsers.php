<?php 

/**
 * Connecting files
 */
require_once '../../models/database.php';
require_once '../../helpers/clearData.php';

require_once '../../helpers/helper.php';

/**
 * Function for sign up users
 */
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['addUsersBtn']) && $_POST['addUsersBtn'] != 'undefined') {
    if ($_POST['action'] === 'addUsers') {
        addUsers();
    }
}
/**
 * Function addUsers for sign up users
 */
function addUsers()
{
    $postData           = $_POST;
    $errors             = [];
    $success            = [];

    $clearPostData      = clearData($postData);
    $login              = $clearPostData['addLogin'];
    $email              = $clearPostData['addEmail'];
    $firtyPassword      = $clearPostData['addPassword'];
    $secondPassword     = $clearPostData['addPasswordRepeat'];
    $character          = $clearPostData['addCharacter'];


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

    /**
     * Conditions for character 
     */
    if ($character == '') {
        $errors[] = 'Выберите роль пользователя!';
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
        'admin'     => $character,
        'username'  => $login,
        'email'     => $email,
        'password'  => $passwordHash,
    ];

    insert('users', $insertData);

    $success[] = 'Пользователь успешно добавлен!';

    if (count($success) > 0) {
        die(json_encode(['status' => 'success', 'message' => $success]));
    }
}


/**
 * Function for update users
 */
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['updateUsersBtn']) && $_POST['updateUsersBtn'] != 'undefined') {
    if ($_POST['action'] === 'updateUsers') {
        updateUsers();
    }
}
/**
 * Function updateUsers for update users
 */
function updateUsers()
{
    $postData           = $_POST;
    $errors             = [];
    $success            = [];

    $clearPostData      = clearData($postData);
    $id                 = $_POST['updateId'];
    $login              = $clearPostData['updateLogin'];
    $firtyPassword      = $clearPostData['updatePassword'];
    $secondPassword     = $clearPostData['updatePasswordRepeat'];
    $character          = $clearPostData['updateCharacter'];


    /** 
     * Conditions for id 
     */
    if (empty($id)) {
        $errors[] = 'Id пользователя не существует!';
    }


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


    /**
     * Conditions for character 
     */
    if ($character == '') {
        $errors[] = 'Выберите роль пользователя!';
    }

    
    if ($firtyPassword == $secondPassword) {
        $passwordHash = password_hash($firtyPassword, PASSWORD_DEFAULT);
    }
    

    if (count($errors) > 0) {
        die(json_encode(['status' => 'warning', 'message' => $errors]));
    }

    $insertData = [
        'admin'     => $character,
        'username'  => $login,
        'password'  => $passwordHash,
    ];

    update('users', $id, $insertData);

    $success[] = 'Пользователь успешно изменён!';

    if (count($success) > 0) {
        die(json_encode(['status' => 'success', 'message' => $success]));
    }
}


/**
 * Delete posts in DB
 */
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['id']) && $_POST['id'] != 'undefined') {
    if ($_POST['action'] === 'deleteUsers') {
        deleteUsers();
    }
}
/**
 * Function deletePosts for delete posts in DB
 */
function deleteUsers()
{
    $id         = $_POST['id'];
    $errors     = [];
    $success    = [];

    $resultSelectOne = selectOne('users', ['id' => $id]);

    if (empty($resultSelectOne) && empty($resultSelectOne['id'])) {
        $errors[] = 'Id пользователя не существует!';
    } else {
        if ($id !== $resultSelectOne['id']) {
            $errors[] = 'Такой записи не существует!';
        }
    }

    if (count($errors) > 0) {
        die(json_encode(['status' => 'warning', 'message' => $errors]));
    }

    delete('users', $id);

    $success[] = 'Пользователь успешно удалён!';

    if (count($success) > 0) {
        die(json_encode(['status' => 'success', 'message' => $success]));
    }
}


/**
 * Change character status in users from admin panel
 */
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['id'])) {
    if ($_POST['action'] === 'statusCharacterBtn') {
        statusCharacterBtn();
    }
}
/**
 * Function statusCharacterBtn for change character status in users from admin panel
 */
function statusCharacterBtn()
{
    $postData   = $_POST;
    $errors     = [];

    if (!empty($postData)) {
        $id         = $postData['id'];
        $character  = $postData['character'];

        if ($character == '') {
            $errors[] = 'Роль не существует!';
        }
    
        if (count($errors) > 0) {
            die(json_encode(['status' => 'warning', 'message' => $errors]));
        }
    
        switch($character) {
            case 0:
                $character = 1;
                break;
            case 1:
                $character = 0;
                break;
            default:
                $character = '';
                break;
        }
    
        update('users', $id, ['admin' => $character]);
    
        die(json_encode(['status' => 'success', 'data' => $character]));
    }
}