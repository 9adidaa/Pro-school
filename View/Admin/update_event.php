<?php
include '../../Controller/event_con.php';
include '../../Model/event.php';
$result = isset($_GET['result']) ? $_GET['result'] : null;
// Création d'une instance du contrôleur des événements
$eventC = new eventCon("events");

// Création d'une instance de la classe Event
$event = null;

if (isset($_GET['id'])){
    $current_id = $_GET['id'];
}

if (
    isset($_POST["titre"]) &&
    isset($_POST["date"]) &&
    isset($_POST["prix"])
) {
    if (
        !empty($_POST['titre']) &&
        !empty($_POST["date"]) &&
        !empty($_POST["prix"])
    ) {
       
        $event = new Event(
            $current_id,
            $_POST['titre'],
            $_POST['date'],
            $_POST['prix'],
        );

        $eventC->updateEvent($event, $current_id);
        header('Location:../View/admin/index.php?page=CE&result=1');
    } else {
        $error = "Missing information";
    }
} elseif (isset($_GET['id'])) {
    $current_id = $_GET['id'];
    $event = $eventC->getEvent($current_id);
}
?>

<main style="padding-top:20px;">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <?php
                    switch ($result) {
                        case '1':
                            echo '<div class="alert alert-success" role="alert">Event updated successfully!</div>';
                            break;
                        case '2':
                            echo '<div class="alert alert-danger" role="alert">An error occurred!</div>';
                            break;
                        case '3':
                            echo '<div class="alert alert-danger" role="alert">Please submit the form.</div>';
                            break;
                        default:
                            echo '<div class="alert alert-primary" role="alert">Fill in the form to update the event.</div>';
                            break;
                    }
                    ?>

                    <form action="../../Model/update_event.php" method="post" style="max-width: 100rem; padding: 20px; margin-bottom: 20px; border: 1px solid #ccc; box-shadow: 0 2px 6px rgba(0,0,0,0.1);">
                        <input type="hidden" name="id" value="<?= $eventId; ?>"> <!-- Hidden field for event ID -->
                        <h5>Edit Event</h5>
                        <div class="form-group">
                            <label for="titre"><b>Title</b></label>
                            <input type="text" class="form-control" placeholder="Enter Title" name="titre" id="titre" value="<?= htmlspecialchars($event['titre']); ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="date"><b>Date</b></label>
                            <input type="date" class="form-control" name="date" id="date" value="<?= htmlspecialchars($event['date']); ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="prix"><b>Price</b></label>
                            <input type="text" class="form-control" placeholder="Enter Price" name="prix" id="prix" value="<?= htmlspecialchars($event['prix']); ?>" required>
                        </div>
                        <br>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>


   <script src="../scripst/add_modal_verif.js"></script>

