<?php
include "../../Model/verify_login.php";
$page = isset($_GET['page']) ? $_GET['page'] : 'dashboard';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sidebar With Bootstrap</title>
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../css/dashboard.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../css/form.css">
</head>

<body>


    <?php
    if (1 == 1) {
        include '../components/Navbar_horizental/navbar_horizental.php';
        include '../components/Navbar_vertical/Navbar1_vertical.php';
        switch ($page) {
            case 'AS':
                include 'creating_student.php';
                break;

            case 'AC':
                include 'creating_class.php';
                break;

            case 'ASU':
                include 'creating_subject.php';
                break;
            case 'AT':
                include 'creating_teacher.php';
                break;
            case 'CS':
                include 'check_student.php';
                break;
            case 'CT';
                include 'check_teacher.php';
                break;
            case 'change_password';
                include '../components/commun/change_password.php';
                break;
            case 'CE';
                include 'creating_events.php';
                break;
            case 'UT';
                include 'update_teacher.php';
                break;
            case 'US';
                include 'update_student.php';
                break;
            case 'UE';
                include 'update_event.php';
                break;
            default:
                include 'dashboard.php';
                break;
        }
    }


    ?>

    <!-- MAIN -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script src="../js/script.js"></script>
    <script type="text/javascript" src="../js/add_account_form.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

</body>

</html>