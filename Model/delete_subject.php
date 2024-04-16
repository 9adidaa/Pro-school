<?php
require '../Controller/connect.php'; // Assurez-vous que le chemin est correct

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id'])) {
    $pdo = config::getConnexion();
    $id = $_POST['id'];
    $table = $_POST['type'];
    $url = $_POST['url'];

    try {
        // Préparer la requête DELETE pour supprimer le sujet avec l'ID donné
        $stmt = $pdo->prepare("DELETE FROM $table WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        // Exécuter la requête DELETE
        if ($stmt->execute()) {
            // Rediriger avec un message de succès
            header('Location: ' . $url . '?result=1');
            exit();
        } else {
            // Rediriger avec un message d'erreur si la suppression a échoué
            header('Location: ' . $url . '?result=2');
            exit();
        }
    } catch (PDOException $e) {
        // Gérer les exceptions
        error_log('Delete Error: ' . $e->getMessage());
        // Rediriger avec un message d'erreur
        header('Location: ' . $url . '?result=2');
        exit();
    }
} else {
    // Rediriger si les paramètres requis ne sont pas définis
    header('Location: ' . $url . '?result=3');
    exit();
}
?>
