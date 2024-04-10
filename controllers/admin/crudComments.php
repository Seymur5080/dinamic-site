<?php

/**
 * Connecting files
 */
require_once '../../models/database.php';
require_once '../../helpers/clearData.php';


/**
 * Update comments in DB
 */
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['updateCommentsBtn']) && $_POST['updateCommentsBtn'] != 'undefined') {
    if ($_POST['action'] === 'updateComments') {
        updateComments();
    }
}
/**
 * Function updateComments for update categories in DB
 */
function updateComments()
{
    $postData           = $_POST;
    $errors             = [];
    $success            = [];

    if (!empty($postData)) {
        $resultClearData    = clearData($postData);
        $id                 = $resultClearData['updateId'];
        $comment            = $resultClearData['updateComments'];
        $status             = $resultClearData['updateStatus'];

        if (empty($id)) {
            $errors[] = 'Id комментария не существует!';
        }

        if (empty($comment)) {
            $errors[] = 'Введите комментарий!';
        } else if (mb_strlen($comment) < 2) {
            $errors[] = 'Комментарий должен состоять минимум из 2 букв!';
        } else if (is_numeric($comment)) {
            $errors[] = 'Комментарий не может состоять только из цифер!';
        }

        if ($status === null) {
            $errors[] = 'Выберите статус комментария!';
        } else {
            $status = $status == 0 ? 0 : 1;
        }

        if (count($errors) > 0) {
            die(json_encode(['status' => 'warning', 'message' => $errors]));
        }

        $insertData = [
            'comment'   => $comment,
            'status'    => $status
        ];

        update('comments', $id, $insertData);

        $success[] = 'Комментарий успешно изменён!';

        if (count($success) > 0) {
            die(json_encode(['status' => 'success', 'message' => $success]));
        }
    }
}


/**
 * Change character status in comments from admin panel
 */
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['id'])) {
    if ($_POST['action'] === 'statusBtn') {
        statusBtn();
    }
}
/**
 * Function statusBtn for change character status in comments from admin panel
 */
function statusBtn()
{
    $postData   = $_POST;
    $id         = $postData['id'];
    $status     = $postData['status'];
    $errors     = [];

    if (!empty($postData)) {
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
    
        update('comments', $id, ['status' => $status]);
    
        die(json_encode(['status' => 'success', 'data' => $status]));
    }
}


/**
 * Delete comments from DB
 */
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id']) && $_POST['id'] != 'undefined') {
    if ($_POST['action'] === 'deleteComments') {
        deleteComments();
    }
}
/**
 * Function deleteComments for delete comments from DB
 */
function deleteComments()
{
    $id         = $_POST['id'];
    $errors     = [];
    $success    = [];

    $resultSelectOne = selectOne('comments', ['id' => $id]);

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

    delete('comments', $id);

    $success[] = 'Комментарий успешно удалён!';

    if (count($success) > 0) {
        die(json_encode(['status' => 'success', 'message' => $success]));
    }
}