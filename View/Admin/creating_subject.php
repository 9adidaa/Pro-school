<?php
$result = isset($_GET['result']) ? $_GET['result'] : null;
?>
<main style="padding-top:20px;">
    <div class="container">

    <div class="row">
    <div class="col-md-12">
        <?php
        switch ($result) {
            case '1':
                echo '<div class="alert alert-success" role="alert">The operation worked successfully !</div>
                      <div class="card bg-success mb-3 " style="max-width: 100rem;">';
                break;

            case '2':
                echo '<div class="alert alert-danger" role="alert">An error occurred !</div>
                      <div class="card border-danger mb-3 " style="max-width: 100rem;">';
                break;
            case '3':
                echo '<div class="alert alert-danger" role="alert">Please submit the form!</div>
                      <div class="card border-danger mb-3 " style="max-width: 100rem;">';
                break;
            case '4':
                echo '<div class="alert alert-warning" role="alert">Subject already exists!</div>
                      <div class="card border-warning mb-3 " style="max-width: 100rem;">';
                break;
            default:
                echo '<div class="alert alert-primary" role="alert">Input the FORM!</div>
                      <div class="card border-dark mb-3 " style="max-width: 100rem;">';
                break;
        }
        ?>
        <div class="card-header">
            <h5>Create Subject</h5>
            <div class="card-body text-dark">
                <form class="row g-3" method="POST" action="../../model/creating_subject.php" enctype="multipart/form-data">
                    <div class="col-md-6">
                        <label for="name" class="form-label">Name</label>
                        <input name="name" type="text" class="form-control" id="name" required>
                        <div class="valid-feedback">Looks good!</div>
                        <div class="invalid-feedback">Please enter the subject name.</div>
                    </div>
                    <div class="col-md-6">
                        <label for="description" class="form-label">Description</label>
                        <textarea name="description" class="form-control" id="description" rows="3" required></textarea>
                        <div class="valid-feedback">Looks good!</div>
                        <div class="invalid-feedback">Please enter the subject description.</div>
                    </div>
                    <div class="col-md-6">
                        <label for="file_depot" class="form-label">File Depot</label>
                        <input name="file_depot" type="file" class="form-control" id="file_depot" required>
                        <div class="valid-feedback">Looks good!</div>
                        <div class="invalid-feedback">Please choose a file.</div>
                    </div>
                    <div class="col-12">
                        <input class="btn btn-primary" type="submit" value="Submit form">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="gap"></div>
</div>


<div class="col-md-12" style="padding-top:20px;">
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">NAME</th>
                <th scope="col">DESCRIPTION</th>
                <th scope="col">FILE DEPOT</th>
                <th scope="col">EDIT</th>
                <th scope="col">DELETE</th>
            </tr>
        </thead>
        <tbody>
            <?php
            require '../../Controller/connect.php'; // Inclure le fichier de connexion

            try {
                $pdo = config::getConnexion();
                $query = "SELECT id, name, subject_description, depot_fichier_subject FROM subject";
                $stmt = $pdo->query($query);

                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr>";
                    echo "<th scope='row'>" . htmlspecialchars($row['id']) . "</th>";
                    echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['subject_description']) . "</td>";

                    // Afficher le lien de téléchargement du fichier
                    echo '<td><a href="../uploads/' . htmlspecialchars($row['depot_fichier_subject']) . '" download>' . htmlspecialchars($row['depot_fichier_subject']) . '</a></td>';

                    // Bouton EDIT qui redirige vers la page d'édition avec l'ID du sujet
                    echo '<td><a class="btn btn-primary" href="../../view/admin/edit_subject.php?id=' . $row['id'] . '">EDIT</a></td>';
                    
                    // Formulaire DELETE avec confirmation
                    echo '<td>
                            <form action="../../model/delete.php" method="POST" onsubmit="return confirm(\'Are you sure?\');">
                                <input type="hidden" name="url" value="' . htmlspecialchars($page) . '">
                                <input type="hidden" name="type" value="subject">
                                <input type="hidden" name="id" value="' . htmlspecialchars($row['id']) . '">
                                <input class="btn btn-danger" type="submit" value="DELETE">
                            </form>
                        </td>';
                    echo "</tr>";
                }
            } catch (PDOException $e) {
                die("Could not connect to the database: " . $e->getMessage());
            }
            ?>
        </tbody>
    </table>
</div>


    </div>
    </div>
</main>