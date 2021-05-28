<?php
require_once 'bootstrap.php';
checkSessionInactive();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data['marks'] = $marks = $_POST['marks'];
    $submission_id = $_POST['submission'];

    $error = false;
    if (checkEmpty($marks)) {
        $data['marksError'] = 'Error';
        $error = true;
    }

    if (!$error) {
        try {
            $stmt = $pdo->prepare('UPDATE submission SET marks = :marks WHERE id = :id');
            $stmt->execute([':marks' => $marks, ':id' => $submission_id]);
            $data[] = [];
            header('Location: list_marksheet.php');
        } catch (PDOException $e) {
            $data['marksError'] = 'Error';
        }
    }
}

if ($_SESSION['user']->role === 'student') {
    $stmt = $pdo->prepare('SELECT assignment.*, subject.name as subject_name, submission.id as submission_id, submission.file_name, submission.marks FROM assignment
                                    INNER JOIN subject ON assignment.subject_id = subject.id
                                    INNER JOIN submission ON assignment.id = submission.assignment_id AND submission.student_id = :student_id
                                    ORDER BY assignment.due_date, subject.name DESC');
    $stmt->execute([':student_id' => $_SESSION['user']->id]);
} else {
    $stmt = $pdo->prepare('SELECT assignment.*, subject.name as subject_name, submission.id as submission_id, submission.file_name, submission.marks, user.full_name FROM assignment
                                    INNER JOIN subject ON assignment.subject_id = subject.id
                                    INNER JOIN submission ON assignment.id = submission.assignment_id
                                    INNER JOIN user ON submission.student_id = user.id
                                    ORDER BY assignment.due_date, subject.name DESC');
    $stmt->execute([]);
}
$data['submissions'] = $stmt->fetchAll();
//var_dump($data['assignmentList']);
//exit;
loadView('list_marksheet.view.php', $data);
