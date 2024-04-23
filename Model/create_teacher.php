<?php
 // Ensure this path is correct for the database connection
require '../Controller/email-function.php'; // Ensure this path is correct to include the email function
include '../Controller/user_con.php'; // Assuming UserController is implemented in this file
include '../Model/user.php'; // Assuming User model class is defined in this file

// Create an instance of the UserController
$userC = new Usercon("user");

// Initialize a User instance as null
$user = null;

// Check if all required POST data are available
if (isset($_POST['email'], $_POST['name'], $_POST['lastname'], $_POST['age'], $_POST['subject'])) {
    // Validate non-empty fields
    if (!empty($_POST['email']) && !empty($_POST['name']) && !empty($_POST['lastname']) && !empty($_POST['age']) && !empty($_POST['subject'])) {
        
        // Prepare data
        $email = $_POST['email'];
        $name = $_POST['name'];
        $lastname = $_POST['lastname'];
        $age = $_POST['age'];
        $role = 2; // Assuming role is predefined as 3 for this user type
        $password = rand(100000, 999999); // Generate a random 6-digit password
        $status = isset($_POST['banner']) ? 1 : 0;
        $subjectID = $_POST['subject'];

        $pdo = config::getConnexion();

        // Check if email already exists
        $stmt = $pdo->prepare("SELECT * FROM `user` WHERE email = :email");
        $stmt->execute([':email' => $email]);
        if ($stmt->fetch()) {
            header('Location: ../view/admin/index.php?page=AT&result=4');
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
       $result = $userC->addUser($user->getEmail(),$user->getRole(),$user->getName(),$user->getLastname(),password_hash($password, PASSWORD_DEFAULT), $user->getStatus(),$user->getAge());
        if ($result){
            $userC->add_ens($subjectID);
            header('Location: ../view/admin/index.php?page=AT&result=1');
        }
        // If a subjectID is provided, associate the user with the subject


        // Send email with the password
        $emailSubject = "Welcome to Our Platform";
        $emailBodyHtml = "<p>Hello {$name},<br>Your account has been created successfully. Your password is: {$password}. Please change it upon your first login.</p>";
        $emailBodyPlain = "Hello {$name},\nYour account has been created successfully. Your password is: {$password}. Please change it upon your first login.";

        // Call the sendEmail function
        sendEmail($email, $name, $emailSubject, $emailBodyHtml, $emailBodyPlain);

        header('Location: ../view/admin/index.php?page=AT&result=1');
    } else {
        header('Location: ../view/admin/index.php?page=AT&result=3'); // Missing information
    }
} else {
    header('Location: ../view/admin/index.php?page=AT&result=3'); // Missing POST keys
}
?>
