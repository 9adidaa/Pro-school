<?php
// Vérifier si la méthode de requête est POST et si les données requises sont présentes
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    // Récupérer les données du formulaire
    $id = $_POST['id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    
    // Vérifier si un fichier a été téléchargé
    if (isset($_FILES['file_depot']) && $_FILES['file_depot']['error'] === UPLOAD_ERR_OK) {
        $fileDepot = $_FILES['file_depot']['name'];
        $fileDepotTmp = $_FILES['file_depot']['tmp_name'];

        // Déplacer le fichier téléchargé vers un emplacement souhaité
        $uploadDir = '../uploads/';
        $uploadedFile = $uploadDir . $fileDepot;
        move_uploaded_file($fileDepotTmp, $uploadedFile);
    } else {
        // Aucun fichier n'a été téléchargé ou une erreur s'est produite
        $fileDepot = ''; // Utilisez une valeur par défaut si nécessaire
    }

    try {
        // Inclure le fichier de connexion à la base de données
        require '../Controller/connect.php';

        // Établir une connexion à la base de données
        $pdo = config::getConnexion();

        // Préparer la requête SQL d'update
        $query = "UPDATE subject SET name = :name, subject_description = :description, depot_fichier_subject = :fileDepot WHERE id = :id";
        $stmt = $pdo->prepare($query);

        // Liaison des valeurs aux paramètres de la requête
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':description', $description, PDO::PARAM_STR);
        $stmt->bindParam(':fileDepot', $fileDepot, PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        // Exécuter la requête d'update
        if ($stmt->execute()) {
            // Redirection avec un message de succès
            header('Location: ../view/admin/index.php?page=ASU&result=1');
            exit();
        } else {
            // Redirection avec un message d'erreur en cas d'échec
            header('Location: ../view/admin/index.php?page=ASU&result=2');
            exit();
        }
    } catch (PDOException $e) {
        // Gérer les exceptions de la base de données
        error_log('Update Error: ' . $e->getMessage());
        // Redirection avec un message d'erreur
        header('Location: ../view/admin/index.php?page=ASU&result=2');
        exit();
    }
} else {
    // Redirection si les données requises ne sont pas présentes
    header('Location: ../view/admin/index.php?page=ASU&result=3');
    exit();
}
?>
