<?php

/**
 * Connecting files
 */
require_once '../../controllers/sessionInfo.php';
require_once '../../helpers/clearData.php';
require_once '../../models/database.php';
require_once '../../config.php';

/**
 * Search post in main page
 */
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['search']) && $_POST['search'] != 'undefined') {
    searchPostsInMainPage();
}
/**
 * Function searchPosts search post in main page 
 */
function searchPostsInMainPage()
{
    $id         = $_POST['id'];
    $searchText = $_POST['search'];
    $pageUrl    = $_POST['pageUrl'];
    $data       = '';

    if (mb_strpos($pageUrl, 'category.php')) {
        $data = selectPostsBySearchPostsInCategoryPage($searchText, 'categories', 'posts', 'users', $id);
    } else {
        $data = selectPostsBySearchPostsInMainPage($searchText, 'posts', 'users');
    }

    die(json_encode(['data' => $data]));
}
