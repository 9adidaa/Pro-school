<?php
require '../Controller/connect.php';// Adjust the path as necessary

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id'])) {
    $pdo = config::getConnexion();
    $id = $_POST['id'];
    $table = $_POST['type'];
    $url = $_POST['url'];
    // Optional: Additional validation/sanitization of $id here

    try {
        // Prepare DELETE statement to remove the user with the given ID
        $stmt = $pdo->prepare("DELETE FROM ".$table." WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        // Execute the statement
        if ($stmt->execute()) {
            // Redirect back to the listing ?page with a success message
            header('Location: ../view/admin/index.php?page='.$url.'&result=1'); // Adjust the redirect location
            exit();
        } else {
            // Redirect back with an error message if the delete operation failed
            header('Location: ../view/admin/index.php?page='.$url.'&result=2'); // Adjust the redirect location
            exit();
        }
    } catch (PDOException $e) {
        // Handle any exceptions/errors
        error_log('Delete User Error: ' . $e->getMessage());
        // Redirect back with an error message
        header('Location: ../view/admin/index.php?page='.$url.'&result=2'); // Adjust the redirect location
        exit();
    }
} else {
    // Redirect back if the request method is not POST or the ID is not set
    header('Location: ../view/admin/index.php?page='.$url.'&result=3'); // Adjust the redirect location
    exit();
}
?>
