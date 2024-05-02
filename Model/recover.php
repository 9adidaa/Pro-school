<?php
session_start(); // Start or resume the session
require '../Controller/email-function.php'; // Ensure this path is correct to include the email function
include '../Controller/user_con.php'; // User controller file
include '../Model/user.php';          // User model file

// Create an instance of the UserController
$userC = new Usercon("user");

// Initialize a User instance as null
$user = null;

// Check if all required POST data are available
if (isset($_POST['email']) ) {
    // Validate non-empty fields
    if (!empty($_POST['email']) ) {
        $pdo = config::getConnexion();
        // Prepare data
        $email = $_POST['email'];
        $code = rand(100000, 999999); // Generate a random 6-digit password
        $user = $userC->getUser_email($email);
        $_SESSION['code'] = $code; // Store code in session
        $_SESSION['email'] = $email; // Optionally, store email to verify the same user
        $_SESSION['id'] = $user['Id'];
        

        // Check if email already exists
        
        if($user != NULL){
            $emailSubject = "Welcome to Our Platform";
            $emailBodyHtml = "<p>Hello {". $user['name']. "},<br>Put this code in 6 digit input in the platform. Your code is: {$code}.</p>";
            $emailBodyPlain = "Hello ". $user['name']. ",\nWe are reseting you Account. Your Code is: {$code}. Please change it upon your first login.";
    
            sendEmail($email, $user['name'], $emailSubject, $emailBodyHtml, $emailBodyPlain);
            header('Location: ../View/recover.php');
            exit(); // Always call exit after header redirection
        }else{
            header('Location: ../View/forget_password.php?failed=2');
        }

        


    } else {
        header('Location: ../View/forget_password.php?failed=4'); // Missing information
    }
} else {
    header('Location: ../View/forget_password.php?failed=4'); // Missing POST keys
}
