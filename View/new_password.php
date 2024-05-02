<?php


$page = isset($_GET['failed']) ? $_GET['failed'] : null;
$id = isset($_GET['i']) ? $_GET['i'] : null;
?>
<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link href="css/login.css?v=<?php echo time(); ?>" rel="stylesheet">
  <title>Login Form</title>
</head>

<body>
  <div class="container-fluid">
  <form class="mx-auto" method="POST" action="../model/change_password1.php" onsubmit="return validatePasswords();">
        <div class="row">
            <div class="col text-center">
                <img src="components/images/proschool-logo.png" width="260" alt="">
            </div>
        </div>

        <?php
        if ($page == '1') {
            echo '<div class="alert alert-danger" role="alert">do not use the same password as the currect password !!</div>';
        } elseif ($page == '2') {
            echo '<div class="alert alert-danger" role="alert">No user found with that email address. !!</div>';
        } elseif ($page == '3') {
            echo '<div class="alert alert-danger" role="alert">Email and password are required.. !!</div>';
        } elseif ($page == '4') {
            echo '<div class="alert alert-danger" role="alert">Error Occured.. !!</div>';
        } elseif ($page == '5') {
            echo '<div class="alert alert-success" role="alert">Password changed successfully.</div>';
        }
        ?>
        <input type="hidden" name="id" value="<?=$id ?>">
        <div class="mb-3 mt-5">
            <label for="newPassword" class="form-label">New Password</label>
            <input name="new_password" type="password" class="form-control" placeholder="New Password" id="newPassword" required>
        </div>
        <div class="mb-3 mt-5">
            <label for="confirmPassword" class="form-label">Confirm Password</label>
            <input name="confirm_password" type="password" class="form-control" placeholder="Confirm Password" id="confirmPassword" required>
        </div>

        <button type="submit" class="btn btn-primary mt-5">Change Password</button>
    </form>

  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
  </script>
    <script>
        function validatePasswords() {
            var newPassword = document.getElementById('newPassword').value;
            var confirmPassword = document.getElementById('confirmPassword').value;
            if (newPassword !== confirmPassword) {
                alert('The passwords do not match. Please enter the same password in both fields.');
                return false; // Prevent form submission
            }
            return true; // Allow form submission
        }
    </script>
</body>

</html>