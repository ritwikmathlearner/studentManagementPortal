<?php
require_once 'bootstrap.php';
checkSessionInactive();
if ($_SESSION['user']->role === 'faculty') {
    $sql = 'SELECT user.full_name, attendance.*, subject.name as subject_name  FROM user 
INNER JOIN student ON user.id = student.user_id 
INNER JOIN attendance_student ON student.user_id = attendance_student.student_id 
INNER JOIN attendance ON attendance_student.attendance_id = attendance.id
INNER JOIN subject ON attendance.subject_id = subject.id 
WHERE is_present = 1 ORDER BY attendance.class_date, subject.name DESC';
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
}

if ($_SESSION['user']->role === 'student') {
    $sql = 'SELECT user.full_name, attendance.*, subject.name as subject_name  FROM user 
INNER JOIN student ON user.id = student.user_id 
INNER JOIN attendance_student ON student.user_id = attendance_student.student_id 
INNER JOIN attendance ON attendance_student.attendance_id = attendance.id
INNER JOIN subject ON attendance.subject_id = subject.id 
WHERE is_present = 1 AND attendance_student.student_id = :student_id ORDER BY attendance.class_date, subject.name DESC';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':student_id' => $_SESSION['user']->id]);
}
$data['attendanceList'] = $stmt->fetchAll();
loadView('list_attendance.view.php', $data);
