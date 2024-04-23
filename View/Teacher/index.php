<?php
include "../../Model/verify_login.php";
$page = isset($_GET['page']) ? $_GET['page'] : 'dashboard';

$eventC = new eventCon("events");
$events = $eventC->listEvents();
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
</head>

<body>

    <?php
    if (1 == 1) {
        include '../components/Navbar_horizental/navbar_horizental.php';
        include '../components/Navbar_vertical/Navbar2_vertical.php';
        switch ($page) {
            case 'AS':
                echo "student"; // Ensure you have a contact.php or replace with the correct file
                break;
            case 'change_password';
                include '../components/commun/change_password.php';
                break;
                // Add more cases as needed
            default:
                include 'dashboard.php'; // The default page if no specific page requested or if 'dashboard' is requested
                break;
        }
    }


    ?>


    <!-- MAIN -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script src="../js/script.js"></script>
</body>

</html>