<?php
require_once 'bootstrap.php';
checkSessionInactive();
if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $faculty_id = $_POST['faculty_id'];
    $subject_id = $_POST['subject_id'];
    $error = false;
    if(checkEmpty($faculty_id)) {
        $data['facultyIdError'] = 'Faculty field '. $messages['empty_message'];
        $error = true;
    }
    if(checkEmpty($subject_id)) {
        $data['subjectIdError'] = 'Subject field '. $messages['empty_message'];
        $error = true;
    }

    if(!$error) {
        try {
            $stmt = $pdo->prepare('INSERT INTO faculty_subject(faculty_id, subject_id) values(:faculty_id, :subject_id)');
            $stmt->execute([':faculty_id' => $faculty_id, ':subject_id' => $subject_id]);
            $data['success'] = 'Subject assign request '. $messages['successful'];
        } catch (PDOException $e) {
            $data['fail'] = 'Faculty and subject relation '. $messages['exists'];
        }
    }
}


$data['faculties'] = getActiveUsers('faculty', $pdo);
$data['subjects'] = getAll('subject', $pdo);
loadView('assign_subject.view.php', $data);
