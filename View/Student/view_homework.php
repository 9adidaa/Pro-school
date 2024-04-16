<div class="col-md-12" style="padding-top:20px;">
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">NAME</th>
                <th scope="col">DESCRIPTION</th>
                <th scope="col">FILE DEPOT</th>
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
                    echo '<td><a href="../../../yassine/uploads/' . htmlspecialchars($row['depot_fichier_subject']) . '" download>' . htmlspecialchars($row['depot_fichier_subject']) . '</a></td>';


                    echo "</tr>";
                }
            } catch (PDOException $e) {
                die("Could not connect to the database: " . $e->getMessage());
            }
            ?>
        </tbody>
    </table>
</div>