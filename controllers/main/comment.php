<?php

session_start();

/**
 * Connecting files
 */
require_once '../../models/database.php';
require_once '../../helpers/clearData.php';


/**
 * Add comments in DB
 */
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['addCommentBtn']) && $_POST['addCommentBtn'] != 'undefined') {
    if (!empty($_POST['action']) && $_POST['action'] == 'addComment') {
        addComment();
    }
}

/**
 * Function addComment for add comments in DB
 */
function addComment()
{
    $postData   = $_POST;
    $errors     = [];
    $success    = [];

    if (!empty($postData)) {
        if (empty($_SESSION['email'])) {
            die(json_encode(['status' => 'auth', 'message' => 'Для добавления комментария нужно войти!']));
        }

        $resultSelectOne    = selectOne('users', ['email' => $_SESSION['email']]);
        $email              = $resultSelectOne['email'];
        $resultClearData    = clearData($postData);
        $pageId             = $resultClearData['addCommentPageId'];
        $description        = $resultClearData['addCommentDesc'];
        $status             = 1;
        
        if (empty($email)) {
            $errors[] = 'Такого пользователя не существует!';
        }

        if (empty($pageId)) {
            $errors[] = 'Id страницы не существует!';
        }

        if (empty($description)) {
            $errors[] = 'Введите описание записи!';
        } else if (mb_strlen($description) < 2) {
            $errors[] = 'Описание записи должно состоять минимум из 2 букв!';
        } else if (is_numeric($description)) {
            $errors[] = 'Описание записи не может состоять только из цифер!';
        }

        if (count($errors) > 1) {
            die(json_encode(['status' => 'warning', 'message' => $errors]));
        }

        $insertData = [
            'email'     => $email,
            'comment'   => $description,
            'page'      => $pageId,
            'status'    => $status
        ];

        insert('comments', $insertData);

        $success[] = 'Комментарий успешно добавлен!';

        $data = selectAllCommentsByPageNumber('comments', 'users', $pageId);

        if (count($success) > 0) {
            die(json_encode(['status' => 'success', 'message' => $success, 'data' => $data, 'email' => $_SESSION['email']]));
        }
    }
}


/**
 * Delete comments from DB in single-blog page
 */
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id']) && $_POST['id'] != 'undefined') {
    if ($_POST['action'] === 'deleteCommentsInSingleBlogPage') {
        deleteCommentsInSingleBlogPage();
    }
}
/**
 * Function deleteComments for delete comments from DB in single-blog page
 */
function deleteCommentsInSingleBlogPage()
{
    $id         = $_POST['id'];
    $pageId     = $_POST['pageId'];
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

    $data = selectAllCommentsByPageNumber('comments', 'users', $pageId);

    if (count($success) > 0) {
        die(json_encode(['status' => 'success', 'message' => $success, 'data' => $data, 'email' => $_SESSION['email']]));
    }
}