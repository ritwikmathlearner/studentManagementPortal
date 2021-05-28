<?php
$host = '127.0.0.1';
$db = 'studentportal';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
    PDO::ATTR_EMULATE_PREPARES => false,
];

$messages = [
    'empty_message' => ' must not be empty',
    'not_eixits' => ' does not exists',
    'not_match' => ' does not match',
    'unsuccessful' => ' could not be completed',
    'successful' => ' is completed',
    'exists' => ' already exists',
    'invalid' => ' is blocked by system'
];