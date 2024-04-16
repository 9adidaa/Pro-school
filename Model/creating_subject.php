<?php
require '../Controller/connect.php'; // Include your PDO connection script

// Check if the form is submitted via POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $name = $_POST['name'] ?? '';
    $subject_description = $_POST['description'] ?? ''; // Ensure you use 'description' here
    $fileDepot = $_FILES['file_depot'] ?? null;
    $depot_fichier_subject = null;

    // Handle file upload (if any)
    if ($fileDepot && $fileDepot['error'] === UPLOAD_ERR_OK) {
        $depot_fichier_subject = $fileDepot['name'];
        $uploadPath = '../uploads/' . $fileDepot['name'];
        if (!move_uploaded_file($fileDepot['tmp_name'], $uploadPath)) {
            error_log('Failed to move uploaded file: ' . $fileDepot['name']);
        }
    }

    // Validate subject name (ensure it's not empty)
    if (empty($name)) {
        header('Location: ../view/admin/index.php?page=ASU&result=3'); // Error: Subject name is empty
        exit;
    }

    try {
        // Connect to the database
        $pdo = config::getConnexion();

        // Check if the subject name already exists
        $stmt = $pdo->prepare("SELECT * FROM `subject` WHERE name = :name");
        $stmt->execute([':name' => $name]);

        if ($stmt->fetch()) {
            header('Location: ../view/admin/index.php?page=ASU&result=4&name=' . urlencode($name)); // Error: Subject name already exists
            exit;
        }

        // Insert the new subject into the database
        $insertSql = "INSERT INTO `subject` (name, subject_description, depot_fichier_subject) VALUES (:name, :subject_description, :depot_fichier_subject)";
        $stmt = $pdo->prepare($insertSql);

        // Bind parameters and execute the insert query
        $result = $stmt->execute([
            ':name' => $name,
            ':subject_description' => $subject_description,
            ':depot_fichier_subject' => $depot_fichier_subject
        ]);

        // Redirect based on the insert result
        if ($result) {
            header('Location: ../view/admin/index.php?page=ASU&result=1'); // Success: Subject added
            exit;
        } else {
            header('Location: ../view/admin/index.php?page=ASU&result=2'); // Error: Failed to add subject
            exit;
        }
    } catch (PDOException $e) {
        die("Database error: " . $e->getMessage());
    }
} else {
    header('Location: ../view/admin/index.php?page=ASU&result=3'); // Error: Invalid request method
    exit;
}
?>
