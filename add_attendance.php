<?php
require_once 'bootstrap.php';
checkSessionInactive();
if($_SERVER['REQUEST_METHOD'] === 'POST') {
//    var_dump($_POST);
//    exit;
    $data['subject'] = $subject = $_POST['subject'];
    $data['classDate'] = $classDate = $_POST['classDate'];
    $data['lectureTitle'] = $lectureTitle = $_POST['lectureTitle'];
    $data['student'] = $studentList = $_POST['student'] ?? null;
    $data['attendance'] = $attendance = $_POST['attendance'] ?? null;
    $error = false;
    if(empty($attendance)) {
        if(checkEmpty($subject)) {
            $data['subjectError'] = 'Subject field '. $messages['empty_message'];
            $error = true;
        }
        if(checkEmpty($classDate)) {
            $data['classDateError'] = 'Class date field '. $messages['empty_message'];
            $error = true;
        }
        if(checkEmpty($lectureTitle)) {
            $data['lectureTitleError'] = 'Lecture title field '. $messages['empty_message'];
            $error = true;
        }
    }
    if(checkEmpty($studentList)) {
        $data['studentError'] = 'Selected student list '. $messages['empty_message'];
        $error = true;
    }

    if(!$error) {
        try {
            $pdo->beginTransaction();
            if(empty($attendance)) {
                $stmt = $pdo->prepare('INSERT INTO attendance(subject_id, class_date, lecture_title) values(:subject_id, :class_date, :lecture_title)');
                $stmt->execute([':subject_id' => $subject, ':class_date' => $classDate, ':lecture_title' => $lectureTitle,]);
                $attendance_id = $pdo->lastInsertId();
            } else {
                $attendance_id = (int) $attendance;
            }
            foreach($studentList as $student) {
                $stmt = $pdo->prepare('INSERT INTO attendance_student(attendance_id, student_id, is_present) values(:attendance_id, :student_id, 1)');
                $stmt->execute([':attendance_id' => $attendance_id, ':student_id' => $student]);
            }
            $pdo->commit();
            $data[] = [];
            header('Location: list_attendance.php');
        } catch (PDOException $e) {
            $data['studentError'] = 'Attendance add request '. $messages['unsuccessful'];
        }
    }
}
$data['subjects'] = getAll('subject', $pdo);
$data['attendanceList'] = getAll('attendance', $pdo);
$data['students'] = getActiveUsers('student', $pdo);
loadView('add_attendance.view.php', $data);
