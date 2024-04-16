<?php
include '../Controller/examen_con.php';
$examenC = new examenCon("examen");
$examens = $examenC->listExamens();
$result = isset($_GET['result']) ? $_GET['result'] : null;
?>


    <main style="padding-top:20px;">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <?php
                    switch ($result) {
                        case '1':
                            echo '<div class="alert alert-success" role="alert">Operation successfully !</div>';
                            break;
                        case '2':
                            echo '<div class="alert alert-danger" role="alert">An error occurred !</div>';
                            break;
                        case '3':
                            echo '<div class="alert alert-danger" role="alert">Please submit the form.!</div>';
                            break;
                        case '4':
                            echo '<div class="alert alert-warning" role="alert">Examen already exists.!</div>';
                            break;
                        default:
                            echo '<div class="alert alert-primary" role="alert">Fill in the form to add an examen!</div>';
                            break;
                    }
                    ?>

                    <form action="../Model/create_examen.php" method="post" style="max-width: 100rem; padding: 20px; margin-bottom: 20px; border: 1px solid #ccc; box-shadow: 0 2px 6px rgba(0,0,0,0.1);">
                        <h5>Add New Examen</h5>
                        <div class="form-group">
                            <label for="titre"><b>Title</b></label>
                            <input type="text" class="form-control" placeholder="Enter Title" name="titre" id="titre" required>
                        </div>
                        <div class="form-group">
                            <label for="date"><b>Date</b></label>
                            <input type="date" class="form-control" placeholder="Enter Date" name="date" id="date" required>
                        </div>
                        <div class="form-group">
                            <label for="subject"><b>Subject</b></label>
                            <select class="form-select" name="id_subject" id="">
                                <option value="1">math</option>
                                <option value="2">physique</option>
                                <option value="3">francais</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="class"><b>Class</b></label>
                            <select class="form-select" name="id_class" id="">
                                <option value="1">2A31</option>
                                <option value="2">2A32</option>
                                <option value="3">2A33</option>
                            </select>
                        </div>
                        <br>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>

                <div class="col-md-12" style="padding-top:20px;">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Date</th>
                                <th>class</th>
                                <th>subject</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($examens as $examen) : ?>
                                <tr>
                                    <td><?= htmlspecialchars($examen['id']); ?></td>
                                    <td><?= htmlspecialchars($examen['titre']); ?></td>
                                    <td><?= htmlspecialchars($examen['date']); ?></td>
                                    <td><?= htmlspecialchars($examen['id_subject']); ?></td>
                                    <td><?= htmlspecialchars($examen['id_class']); ?></td>
                                    <td>
                                        <a href="index.php?id=<?= $examen['id']; ?>&page=UE" class="btn btn-primary">Update</a>
                                        <a href="../Model/delete_examen.php?id=<?= $examen['id']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this event?');">Delete</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
    <script src="../scripts/add_modal_verif.js"></script>