<?php
require '../Controller/connect.php'; // Adjust the path as needed to your PDO connection script
require '../Controller/email-function.php'; // Ensure this path is correct to include the email function
session_start();
$pdo = config::getConnexion();
// Assuming you have a session variable for the user ID
$userId = $_SESSION['id'] ?? null;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $actualPassword = $_POST['actualPassword'] ?? '';
    $newPassword = $_POST['newPassword'] ?? '';
    $confirmPassword = $_POST['confirmPassword'] ?? '';

    // Fetch the current password hash from the database
    $stmt = $pdo->prepare("SELECT Password FROM user WHERE id = :userId");
    $stmt->execute([':userId' => $userId]);
    $user = $stmt->fetch();

    if (!$user || !password_verify($actualPassword, $user['Password'])) {
        // Actual password is incorrect
        header('Location: ../view/Student/template/change_password.php?result=3'); // Adjust redirect location as needed
        exit;
    }

    if ($newPassword !== $confirmPassword) {
        // New password and confirm password do not match
        header('Location: ../view/Student/template/change_password.php?result=4');
        exit;
    }

    // Optional: Check new password against your password policy here

    if (password_verify($newPassword, $user['Password'])) {
        // New password is the same as the current password
        header('Location: ../view/Student/template/change_password.php?result=4');
        exit;
    }

    // Update the password in the database
    $newPasswordHash = password_hash($newPassword, PASSWORD_DEFAULT);
    $updateStmt = $pdo->prepare("UPDATE user SET Password = :newPassword WHERE id = :userId");
    $updateResult = $updateStmt->execute([
        ':newPassword' => $newPasswordHash,
        ':userId' => $userId
    ]);

    if ($updateResult) {
        header('Location: ../view/index.php?page=5');
    } else {
        header('Location: ../view/Student/template/change_password.php?result=2');
    }
} else {
    // Not a POST request
    header('Location: ../view/Student/template/change_password.php?result=3');
}
?>
