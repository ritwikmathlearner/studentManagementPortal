<?php
function checkEmpty($value) {
    if(empty($value) || $value === '' || $value === 0) {
        return true;
    } else {
        return false;
    }
}

function checkSessionInactive() {
    if(empty($_SESSION['logged_in'])) {
        header('Location: login.php');
    }
}

function checkSessionActive() {
    if(isset($_SESSION['logged_in'])) {
        header('Location: index.php');
    }
}

function checkExists($value, $table, $column, $pdo) {
    $stmt = $pdo->prepare('SELECT * FROM '. $table .' WHERE '. $column .' = :value');
    $stmt->execute([':value' => $value]);
    if(empty($stmt->fetch())) {
        return false;
    } else {
        return true;
    }
}

