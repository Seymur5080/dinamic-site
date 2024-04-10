<?php

/**
 * Connecting other files
 */
require_once 'connect.php';


/**
 * Function for checking errors in query
 */
function errorCheck($query)
{
    $errorInfo = $query->errorInfo();

    if ($errorInfo[0] !== '00000') {
        echo $errorInfo[2];
        die;
    }

    return $errorInfo;
}


/**
 * Function for select all data from table in database
 */
function selectAll($table, $params = [])
{
    global $pdo;

    $sql = "SELECT * FROM $table";

    if (!empty($params)) {
        $i = 0;

        foreach ($params as $key => $value) {
            if (!is_numeric($value)) {
                $value = "'" . $value . "'";
            }

            if ($key === 'created_at') {
                $value = "DATE_FORMAT($value, '%d-%m-%Y %H:%i:%s')";
            }

            if ($i === 0) {
                $sql = $sql . " WHERE $key = $value";
            } else {
                $sql = $sql . " AND $key = $value";
            }

            $i++;
        }
    }

    $query = $pdo->prepare($sql);
    $query->execute();

    errorCheck($query);

    return $query->fetchAll();
}


/**
 * Function for select first data from table in database
 */
function selectOne($table, $params = [])
{
    global $pdo;

    $sql = "SELECT * FROM $table";

    if (!empty($params)) {
        $i = 0;

        foreach ($params as $key => $value) {
            if (!is_numeric($value)) {
                $value = "'" . $value . "'";
            }

            if ($i === 0) {
                $sql = $sql . " WHERE $key = $value";
            } else {
                $sql = $sql . " AND $key = $value";
            }

            $i++;
        }
    }

    // $sql = $sql . ' LIMIT 1';
    $query = $pdo->prepare($sql);
    $query->execute();

    errorCheck($query);

    return $query->fetch();
}

/**
 * Function for insert datas in database
 */
function insert($table, $data)
{
    global $pdo;

    $i = 0;
    $col = '';
    $val = '';
    foreach ($data as $key => $value) {
        if ($i === 0) {
            $col = $col . "$key";
            $val = $val . "?"; 
        } else {
            $col = $col . ", $key";
            $val = $val . ", ?";
        }
        $i++;
    }

    $sql = "INSERT INTO $table ($col) VALUES($val)";

    $query = $pdo->prepare($sql);
    $query->execute(array_values($data)); 
    errorCheck($query);
}



/**
 * Function for update datas in database
 */
function update($table, $id, $data)
{
    global $pdo;

    $i = 0;
    $str = '';
    foreach ($data as $key => $value) {
        if ($i === 0) {
            $str = $str . "$key = '$value'";
        } else {
            $str = $str . ", $key = '$value'";
        }

        $i++;
    }

    $sql = "UPDATE $table SET $str WHERE id = $id";

    $query = $pdo->prepare($sql);
    $query->execute($data);
    errorCheck($query);
}


/**
 * Function for delete datas in database 
 */
function delete($table, $id)
{
    global $pdo;

    $sql = "DELETE FROM $table WHERE id = $id";

    $query = $pdo->prepare($sql);
    $query->execute();
    errorCheck($query);
}


/**
 * Function for truncate table
 */
function turncateTable($table)
{
    global $pdo;

    $sql = "TRUNCATE TABLE $table";

    // $sql = "DELETE FROM $table";
    // $sql = "ALTER TABLE $table AUTO_INCREMENT = 1";

    $query = $pdo->prepare($sql);
    $query->execute();
}


/**
 * Function for select all only for table posts with users 
 */
function selectAllFromPostsWithUsers($table1, $table2, $table3)
{
    global $pdo;

    $sql = "
        SELECT 
        t1.*,
        t2.username,
        t3.name AS name_categories
        FROM $table1 AS t1 
        JOIN $table2 AS t2 ON t1.id_user = t2.id
        JOIN $table3 AS t3 ON t1.id_categories = t3.id
        ORDER BY t1.created_at DESC
    ";

    $query = $pdo->prepare($sql);
    $query->execute();

    errorCheck($query);

    return $query->fetchAll();
}


/**
 * Function for select all info from table posts and username column from table users 
 */
