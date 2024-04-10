<?php

// $driver     = 'mysql';
// $host       = 'localhost';
// $dbName     = 'dinamic-site';
// $dbUser     = 'root';
// $dbPass     = '';
// $charset    = 'utf8';

$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
];

try {
    $pdo = new PDO("mysql:host=localhost;dbname=dinamic-site;charset=utf8", 'root', '', $options);
} catch (PDOException $i) {
    throw new Exception('Ошибка подключения к базе данных');
}