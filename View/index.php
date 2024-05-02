<?php


$page = isset($_GET['failed']) ? $_GET['failed'] : null;
$page = isset($_GET['page']) ? $_GET['page'] : null;
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
    <form class="mx-auto" method="POST" action="../model/login.php">
      <div class="row">
        <div class="col text-center">
          <img src="components/images/proschool-logo.png" width="260" alt="">
        </div>

      </div>

      <?php
      if ($page == '1') {
        echo '<div class="alert alert-danger" role="alert">Incorrect password !!</div>';
      } elseif ($page == '2') {
        echo '<div class="alert alert-danger" role="alert">No user found with that email address. !!</div>';
      } elseif ($page == '3') {
        echo '<div class="alert alert-danger" role="alert">Email and password are required.. !!</div>';
      } elseif ($page == '4') {
        echo '<div class="alert alert-danger" role="alert">Please use the login form to submit your data.</div>';
      }
     elseif ($page == '5') {
      echo '<div class="alert alert-success" role="alert">Password changed successfully.</div>';
    }
      ?>
      <div class="mb-3 mt-5">
        <label for="exampleInputEmail1" class="form-label">Email</label>
        <input name="mail" type="email" class="form-control" placeholder="Enter your Email" id="exampleInputEmail1" required aria-describedby="emailHelp">
      </div>
      <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Password</label>
        <input name="password" type="password" class="form-control" placeholder="Enter your Password" id="exampleInputPassword1" required>
        <div id="emailHelp" class="form-text mt-3"> <a href="forget_password.php">Forget password ?</a> </div>
      </div>

      <button type="submit" class="btn btn-primary mt-5">Login</button>
    </form>
  </div>


  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
  </script>

</body>

</html>