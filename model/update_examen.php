<?php
include '../Controller/examen_con.php';

require_once 'examen.php';

$examenC = new examenCon("examen");

// Création d'une instance de la classe examen
$examen = null;

if (isset($_POST['id'])){
    $id = $_POST['id'];
}

$examen = null;

if (
    isset($_POST["titre"]) &&
    isset($_POST["date"]) &&
    isset($_POST["id_subject"])&&
    isset($_POST["id_class"])
) {
    if (
        !empty($_POST['titre']) &&
        !empty($_POST["date"]) &&
        !empty($_POST["id_subject"])&&
        !empty($_POST["id_class"])
    ) {
        
        $examen = new Examen(
            '',
            $_POST['titre'],
            $_POST['date'],
            $_POST['id_subject'],
            $_POST['id_class']
        );

        $result = $examenC->updateexamen($examen, $id);
        header('Location:../View/index.php?page=CE&result=1');
    } else {
        
        header('Location:../View/index.php?page=CE&result=3');
    }
} elseif (isset($_GET['id'])) {
    $current_id = $_GET['id'];
    $examen = $examenC->getexamen($current_id);
}
?>