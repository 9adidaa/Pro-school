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
                        echo '<div class="alert alert-success" role="alert">Password changed succesfully!</div>
                            <div class="card bg-success mb-3 " style="max-width: 100rem;">';
                        break;

                    case '2':
                        echo '<div class="alert alert-danger" role="alert">An error occurred !</div>
                            <div class="card border-danger mb-3 " style="max-width: 100rem;">';
                        break;
                    case '3':
                        echo '<div class="alert alert-danger" role="alert">Wrong actual password.!</div>
                            <div class="card border-danger mb-3 " style="max-width: 100rem;">';
                        break;
                    case '4':
                        echo '<div class="alert alert-warning" role="alert">New and confirm doesn"t match!</div>
                                    <div class="card border-warning mb-3 " style="max-width: 100rem;">';
                        break;
                    default:
                        echo '<div class="alert alert-primary" role="alert">Input the FORM !</div>
                            <div class="card border-dark mb-3 " style="max-width: 100rem;">';
                        break;
                }
                ?>
                <div class="card-header">
                    <h5>Create Class</h5>
                    <div class="card-body text-dark">
                        <form class="row g-3" method="POST" action="../../Model/change_password.php">
                            <div class="col-md-6">
                                <label for="actualPassword" class="form-label">Actual Password</label>
                                <input type="password" class="form-control" id="actualPassword" name="actualPassword" required>

                                <label for="newPassword" class="form-label">New Password</label>
                                <input type="password" class="form-control" id="newPassword" name="newPassword" required>

                                <label for="confirmPassword" class="form-label">Confirm Password</label>
                                <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" required>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-primary" type="submit">Change Password</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
            <div class="gap"></div>

        </div>
    </div>
</main>