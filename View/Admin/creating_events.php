<?php
include '../../Controller/event_con.php';
$eventC = new eventCon("events");
$events = $eventC->listEvents();
$result = isset($_GET['result']) ? $_GET['result'] : null;
?>


    <main style="padding-top:20px;">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <?php
                    switch ($result) {
                        case '1':
                            echo '<div class="alert alert-success" role="alert">Event created successfully !</div>';
                            break;
                        case '2':
                            echo '<div class="alert alert-danger" role="alert">An error occurred !</div>';
                            break;
                        case '3':
                            echo '<div class="alert alert-danger" role="alert">Please submit the form.!</div>';
                            break;
                        case '4':
                            echo '<div class="alert alert-warning" role="alert">Event already exists.!</div>';
                            break;
                        default:
                            echo '<div class="alert alert-primary" role="alert">Fill in the form to add an event!</div>';
                            break;
                    }
                    ?>

                    <form action="../../Model/add_event.php" method="post" style="max-width: 100rem; padding: 20px; margin-bottom: 20px; border: 1px solid #ccc; box-shadow: 0 2px 6px rgba(0,0,0,0.1);">
                        <h5>Add New Event</h5>
                        <div class="form-group">
                            <label for="titre"><b>Title</b></label>
                            <input type="text" class="form-control" placeholder="Enter Title" name="titre" id="titre" required>
                        </div>
                        <div class="form-group">
                            <label for="date"><b>Date</b></label>
                            <input type="date" class="form-control" placeholder="Enter Date" name="date" id="date" required>
                        </div>
                        <div class="form-group">
                            <label for="prix"><b>Price</b></label>
                            <input type="text" class="form-control" placeholder="Enter Price" name="prix" id="prix" required>
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
                                <th>Price</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($events as $event) : ?>
                                <tr>
                                    <td><?= htmlspecialchars($event['id']); ?></td>
                                    <td><?= htmlspecialchars($event['titre']); ?></td>
                                    <td><?= htmlspecialchars($event['date']); ?></td>
                                    <td><?= htmlspecialchars($event['prix']); ?></td>
                                    <td>
                                        <a href="index.php?id=<?= $event['id']; ?>&page=UE&result=4" class="btn btn-primary">Update</a>
                                        <a href="../../Model/delete_event.php?id=<?= $event['id']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this event?');">Delete</a>
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