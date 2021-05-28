<?php
require_once 'bootstrap.php';
checkSessionInactive();
if($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $user_id = $_POST['user_id'];
        softDeleteUser($user_id, 'faculty', $pdo);
        $data['success'] = 'Staff delete request '. $messages['successful'];
    } catch (PDOException $e) {
        $data['fail'] = 'Staff delete request '. $messages['unsuccessful'];
    }
}


$data['activeFaculties'] = getActiveUsers('faculty', $pdo);
$data['deletedFaculties'] = getInactiveUsers('faculty', $pdo);
$data['pdo'] = $pdo;
loadView('list_faculty.view.php', $data);
