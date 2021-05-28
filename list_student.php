<?php
require_once 'bootstrap.php';
checkSessionInactive();
if($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $user_id = $_POST['user_id'];
        softDeleteUser($user_id, 'student', $pdo);
        $data['success'] = 'Staff delete request '. $messages['successful'];
    } catch (PDOException $e) {
        $data['fail'] = 'Staff delete request '. $messages['unsuccessful'];
    }
}


$data['activeStudents'] = getActiveUsers('student', $pdo);
$data['deletedStudents'] = getInactiveUsers('student', $pdo);
loadView('list_student.view.php', $data);