function selectAllPostsByMain($table1, $table2, $limit, $offset)
{
    global $pdo;

    $sql = "
        SELECT 
        t1.*, 
        t2.username 
        FROM $table1 AS t1 
        LEFT JOIN $table2 AS t2 ON t1.id_user = t2.id
        WHERE t1.status = 1
        ORDER BY t1.created_at DESC
        LIMIT $limit 
        OFFSET $offset;
    ";

    $query = $pdo->prepare($sql);
    $query->execute();

    errorCheck($query);

    return $query->fetchAll();
}


/**
 * Function for select all info from table posts and username column from table users in single-blog pages
 */
function selectOnePostByMain($table1, $table2, $id)
{
    global $pdo;

    $sql = "
        SELECT 
        t1.*, 
        t2.username 
        FROM $table1 AS t1 
        LEFT JOIN $table2 AS t2 
        ON t1.id_user = t2.id
        WHERE t1.id = $id AND t1.status = 1;
    ";

    $query = $pdo->prepare($sql);
    $query->execute();

    errorCheck($query);

    return $query->fetch();
}


/**
 * Function for select all top posts
 */
function selectPostByTopCategories($table1, $table2)
{
    global $pdo;

    $sql = "
        SELECT 
        t1.image AS posts_image
        FROM $table1 AS t1 
        LEFT JOIN $table2 AS t2 
        ON t1.id_categories = t2.id
        WHERE t1.top_status = 1 
        AND t1.status = 1;
    ";

    $query = $pdo->prepare($sql);
    $query->execute();

    errorCheck($query);

    return $query->fetchAll();
}


/**
 * Function for select all info for search input in main page
 */
function selectPostsBySearchPostsInMainPage($text, $table1, $table2)
{
    global $pdo;

    $sql = "
        SELECT 
        t1.*, 
        t2.username 
        FROM $table1 AS t1 
        LEFT JOIN $table2 AS t2 
        ON t1.id_user = t2.id
        WHERE t1.status = 1 
        AND t1.name LIKE '%$text%' 
        OR t1.description LIKE '%$text%';
    ";

    $query = $pdo->prepare($sql);
    $query->execute();

    errorCheck($query);

    return $query->fetchAll();
}


/**
 * Function for select all info from table categories, posts, users by id for category page
 */
function selectCategoryWithHisPosts($table1, $table2, $table3, $id)
{
    global $pdo;

    $sql = "
        SELECT
        t2.id,
        t2.name,
        t2.description,
        t2.image,
        t2.created_at, 
        t3.username AS username
        FROM $table1 AS t1
        LEFT JOIN $table2 AS t2 ON t1.id = t2.id_categories
        LEFT JOIN $table3 AS t3 ON t2.id_user = t3.id
        WHERE t1.id = $id AND t2.status = 1
    ";

    $query = $pdo->prepare($sql);
    $query->execute();

    errorCheck($query);

    return $query->fetchAll();
}


/**
 * Function for select all info for search input in category page
 */
function selectPostsBySearchPostsInCategoryPage($text, $table1, $table2, $table3, $id)
{
    global $pdo;

    $sql = "
        SELECT
        t2.id,
        t2.name,
        t2.description,
        t2.image,
        t2.created_at, 
        t3.username
        FROM $table1 AS t1
        LEFT JOIN $table2 AS t2 ON t1.id = t2.id_categories
        LEFT JOIN $table3 AS t3 ON t2.id_user = t3.id
        WHERE (t2.name LIKE '%$text%' OR t2.description LIKE '%$text%')
        AND t1.id = $id 
        AND t2.status = 1 
    ";

    $query = $pdo->prepare($sql);
    $query->execute();

    errorCheck($query);

    return $query->fetchAll();
}


/**
 * Function for count total pages in main pages
 */
function countRowInMainPage($table)
{
    global $pdo;

    $sql = "
        SELECT COUNT(*)
        FROM $table
        WHERE status = 1
    ";

    $query = $pdo->prepare($sql);
    $query->execute();

    errorCheck($query);

    return $query->fetchColumn();
}


/**
 * Function for select all comment by page number in single-blog page
 */
function selectAllCommentsByPageNumber($table1, $table2, $pageNumber)
{
    global $pdo;

    $sql = "
        SELECT
        t1.*,
        t2.username
        FROM $table1 AS t1
        LEFT JOIN $table2 AS t2 ON t1.email = t2.email
        WHERE page = $pageNumber 
        AND status = 1
        ORDER BY t1.created_at DESC
    ";

    $query = $pdo->prepare($sql);
    $query->execute();

    errorCheck($query);

    return $query->fetchAll();
}