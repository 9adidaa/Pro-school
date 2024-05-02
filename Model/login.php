<?php
require '../Controller/connect.php'; 

session_start(); 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (!empty($_POST['mail']) && !empty($_POST['password'])) {
        $mail = trim($_POST['mail']);
        $password = $_POST['password']; 

        $pdo = config::getConnexion();

        $stmt = $pdo->prepare("SELECT id, email, password, role,name,lastname,age,status FROM user WHERE email = :email LIMIT 1");
        $stmt->bindParam(':email', $mail);
        $stmt->execute();

        if ($user = $stmt->fetch(PDO::FETCH_ASSOC)) {
            
            if (password_verify($password, $user['password'])){
                
                $_SESSION['id'] = $user['id'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['role'] = $user['role'];
                $_SESSION['name'] = $user['name'];
                $_SESSION['lastname'] = $user['lastname'];
                $_SESSION['age'] = $user['age'];
                $_SESSION['status'] = $user['status'];

                
                switch ($user['role']) {
                    case '1':
                        header('Location: ../view/admin/index.php'); 
                        exit;
                    case '2':
                        header('Location: ../view/Student/template/index.php'); 
                        exit;
                    case '3':
                        header('Location: ../view/Teacher/template/index.php'); 
                        exit;
                    default:
                        echo 'Undefined user role.';
                }
            } else {
                header('Location: ../view/index.php?failed=1'); 
                exit;
            }
        } else {
            header('Location: ../view/index.php?failed=2'); 
            exit;
        }
    } else {
        header('Location: ../view/index.php?failed=3'); 
        exit;
 
    }
} else {
    header('Location: ../view/index.php?failed=4'); 
    exit;
}

?>
