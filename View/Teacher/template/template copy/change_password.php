<!DOCTYPE html> 
<html lang="en">
    
<?php
include "head.php";
$result = isset($_GET['result']) ? $_GET['result'] : null;
?>
    <body>

        <!-- Main Wrapper -->
        <div class="main-wrapper">
        
            <div class="row">
            
                <!-- Login Banner -->
                <div class="col-md-6 login-bg">
                    <div class="owl-carousel login-slide owl-theme aos" data-aos="fade-up">
                        <div class="welcome-login">
                            <div class="login-banner">
                                <img src="assets/img/login-img.png" class="img-fluid" alt="Logo">
                            </div>
                            <div class="mentor-course text-center">
                                <h2>Welcome to <br>DreamsLMS Courses.</h2>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.</p>
                            </div>
                        </div>
                        <div class="welcome-login">
                            <div class="login-banner">
                                <img src="assets/img/login-img.png" class="img-fluid" alt="Logo">
                            </div>
                            <div class="mentor-course text-center">
                                <h2>Welcome to <br>DreamsLMS Courses.</h2>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.</p>
                            </div>
                        </div>
                        <div class="welcome-login">
                            <div class="login-banner">
                                <img src="assets/img/login-img.png" class="img-fluid" alt="Logo">
                            </div>
                            <div class="mentor-course text-center">
                                <h2>Welcome to <br>DreamsLMS Courses.</h2>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Login Banner -->

                <div class="col-md-6 login-wrap-bg">      
                
                    <!-- Change Password -->

                    <div class="login-wrapper">
                        <div class="loginbox">
                            <div class="img-logo">
                                <img src="assets/img/logo.svg" class="img-fluid" alt="Logo">
                                <div class="back-home">
                                    <a href="index.php">Back to Home</a>
                                </div>
                            </div>
                            <h1>Change Password</h1>
                            <div class="reset-password">
                                <p>Enter your current password and new password below.</p>
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
                        echo '<div class="alert alert-danger" role="alert">Actual password is incorrect.!</div>
                            <div class="card border-danger mb-3 " style="max-width: 100rem;">';
                        break;
                    case '4':
                        echo '<div class="alert alert-warning" role="alert">New password and confirm password do not match.!</div>
                                    <div class="card border-warning mb-3 " style="max-width: 100rem;">';
                        break;
                    default:
                        echo '<div class="alert alert-primary" role="alert">Input the FORM !</div>
                            <div class="card border-dark mb-3 " style="max-width: 100rem;">';
                        break;
                }
                ?>
                            </div>
                            <form action="../../../Model/change_password.php" method="post">
                                <div class="input-block">
                                    <label class="form-control-label">Current Password</label>
                                    <input type="password" name="actualPassword" class="form-control" placeholder="Enter your current password" required>
                                </div>
                                <div class="input-block">
                                    <label class="form-control-label">New Password</label>
                                    <input type="password" name="newPassword" class="form-control" placeholder="Enter your new password" required>
                                </div>
                                <div class="input-block">
                                    <label class="form-control-label">Confirm New Password</label>
                                    <input type="password" name="confirmPassword" class="form-control" placeholder="Confirm your new password" required>
                                </div>
                                <div class="d-grid">
                                    <button class="btn btn-start" type="submit">Change Password</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- /Change Password -->
                    
                </div>
                
            </div>
           
       </div>
       <!-- /Main Wrapper -->
      
        <!-- jQuery -->
        <script src="assets/js/jquery-3.7.1.min.js"></script>
        
        <!-- Bootstrap Core JS -->
        <script src="assets/js/bootstrap.bundle.min.js"></script>

        <!-- Owl Carousel -->
        <script src="assets/js/owl.carousel.min.js"></script> 
        
        <!-- Custom JS -->
        <script src="assets/js/script.js"></script>
        
    </body>

<!-- Mirrored from dreamslms.dreamstechnologies.com/html/forgot-password.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 03 Feb 2024 21:45:15 GMT -->
</html>
