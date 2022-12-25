<?php
require_once 'db.php';


function get_size() {
    global $pdo;
    try {
        $sql = "SELECT COUNT(*) FROM messages";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchColumn();
    }
    catch (PDOException $e) {
            print_r("[ERROR] " . $e->getMessage());
            die();
    }
    return $result;
}


function get_message($id) {
    global $pdo;
    try {
        $sql = "SELECT * FROM messages WHERE id = $id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
    }
    catch (PDOException $e) {
        print_r("[ERROR] " . $e->getMessage());
        die();
    }
    
    return $result;
}


function get_text($row) {
    $text = $row['text'];
    return $text;
}


function get_comments($id) {
    global $pdo;
    try {
        $sql = "SELECT * FROM comments WHERE message_id = $id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $stmt = $stmt->fetchAll();
    }
    catch (PDOException $e) {
        print_r("[ERROR] " . $e->getMessage());
        die();
    }

    return $stmt;
}