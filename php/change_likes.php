<?php
require_once 'db.php';
global $pdo;

$id = $_POST['id'];
$likes = $_POST['likes'];
$likes++;

try {
    $sql = "UPDATE messages SET likes = :likes WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(":likes", $likes); 
    $stmt->bindValue(":id", $id);
    $stmt->execute();
}
catch (PDOException $e) {
    print_r("[ERROR] " . $e->getMessage());
    die();
}

header('Content-Type: text/html; charset=utf-8');
echo $likes;