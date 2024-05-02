<?php
$page = isset($_GET['failed']) ? $_GET['failed'] : null;
session_start(); // Ensure the session is started
if (isset($_SESSION['code'])) {
    $code = $_SESSION['code']; // Retrieve the code from session
}
if (isset($_SESSION['id'])) {
  $id = $_SESSION['id']; // Retrieve the code from session
}
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
    <form class="mx-auto" method="POST" action="../model/check_code.php">
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
        echo '<div class="alert alert-danger" role="alert">Error Occured.. !!</div>';
      }
     elseif ($page == '5') {
      echo '<div class="alert alert-success" role="alert">Password changed successfully.</div>';
    }
      ?>
      <p class="fs-5 text-center fw-bold">We sended an email for you with a code 6-digits</p>
      <div class="mb-3 mt-5">
        <input type="hidden" value="<?=$code?> " name="code" >
        <input type="hidden" value="<?=$id?> " name="id" >
        <label for="exampleInputEmail1" class="form-label">Code</label>
        <input name="digit" type="text" class="form-control" placeholder="6-digits" id="exampleInputEmail1" required aria-describedby="emailHelp">
      </div>


      <button type="submit" class="btn btn-primary mt-5">Reset Password</button>
    </form>
  </div>


  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
  </script>

</body>

</html>