<?php
require '../Controller/connect.php'; // Adjust the path as needed to your PDO connection script

// Check if the form is submitted via POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['class'] ?? '';
    
    
    $pdo = config::getConnexion();
    // Check if email already exists
    $stmt = $pdo->prepare("SELECT * FROM `class` WHERE name = :class");
    $stmt->execute([':class' => $name]);
    if ($stmt->fetch()) {
        header('Location: ../view/admin/index.php?page=AC&result=4&'.$name.'a'); 
        exit;
    }

    // Insert the new user
    $insertSql = "INSERT INTO `class` (name) VALUES (:name)";
    $stmt = $pdo->prepare($insertSql);
    $result = $stmt->execute([
        ':name' => $name,
    ]);

    if ($result) {
        header('Location: ../view/admin/index.php?page=AC&result=1'); 
    } else {
        header('Location: ../view/admin/index.php?page=AC&result=2'); 
    }
} else {
    header('Location: ../view/admin/index.php?page=AC&result=3'); 
}
?>
