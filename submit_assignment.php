<?php
require_once 'bootstrap.php';
checkSessionInactive();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data['assignment'] = $assignment = $_POST['assignment'];

    $fileTmpPath = $_FILES['solution']['tmp_name'];
    $fileName = $_FILES['solution']['name'];
    $fileSize = $_FILES['solution']['size'];
    $fileType = $_FILES['solution']['type'];
    $fileNameCmps = explode(".", $fileName);
    $fileExtension = strtolower(end($fileNameCmps));

    $newFileName = md5(time() . $fileName) . '.' . $fileExtension;

    $error = false;
    if (checkEmpty($assignment)) {
        $data['assignmentError'] = 'Assignment field ' . $messages['empty_message'];
        $error = true;
    }
    if (!(isset($_FILES['solution']) && $_FILES['solution']['error'] === UPLOAD_ERR_OK)) {
        $data['solutionError'] = 'No solution uploaded';
        $error = true;
    }
    if ($fileExtension !== 'pdf') {
        $data['solutionError'] = 'Only PDF is allowed';
        $error = true;
    }

    $uploadFileDir = './solutions/';
    $dest_path = $uploadFileDir . $newFileName;

    if (empty($data['solutionError']) && move_uploaded_file($fileTmpPath, $dest_path)) {
        //
    } else {
        $data['solutionError'] = 'Upload failed';
        $error = true;
    }

    if (!$error) {
        try {
            $stmt = $pdo->prepare('INSERT INTO submission(assignment_id, student_id, file_name) values(:assignment_id, :student_id, :file_name)');
            $stmt->execute([':assignment_id' => $assignment, ':student_id' => $_SESSION['user']->id, ':file_name' => $newFileName]);
            $data[] = [];
            header('Location: list_marksheet.php');
        } catch (PDOException $e) {
            $data['subjectError'] = 'Assginment add request ' . $messages['unsuccessful'];
        }
    }
}
$stmt = $pdo->prepare('SELECT assignment.*, subject.name as subject_name, submission.file_name FROM assignment
INNER JOIN subject ON assignment.subject_id = subject.id
LEFT JOIN submission ON assignment.id = submission.assignment_id AND submission.student_id = :student_id
WHERE due_date > CURDATE()
ORDER BY assignment.due_date, subject.name DESC');
$stmt->execute([':student_id' => $_SESSION['user']->id]);
$data['assignmentList'] = $stmt->fetchAll();
//var_dump($data['assignmentList']);
//exit;
loadView('submit_assignment.view.php', $data);
