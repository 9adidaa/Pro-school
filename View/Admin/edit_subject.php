<?php
// Inclure le fichier de connexion à la base de données
require '../../Controller/connect.php';

// Vérifier si l'ID du sujet est présent dans l'URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    try {
        // Établir une connexion à la base de données
        $pdo = config::getConnexion();

        // Préparer la requête SQL pour récupérer les détails du sujet spécifique
        $query = "SELECT id, name, subject_description, depot_fichier_subject FROM subject WHERE id = :id";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        // Vérifier si le sujet existe
        if ($stmt->rowCount() > 0) {
            $subject = $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            // Rediriger avec un message d'erreur si le sujet n'existe pas
            header('Location: ../../view/admin/index.php?page=ASU&result=2');
            exit();
        }
    } catch (PDOException $e) {
        // Gérer les exceptions de la base de données
        error_log('Database Error: ' . $e->getMessage());
        header('Location: ../../view/admin/index.php?page=ASU&result=2');
        exit();
    }
} else {
    // Rediriger si l'ID du sujet n'est pas fourni dans l'URL
    header('Location: ../../view/admin/index.php?page=ASU&result=2');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Subject</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <main style="padding-top: 20px;">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card border-dark mb-3" style="max-width: 100rem;">
                        <div class="card-header">
                            <h5>Edit Subject</h5>
                        </div>
                        <div class="card-body text-dark">
                            <form class="row g-3" method="POST" action="../../model/update_subject.php" enctype="multipart/form-data">
                                <input type="hidden" name="id" value="<?= $subject['id']; ?>">
                                <div class="col-md-6">
                                    <label for="subjectName" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="subjectName" name="name" value="<?= htmlspecialchars($subject['name']); ?>" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="subjectDescription" class="form-label">Description</label>
                                    <textarea class="form-control" id="subjectDescription" name="description" rows="3" required><?= htmlspecialchars($subject['subject_description']); ?></textarea>
                                </div>
                                <div class="col-md-6">
                                    <label for="fileDepot" class="form-label">File Depot</label>
                                    <input type="file" class="form-control" id="fileDepot" name="file_depot">
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary">Update Subject</button>
                                    <a href="../../view/admin/index.php?page=ASU" class="btn btn-secondary">Cancel</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
