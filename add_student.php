<?php
require_once 'bootstrap.php';
checkSessionInactive();
if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data['fullName'] = $fullName = $_POST['fullName'];
    $data['username'] = $username = $_POST['username'];
    $data['parentName'] = $parentName = $_POST['parentName'];
    $data['relationship'] = $relationship = $_POST['relationship'];
    $data['contactNumber'] = $contactNumber = $_POST['contactNumber'];
    $error = false;
    if(checkEmpty($fullName)) {
        $data['fullNameError'] = 'Full name field '. $messages['empty_message'];
        $error = true;
    }
    if(checkEmpty($username)) {
        $data['usernameError'] = 'Username field '. $messages['empty_message'];
        $error = true;
    }
    if(checkEmpty($parentName)) {
        $data['parentNameError'] = 'Parent Name field '. $messages['empty_message'];
        $error = true;
    }
    if(checkEmpty($relationship)) {
        $data['relationshipError'] = 'Relationship field '. $messages['empty_message'];
        $error = true;
    }
    if(checkEmpty($contactNumber)) {
        $data['contactNumberError'] = 'Contact number field '. $messages['empty_message'];
        $error = true;
    }
    if(checkExists($username, 'user', 'username', $pdo)) {
        $data['usernameError'] = 'Username '. $messages['exists'];
        $error = true;
    }

    if(!$error) {
        try {
            $password = md5('12345678');
            $pdo->beginTransaction();
            $stmt = $pdo->prepare('INSERT INTO user(full_name, username, password, role) values(:full_name, :username, :password, "student")');
            $stmt->execute([':full_name' => $fullName, ':username' => $username, ':password' => $password,]);
            $user_id = $pdo->lastInsertId();
            $stmt = $pdo->prepare('INSERT INTO student(user_id, parent_name, relationship, contact_number) values(:user_id, :parent_name, :relationship, :contact_number)');
            $stmt->execute([':user_id' => $user_id, ':parent_name' => $parentName, ':relationship' => $relationship , ':contact_number' => $contactNumber]);
            $pdo->commit();
            $data[] = [];
            header('Location: list_student.php');
        } catch (PDOException $e) {
            $data['usernameError'] = 'Student add request '. $messages['unsuccessful'];
        }
    }
}

loadView('add_student.view.php', $data);
