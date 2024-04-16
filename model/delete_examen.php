<?php
include 'examen.php';
include '../Controller/examen_con.php';
// Création d'une instance du contrôleur des événements
$examenC = new examenCon("examen");

// Création d'une instance de la classe Event
$examen = null;



if (isset($_GET['id'])) {
    $current_id = $_GET['id'];
    
    $examenC->deleteExamen($current_id);
    
    header('Location:../View/index.php?result=1');
}
?>