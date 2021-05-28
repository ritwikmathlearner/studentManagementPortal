<?php
require_once 'bootstrap.php';
checkSessionInactive();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//    var_dump($_POST);
//    exit;
    $data['message'] = $message = $_POST['message'];

    $error = false;
    if (checkEmpty(trim($message))) {
        $data['messageError'] = 'Message field ' . $messages['empty_message'];
        $error = true;
    }

    if (!$error) {
        try {
            $stmt = $pdo->prepare('INSERT INTO messages(student_id, message, sent_on) values(:student_id, :message, now())');
            $stmt->execute([':student_id' => $_SESSION['user']->id, ':message' => $message]);
            $data[] = [];
            header('Location: messages.php');
        } catch (PDOException $e) {
            $data['subjectError'] = 'Message post request ' . $messages['unsuccessful'];
        }
    }
}
$stmt = $pdo->prepare('SELECT messages.*, user.full_name FROM messages
INNER JOIN student ON messages.student_id = student.user_id
INNER JOIN user ON student.user_id = user.id 
ORDER BY messages.sent_on DESC');
$stmt->execute();
$data['messages'] = $stmt->fetchAll();
//var_dump($data['messages']);
//exit;
loadView('messages.view.php', $data);
