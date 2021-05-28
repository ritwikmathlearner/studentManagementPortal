<?php
require_once 'bootstrap.php';
checkSessionInactive();
$stmt = $pdo->prepare('SELECT assignment.*, subject.name as subject_name FROM assignment
INNER JOIN subject ON assignment.subject_id = subject.id 
ORDER BY assignment.due_date, subject.name DESC');
$stmt->execute();
$data['assignmentList'] = $stmt->fetchAll();
loadView('list_assignment.view.php', $data);
