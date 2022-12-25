<?php

$pdo = new PDO('mysql:host=localhost;dbname=messages_db;charset=utf8', 'root', 'root');
try {
    $pdo->exec("CREATE TABLE IF NOT EXISTS messages (
        id INT AUTO_INCREMENT PRIMARY KEY, 
        text TEXT NOT NULL, 
        likes INT NOT NULL,
        time DATETIME NOT NULL);"
    );

    $pdo->exec("CREATE TABLE IF NOT EXISTS comments (
        message_id INT NOT NULL, 
        text TEXT NOT NULL, 
        time DATETIME NOT NULL);"
    );
}
catch (PDOException $e) {
    print_r("[ERROR] " . $e->getMessage());
    die();
}