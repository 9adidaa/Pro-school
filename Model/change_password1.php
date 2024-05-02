<?php
require '../Controller/connect.php'; // Adjust the path as needed to your PDO connection script
require '../Controller/email-function.php'; // Ensure this path is correct to include the email function
session_start();
$pdo = config::getConnexion();
// Assuming you have a session variable for the user ID
$userId = $_POST['id'] ?? null;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $newPassword = $_POST['new_password'] ?? '';
    $confirmPassword = $_POST['confirm_password'] ?? '';

    if ($newPassword !== $confirmPassword) {
        // New password and confirm password do not match
        header('Location: ../view/new_password.php?failed=1');
        exit;
    }

    // Fetch the current password hash from the database to check if the new password is the same
    $stmt = $pdo->prepare("SELECT Password FROM user WHERE Id = :userId");
    $stmt->execute([':userId' => $userId]);
    $user = $stmt->fetch();

    if (password_verify($newPassword, $user['Password'])) {
        // New password is the same as the current password
       echo $userId;
       echo "<br>";
       echo $newPassword;
       echo "<br>";
       echo $user['Password'];
        exit;
    }

    // Update the password in the database
    $newPasswordHash = password_hash($newPassword, PASSWORD_DEFAULT);
    $updateStmt = $pdo->prepare("UPDATE user SET Password = :newPassword WHERE Id = :userId");
    $updateResult = $updateStmt->execute([
        ':newPassword' => $newPasswordHash,
        ':userId' => $userId
    ]);

    if ($updateResult) {
        header('Location: ../view/index.php?page=5'); // Assuming page=5 indicates success
    } else {
        header('Location: ../view/index?failed=3'); // Error in updating password
    }
} else {
    // Not a POST request
    header('Location: ../view/index?failed=3'); // Redirect for invalid access
}
?>
