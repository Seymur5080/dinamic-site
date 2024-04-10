<?php

/**
 * Connecting files
 */
require_once '../../models/database.php';
require_once '../../helpers/clearData.php';


/**
 * Insert categories in DB
 */
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['addCategoriesBtn']) && $_POST['addCategoriesBtn'] != 'undefined') {
    if ($_POST['action'] === 'addCategories') {
        addCategories();
    }
}
/**
 * Function for insert categories in DB
 */
function addCategories()
{
    $postData           = $_POST;
    $errors             = [];
    $success            = [];

    $resultClearData    = clearData($postData);
    $name               = $resultClearData['addName'];
    $description        = $resultClearData['addDesc'];

    if (empty($name)) {
        $errors[] = 'Введите название категории!';
    } else if (mb_strlen($name) < 2) {
        $errors[] = 'Название категории должно состоять минимум из 2 букв!';
    } else if (!preg_match('/[a-zA-Zа-яА-ЯёЁ]/', $name)) {
        $errors[] = 'В названии категории не может быть цифер!';
    }

    if (empty($description)) {
        $errors[] = 'Введите описание категории!';
    } else if (mb_strlen($description) < 2) {
        $errors[] = 'Описание категории должно состоять минимум из 2 букв!';
    } else if (is_numeric($description)) {
        $errors[] = 'Описание категории не может состоять только из цифер!';
    }

    $resultSelectOne = selectOne('categories', ['name' => $name]);

    if ($name === $resultSelectOne['name']) {
        $errors[] = 'Такая категория уже существует!';
    }

    if (count($errors) > 0) {
        die(json_encode(['status' => 'warning', 'message' => $errors]));
    }

    $insertData = [
        'name'          => $name,
        'description'   => $description
    ];

    insert('categories', $insertData);

    $success[] = 'Категория успешна добавлена!';

    if (count($success) > 0) {
        die(json_encode(['status' => 'success', 'message' => $success]));
    }
}


/**
 * Update categories in DB
 */
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['updateCategoriesBtn']) && $_POST['updateCategoriesBtn'] != 'undefined') {
    if ($_POST['action'] === 'updateCategories') {
        updateCategories();
    }
}
/**
 * Function updateCategories for update categories in DB
 */
function updateCategories()
{
    $postData           = $_POST;
    $errors             = [];
    $success            = [];

    $resultClearData    = clearData($postData);
    $id                 = $resultClearData['updateId'];
    $description        = $resultClearData['updateDesc'];

    if (empty($id)) {
        $errors[] = 'Id категории не существует!';
    }

    if (empty($description)) {
        $errors[] = 'Введите описание категории!';
    } else if (mb_strlen($description) < 2) {
        $errors[] = 'Описание категории должно состоять минимум из 2 букв!';
    } else if (is_numeric($description)) {
        $errors[] = 'Описание категории не может состоять только из цифер!';
    }

    if (count($errors) > 0) {
        die(json_encode(['status' => 'warning', 'message' => $errors]));
    }

    $insertData = [
        'description'   => $description
    ];

    update('categories', $id, $insertData);

    $success[] = 'Категория успешна изменена!';

    if (count($success) > 0) {
        die(json_encode(['status' => 'success', 'message' => $success]));
    }
}


/**
 * Delete categories from DB
 */
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id']) && $_POST['id'] != 'undefined') {
    if ($_POST['action'] === 'deleteCategories') {
        deleteCategories();
    }
}
/**
 * Function deleteCategories for delete categories from DB
 */
function deleteCategories()
{
    $id         = $_POST['id'];
    $errors     = [];
    $success    = [];

    $resultSelectOne = selectOne('categories', ['id' => $id]);

    if (empty($resultSelectOne) && empty($resultSelectOne['id'])) {
        $errors[] = 'Id категории не существует!';
    } else {
        if ($id !== $resultSelectOne['id']) {
            $errors[] = 'Такой категории не существует!';
        }
    }

    if (count($errors) > 0) {
        die(json_encode(['status' => 'warning', 'message' => $errors]));
    }

    delete('categories', $id);

    $success[] = 'Категория успешно удалена!';

    if (count($success) > 0) {
        die(json_encode(['status' => 'success', 'message' => $success]));
    }
}