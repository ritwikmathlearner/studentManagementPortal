<?php
require_once 'bootstrap.php';
checkSessionActive();
if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data['username'] = $username = $_POST['username'];
    $password = $_POST['password'];
    $remember = $_POST['remember'] ?? null;
    $error = false;
    if(checkEmpty($username)) {
        $data['usernameError'] = 'Username field '. $messages['empty_message'];
        $error = true;
    }
    if(checkEmpty($password)) {
        $data['passwordError'] = 'Password field '. $messages['empty_message'];
        $error = true;
    }

    if(!$error) {
        try {
            $stmt = $pdo->prepare('SELECT * FROM user WHERE username = :username');
            $stmt->execute([':username' => $username]);
            $user = $stmt->fetch();
        } catch (PDOException $e) {
            $data['usernameError'] = 'Username '. $messages['unsuccessful'];
        }
        if(!$user) {
            $data['usernameError'] = 'Username '. $messages['not_eixits'];
        } elseif (!empty($user->left_on)) {
            $data['usernameError'] = 'Username '. $messages['invalid'];
        } else {
            if($user->password === md5($password)) {
                $_SESSION['logged_in'] = true;
                $_SESSION['user'] = $user;
                if(!empty($remember)) {
                    $encodedUser = json_encode($user);
                    setcookie('logged_in_user', $encodedUser, time() + (86400 * 1), "/");
                }
                header('Location: index.php');
            } else {
                $data['passwordError'] = 'Password '. $messages['not_match'];
            }
        }
    }
}
loadView('login.view.php', $data);

