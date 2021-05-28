<?php

function getActiveUsers($tableName, $pdo) {
    $stmt = $pdo->prepare('SELECT * FROM user INNER JOIN '. $tableName .' ON user.id = '. $tableName .'.user_id WHERE left_on IS NULL');
    $stmt->execute();
    return $stmt->fetchAll();
}

function getInactiveUsers($tableName, $pdo) {
    $stmt = $pdo->prepare('SELECT * FROM user INNER JOIN '. $tableName .' ON user.id = '. $tableName .'.user_id WHERE left_on IS NOT NULL');
    $stmt->execute();
    return $stmt->fetchAll();
}

function softDeleteUser($user_id, $table, $pdo) {
    $stmt = $pdo->prepare('UPDATE '. $table .' SET left_on = CURDATE() WHERE user_id = :user_id');
    $stmt->execute([':user_id' => $user_id]);
}

function getAssignedSubject($faculty_id, $pdo) {
    $stmt = $pdo->prepare('SELECT GROUP_CONCAT(subject.name) as subjectNames FROM subject INNER JOIN faculty_subject ON subject.id = faculty_subject.subject_id WHERE faculty_id = :faculty_id GROUP BY faculty_id');
    $stmt->execute([':faculty_id' => $faculty_id]);
    $var = $stmt->fetch();
    return $var->subjectNames ?? 'Not assigned';
}

function getAll($tableName, $pdo) {
    $stmt = $pdo->prepare('SELECT * FROM '. $tableName);
    $stmt->execute();
    return $stmt->fetchAll();
}