<?php
require '../Controller/email-function.php'; // Ensure this path is correct to include the email function
include '../Controller/user_con.php'; // User controller file
include '../Model/user.php';          // User model file

// Create an instance of the UserController
$userC = new Usercon("user");

// Initialize a User instance as null
$user = null;

// Check if all required POST data are available
if (isset($_POST['email']) && isset($_POST['name']) && isset($_POST['lastname']) && isset($_POST['age'])) {
    // Validate non-empty fields
    if (!empty($_POST['email']) && !empty($_POST['name']) && !empty($_POST['lastname']) && !empty($_POST['age'])) {

        // Prepare data
        $email = $_POST['email'];
        $name = $_POST['name'];
        $lastname = $_POST['lastname'];
        $age = $_POST['age'];
        $role = 3; // Assuming role is predefined as 2 for this user type
        $password = rand(100000, 999999); // Generate a random 6-digit password
        $status = isset($_POST['banner']) ? 1 : 0;
        $class = $_POST['class'];

        $pdo = config::getConnexion();

        // Check if email already exists
        $stmt = $pdo->prepare("SELECT * FROM `user` WHERE email = :email");
        $stmt->execute([':email' => $email]);
        if ($stmt->fetch()) {
            header('Location: ../view/admin/index.php?page=AS&result=4');
            exit;
        }

        // Create a new User object
        $user = new User(
            '',
            $email,
            $role,
            $name,
            $lastname,
            password_hash($password, PASSWORD_DEFAULT), // Hash the password
            $status,
            $age
        );
        

        // Add user to the database
        $result = $userC->addUser($user->getEmail(), $user->getRole(), $user->getName(), $user->getLastname(), password_hash($password, PASSWORD_DEFAULT), $user->getStatus(), $user->getAge());
        if ($result) {
            echo 'mohamed';
            $userC->add_etu($class);
            
            header('Location: ../View/admin/index.php?page=AS&result=1'); // Missing information
        }  
        header('Location: ../View/admin/index.php?page=AS&result=1'); // Missing information

        $emailSubject = "Welcome to Our Platform";
        $emailBodyHtml = "<p>Hello {$name},<br>Your account has been created successfully. Your password is: {$password}. Please change it upon your first login.</p>";
        $emailBodyPlain = "Hello {$name},\nYour account has been created successfully. Your password is: {$password}. Please change it upon your first login.";

        sendEmail($email, $name, $emailSubject, $emailBodyHtml, $emailBodyPlain);
    } else {
        header('Location: ../View/admin/index.php?page=AS&result=3'); // Missing information
    }
} else {
    header('Location: ../View/admin/index.php?page=AS&result=2'); // Missing POST keys
}
