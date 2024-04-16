<?php
require '../Controller/connect.php'; // Adjust the path as needed to your PDO connection script

// Check if the form is submitted via POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['subject'] ?? '';
    
    $pdo = config::getConnexion();
    // Check if email already exists
    $stmt = $pdo->prepare("SELECT * FROM `subject` WHERE name = :subject");
    $stmt->execute([':subject' => $name]);
    if ($stmt->fetch()) {
        header('Location: ../view/admin/index.php?page=ASU&result=4'.$name.'a'); 
        exit;
    }

    // Insert the new user
    $insertSql = "INSERT INTO `subject` (name) VALUES (:subject)";
    $stmt = $pdo->prepare($insertSql);
    $result = $stmt->execute([
        ':subject' => $name,
    ]);

    if ($result) {
        header('Location: ../view/admin/index.php?page=ASU&result=1'); 
    } else {
        header('Location: ../view/admin/index.php?page=ASU&result=2'); 
    }
} else {
    header('Location: ../view/admin/index.php?page=ASU&result=3'); 
}
?>
