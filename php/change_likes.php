<?php
require_once 'db.php';
global $pdo;

$id = $_POST['id'];
$likes = $_POST['post_likes'];
$likes++;

try {
    $sql = "UPDATE messages SET likes = :likes WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(":likes", $likes); 
    $stmt->bindValue(":id", $_POST["id"]);
    $stmt->execute();

    header("Location: ../index.php");
}
catch (PDOException $e) {
    print_r("[ERROR] " . $e->getMessage());
    die();
}

