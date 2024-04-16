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
                        echo '<div class="alert alert-danger" role="alert">Please submit the form.!</div>
                            <div class="card border-danger mb-3 " style="max-width: 100rem;">';
                        break;
                    case '4':
                        echo '<div class="alert alert-warning" role="alert">Subject already exists.!</div>
                                    <div class="card border-warning mb-3 " style="max-width: 100rem;">';
                        break;
                    default:
                        echo '<div class="alert alert-primary" role="alert">Input the FORM !</div>
                            <div class="card border-dark mb-3 " style="max-width: 100rem;">';
                        break;
                }
                ?>
                <div class="card-header">
                    <h5>Create Subject</h5>
                    <div class="card-body text-dark">
                        <form class="row g-3" method="POST" action="../../model/creating_subject.php">
                            <div class="col-md-6">
                                <label for="subject" class="form-label">Name</label>
                                <input name="subject"    type="text" class="form-control" id="subject"  required>
                                <div class="valid-feedback">Looks good!</div>
                                <div class="invalid-feedback">Please enter your name.</div>
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
                        <th scope="col">EDIT</th>
                        <th scope="col">DELETE</th>
                    </tr>
                </thead>
                <tbody>
                <tbody>
                    <?php
                    require '../../Controller/connect.php'; // Adjust the path as necessary

                    try {
                        $pdo = config::getConnexion();
                        $query = "SELECT id, name FROM subject";
                        $stmt = $pdo->query($query);

                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            echo "<tr>";
                            echo "<th scope='row'>" . htmlspecialchars($row['id']) . "</th>";
                            echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                            echo '<td><input class="btn btn-primary" type="button" value="EDIT"></td>';
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
                        die("Could not connect to the database :" . $e->getMessage());
                    }
                    ?>

                </tbody>
            </table>
        </div>
    </div>
    </div>
</main>