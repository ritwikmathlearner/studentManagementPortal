<?php
require_once 'bootstrap.php';
checkSessionInactive();
if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data['subject'] = $subject = $_POST['subject'];
    $data['assignment'] = $assignment = $_POST['assignment'];
    $data['dueDate'] = $dueDate = $_POST['dueDate'];
    $error = false;
    if(checkEmpty($subject)) {
        $data['subjectError'] = 'Subject field '. $messages['empty_message'];
        $error = true;
    }
    if(checkEmpty($assignment)) {
        $data['assignmentError'] = 'Assignment field '. $messages['empty_message'];
        $error = true;
    }
    if(checkEmpty($dueDate)) {
        $data['dueDateError'] = 'Due date field '. $messages['empty_message'];
        $error = true;
    }

    if(!$error) {
        try {
            $stmt = $pdo->prepare('INSERT INTO assignment(subject_id, title, due_date) values(:subject_id, :title, :due_date)');
            $stmt->execute([':subject_id' => $subject, ':title' => $assignment, ':due_date' => $dueDate]);
            $data[] = [];
            header('Location: list_assignment.php');
        } catch (PDOException $e) {
            $data['subjectError'] = 'Assginment add request '. $messages['unsuccessful'];
        }
    }
}

$data['subjectList'] = getAll('subject', $pdo);
loadView('add_assignment.view.php', $data);
