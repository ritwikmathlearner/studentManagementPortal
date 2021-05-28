<?php
require_once 'bootstrap.php';
session_unset($_SESSION['logged_in']);
session_unset($_SESSION['user']);
setcookie('logged_in_user', null, -1, '/');
session_destroy();
header('Location: login.php');