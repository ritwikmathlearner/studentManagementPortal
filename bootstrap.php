<?php
session_start();
require_once 'config.php';
require_once 'connection.php';
require_once 'model.php';
require_once 'validation.php';
$data = [];
function loadView($view, $data)
{
    require_once 'header.php';
    require_once './views/' . $view;
    require_once 'footer.php';
}

$remember_user = $_COOKIE['logged_in_user'] ?? null;
if(!empty($remember_user)) {
    $_SESSION['logged_in'] = true;
    $_SESSION['user'] = json_decode($remember_user);
}