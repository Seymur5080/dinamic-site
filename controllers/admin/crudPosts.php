<?php

/**
 * Connecting files
 */
require_once '../../controllers/sessionInfo.php';
require_once '../../helpers/clearData.php';
require_once '../../models/database.php';
require_once '../../config.php';

/**
 * Insert posts in DB
 */
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['addPostsBtn']) && $_POST['addPostsBtn'] != 'undefined') {
    if ($_POST['action'] === 'addPosts') {
        addPosts();
    }
}
/**
 * Function addPosts for insert posts in DB
 */
function addPosts()
{
    $postData           = $_POST;
    $fileData           = $_FILES;
    $errors             = [];
    $success            = [];

    $resultClearData    = clearData($postData);
    $name               = $resultClearData['addName'];
    $description        = $resultClearData['addDesc'];
    $category           = $resultClearData['addCategory'];
    $status             = $resultClearData['addStatus'];

    $imageName          = $fileData['addImage']['name'];
    $imageType          = $fileData['addImage']['type'];
    $imageTmpName       = $fileData['addImage']['tmp_name'];
    $imageError         = $fileData['addImage']['error'];
    $imageSize          = $fileData['addImage']['size'];

    $extension          = pathinfo($imageName, PATHINFO_EXTENSION);
    $newImageName       = uniqid() . '.' . $extension;
    $destination        = ROOT_PATH . '\assets\img\posts\\' . $newImageName;

    if (empty($name)) {
        $errors[] = 'Введите название записи!';
    } else if (mb_strlen($name) < 2) {
        $errors[] = 'Название записи должно состоять минимум из 2 букв!';
    } else if (!preg_match('/[a-zA-Zа-яА-ЯёЁ]/', $name)) {
        $errors[] = 'В названии записи не может быть цифер!';
    }

    if (empty($description)) {
        $errors[] = 'Введите описание записи!';
    } else if (mb_strlen($description) < 2) {
        $errors[] = 'Описание записи должно состоять минимум из 2 букв!';
    } else if (is_numeric($description)) {
        $errors[] = 'Описание записи не может состоять только из цифер!';
    }

    if (empty($category)) {
        $errors[] = 'Выберите категорию!';
    } else {
        $resultSelectOne = selectOne('categories', ['id' => $category]);

        if (empty($resultSelectOne['id'])) {
            $errors[] = 'Выбранная категория не существует!';
        } else if ($resultSelectOne['id'] != $category) {
            $errors[] = 'Выбранная категория не соответствует категории из базы данных!';
        }
    }

    if ($status === null) {
        $errors[] = 'Выберите статус публикации!';
    } else {
        $status = $status == 0 ? 0 : 1;
    }

    if (empty($imageName)) {
        $errors[] = 'Выберите изображение!';
    } else if (strpos($imageType, 'image') === false) {
        $errors[] = 'Может быть загружено только изображение!';
    } else {
        $resultMoveUploadFile = move_uploaded_file($imageTmpName, $destination);

        if ($resultMoveUploadFile) {
            $postData['addImage'] = $newImageName;
        } else {
            $errors[] = 'Ошибка загрузки изображения на сервер!';
        }
    }

    if (count($errors) > 0) {
        die(json_encode(['status' => 'warning', 'message' => $errors]));
    }

    $insertData = [
        'id_user'           => $_SESSION['id'],
        'name'              => $name,
        'description'       => $description,
        'image'             => $postData['addImage'],
        'id_categories'     => $category,
        'status'            => $status,
        'top_status'        => 0
    ];

    
    insert('posts', $insertData);

    $success[] = 'Запись успешно добавлена!';

    if (count($success) > 0) {
        die(json_encode(['status' => 'success', 'message' => $success]));
    }
}


/**
 * Ajax for get category by category id
 */

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($_POST['action'] === 'ajaxForIdCategory') {
        $data = ajaxForIdCategory();

        die(json_encode(['data' => $data]));
    }
}
/**
 * Function ajaxForIdCategory for get category by category id
 */
function ajaxForIdCategory()
{
    $id = $_POST['idCategories'];
    $result = selectOne('categories', ['id' => $id]);

    return $result;
}


/**
 * Update posts in DB
 */
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['updatePostsBtn']) && $_POST['updatePostsBtn'] != 'undefined') {
    if ($_POST['action'] === 'updatePosts') {
        updatePosts();
    }
}
/**
 * Function updatePosts for update posts in DB
 */
