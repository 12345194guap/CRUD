<?php
session_start();
$msg = $_POST["text"];
$_SESSION['message'] = $msg;

if(strlen($msg) > 600) {
    $_SESSION['error'] = "Размер сообщения превышает 600 символов!";
    header('Location: ../index.php');
    exit();
}
else if(strlen($msg) == 0) {
    $_SESSION['error'] = "Нельзя отправить пустое сообщение!";
    header('Location: ../index.php');
    exit();
}
else {
    $_SESSION['success'] = "Сообщение отправлено!";
    header('Location: ../index.php');
}

require_once 'db.php';

try {
    $sql = "INSERT INTO messages (text, likes, time) VALUES ('$msg', 0, NOW())";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    unset($_SESSION['message']);
}
catch (PDOException $e) {
    print_r("[ERROR] " . $e->getMessage());
    die();
}


