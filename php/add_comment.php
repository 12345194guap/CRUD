<?php
session_start();
$comment = $_POST["text"];
$id = $_POST["id"];
$_SESSION['comment'] = $comment;

if(strlen($comment) > 400) {
    $_SESSION['error'] = "Размер сообщения превышает 400 символов!";
    header('Location: ../index.php');
    exit();
}
else if(strlen($comment) == 0) {
    $_SESSION['error'] = "Нельзя отправить пустое сообщение!";
    header('Location: ../index.php');
    exit();
}
else {
    $_SESSION['success'] = "Комментарий добавлен!";
    header('Location: ../index.php');
}

require_once 'db.php';
global $pdo;

try {
    $sql = "INSERT INTO comments (message_id, text, time) VALUES ($id, '$comment', NOW())";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    unset($_SESSION['comment']);
    header("Location: ../index.php");
}
catch (PDOException $e) {
    print_r("[ERROR] " . $e->getMessage());
    die();
}