function updatePosts()
{
    $postData           = $_POST;
    $fileData           = $_FILES;
    $errors             = [];
    $success            = [];

    $resultClearData    = clearData($postData);
    $id                 = $resultClearData['updateId'];
    $name               = $resultClearData['updateName'];
    $description        = $resultClearData['updateDesc'];
    $category           = $resultClearData['updateCategory'];
    $status             = $resultClearData['updateStatus'];

    $imageName          = $fileData['updateImage']['name'];
    $imageType          = $fileData['updateImage']['type'];
    $imageTmpName       = $fileData['updateImage']['tmp_name'];
    $imageError         = $fileData['updateImage']['error'];
    $imageSize          = $fileData['updateImage']['size'];

    $extension          = pathinfo($imageName, PATHINFO_EXTENSION);
    $newImageName       = uniqid() . '.' . $extension;
    $destination        = ROOT_PATH . '\assets\img\posts\\' . $newImageName;

    if (empty($id)) {
        $errors[] = 'Id категории не существует!';
    }

    if (empty($name)) {
        $errors[] = 'Введите название записи!';
    } else if (mb_strlen($name) < 2) {
        $errors[] = 'Название записи должно состоять минимум из 2 букв!';
    } else if (!preg_match('/[a-zA-Zа-яА-ЯёЁ]/', $name)) {
        $errors[] = 'В названии записи не может быть цифер!';
    }

    if (empty($description)) {
        $errors[] = 'Введите описание записи!';
    } else if (mb_strlen($description) < 2) {
        $errors[] = 'Описание записи должно состоять минимум из 2 букв!';
    } else if (is_numeric($description)) {
        $errors[] = 'Описание записи не может состоять только из цифер!';
    }

    if (empty($category)) {
        $errors[] = 'Выберите категорию!';
    } else {
        $resultSelectOne = selectOne('categories', ['id' => $category]);

        if (empty($resultSelectOne['id'])) {
            $errors[] = 'Выбранная категория не существует!';
        } else if ($resultSelectOne['id'] != $category) {
            $errors[] = 'Выбранная категория не соответствует категории из базы данных!';
        }
    }

    if ($status === null) {
        $errors[] = 'Выберите статус публикации!';
    } else {
        $status = $status == 0 ? 0 : 1;
    }

    if (empty($imageName)) {
        $errors[] = 'Выберите изображение!';
    } else if (strpos($imageType, 'image') === false) {
        $errors[] = 'Может быть загружено только изображение!';
    } else {
        $resultMoveUploadFile = move_uploaded_file($imageTmpName, $destination);

        if ($resultMoveUploadFile) {
            $postData['updateImage'] = $newImageName;
        } else {
            $errors[] = 'Ошибка загрузки изображения на сервер!';
        }
    }

    if (count($errors) > 0) {
        die(json_encode(['status' => 'warning', 'message' => $errors]));
    }

    $insertData = [
        'id_user'           => $_SESSION['id'],
        'name'              => $name,
        'description'       => $description,
        'image'             => $postData['updateImage'],
        'id_categories'     => $category,
        'status'            => $status,
        'top_status'        => 0
    ];

    update('posts', $id, $insertData);

    $success[] = 'Категория успешна изменена!';

    if (count($success) > 0) {
        die(json_encode(['status' => 'success', 'message' => $success]));
    }
}


/**
 * Delete posts in DB
 */
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['id']) && $_POST['id'] != 'undefined') {
    if ($_POST['action'] === 'deletePosts') {
        deletePosts();
    }
}
/**
 * Function deletePosts for delete posts in DB
 */
function deletePosts()
{
    $id         = $_POST['id'];
    $errors     = [];
    $success    = [];

    $resultSelectOne = selectOne('categories', ['id' => $id]);

    if (empty($resultSelectOne) && empty($resultSelectOne['id'])) {
        $errors[] = 'Id записи не существует!';
    } else {
        if ($id !== $resultSelectOne['id']) {
            $errors[] = 'Такой записи не существует!';
        }
    }

    if (count($errors) > 0) {
        die(json_encode(['status' => 'warning', 'message' => $errors]));
    }

    delete('posts', $id);

    $success[] = 'Запись успешно удалена!';

    if (count($success) > 0) {
        die(json_encode(['status' => 'success', 'message' => $success]));
    }
}


/**
 * Change character status in posts from admin panel
 */
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['id'])) {
    if ($_POST['action'] === 'statusBtn') {
        statusBtn();
    }
}
/**
 * Function statusBtn for change character status in posts from admin panel
 */
function statusBtn()
{
    $postData   = $_POST;
    $id         = $postData['id'];
    $status     = $postData['status'];
    $errors     = [];

    // if (empty($id)) {
    //     $errors[] = 'Id статуса не существует!';
    // }

    if ($status == '') {
        $errors[] = 'Статус не существует!';
    }

    if (count($errors) > 0) {
        die(json_encode(['status' => 'warning', 'message' => $errors]));
    }

    switch ($status) {
        case 0:
            $status = 1;
            break;
        case 1:
            $status = 0;
            break;
        default:
            $status = '';
            break;
    }

    update('posts', $id, ['status' => $status]);

    die(json_encode(['status' => 'success', 'data' => $status]));
}


/**
 * Change character top status in posts from admin panel
 */
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['id'])) {
    if ($_POST['action'] === 'topStatusBtn') {
        topStatusBtn();
    }
}
/**
 * Function topStatusBtn for change character status in posts from admin panel
 */
function topStatusBtn()
{
    $postData   = $_POST;
    $id         = $postData['id'];
    $topStatus  = $postData['topStatus'];
    $errors     = [];

    if ($topStatus == '') {
        $errors[] = 'Статус не существует!';
    }

    if (count($errors) > 0) {
        die(json_encode(['status' => 'warning', 'message' => $errors]));
    }

    switch ($topStatus) {
        case 0:
            $topStatus = 1;
            break;
        case 1:
            $topStatus = 0;
            break;
        default:
            $topStatus = '';
            break;
    }

    update('posts', $id, ['top_status' => $topStatus]);

    die(json_encode(['status' => 'success', 'data' => $topStatus]));
}