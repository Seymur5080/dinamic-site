<?php

if (!function_exists('clearData')) {
    $arr = [];
    function clearData ($data) {
        foreach ($data as $key => $value) {
            $value = trim($value);
            $value = stripslashes($value);
            $value = strip_tags($value);
            $value = htmlspecialchars($value);

            $arr[$key] = $value;
        }

        return $arr;
    }
}