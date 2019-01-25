<?php 
require 'config/dbconnect.php';
require 'handlers/form_handler/register_handler.php';
require 'handlers/form_handler/login_handler.php';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Let's ChitChat</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Love+Ya+Like+A+Sister" rel="stylesheet">
</head>
<body>
        <div class="container">
            <div class="row">
              <div class="col-lg-4 mx-auto mt-5">
                <div class="card">
                    <div class="card-header">
                        <h4>
                          Account Login  
                        </h4>
                        <div class="card-body">
                             <form action="register.php" method="post">
                                 
                                 <div class="form-group">
                                     <label for="email">Email</label>
                                     <input type="email" class="form-control" name="log_email"
                                     value = "<?php 
                                                if (isset($_SESSION['log_email'])) {

                                                    echo $_SESSION['log_email'];

                                                }
                                                ?>"
                                     required >
                                </div>
                                 <div class="form-group">
                                        <label for="password">Password</label>
                                        <input type="password" class="form-control" name = "log_password">
                                    </div>

                                  <input type="submit" class="btn btn-primary btn-block" value="Login" name = "login_button">

                                    <?php 
                                      if (in_array("Email or Password is incorrect", $error_array))
                                    echo "<p class='lead alert-danger'>Email or Password is incorrect<br></p>";
                                        ?>
                             </form>
                        </div>
                    </div>
                </div>
              </div>
          </div>
        </div>
    <div class="container">
        <div class="row">
            <div class=" card col-lg-4 mx-auto mt-5 border-dark">
                <div class="card-body text-center">
                    <h3 class="display-5"> Sign Up Today </h3>
                    <p class="lead">Please fill out this form to register</p>
                    <hr>
                      <form action="register.php" method="post">
                        <div class="form-group">
                            <input type="text" name="reg_fname" placeholder="First Name" required class="form-control" 
                             value = "<?php 
                                        if (isset($_SESSION['reg_fname'])) {

                                            echo $_SESSION['reg_fname'];

                                        }
                                      ?>" >
                                 
                       <?php 
                        if (in_array("Your first name must be between 2 and 25 characters", $error_array))
                            echo "<p class='lead alert-danger'>Your first name must be between 2 and 25 characters</p>";

                        ?>
                        </div>
                        <div class="form-group">
                            <input type="text" name="reg_lname" placeholder="Last Name" required class="form-control" 
                            value = "<?php 
                                    if (isset($_SESSION['reg_lname'])) {

                                        echo $_SESSION['reg_lname'];

                                    }
                                    ?>" >
                        <?php 
                        if (in_array("Your last name must be between 2 and 25 characters", $error_array))
                            echo "<p class='lead alert-danger'>Your last name must be between 2 and 25 characters</p>";
                        ?>
                        </div>
                        <div class="form-group">
                         <input type="email" name="reg_email" placeholder="Email" required class="form-control" 
                         value = "<?php 
                                    if (isset($_SESSION['reg_email'])) {

                                        echo $_SESSION['reg_email'];

                                    }
                                    ?>" >
                                    <?php 
                                    if (in_array("invalid Format for Email", $error_array)) {
                                        echo "<p class='lead alert-danger'>invalid Format for Email</p>";
                                    }

                                    ?>
                        </div>
                        <div class="form-group">
                         <input type="email" name="reg_email2" placeholder="Confirm Email" required class="form-control"
                         value = "<?php 
                                    if (isset($_SESSION['reg_email2'])) {

                                        echo $_SESSION['reg_email2'];

                                    }
                                    ?>">
                        <?php 
                        if (in_array("Emails do not match", $error_array)) {
                            echo "<p class='lead alert-danger'>Emails do not match</p>";
                        }
                        ?>
                        </div>
                        <div class="form-group">
                         <input type="password" name="reg_password" placeholder="Password" required class="form-control"> 
                        <?php

                        if (in_array("Your password must be in between 5 and 30 characters", $error_array)) {
                            echo "<p class='lead alert-danger'>Your password must be in between 5 and 30 characters</p>";
                        }
                        if (in_array("Your password can only contain english characters or numbers", $error_array))
                            echo "<p class='lead alert-danger'>Your password can only contain english characters or numbers</p>";
                        ?>
                        </div>
                        <div class="form-group">
                         <input type="password" name="reg_password2" placeholder=" Confirm Password" required class="form-control" >
                        <?php
                        if (in_array("Your passwords don't match", $error_array))
                            echo "<p class='lead alert-danger'>Your passwords don't match</p>";
                        ?>
                        </div>
                        <input type="submit" value="Register" class="btn btn-block btn-danger" name="reg_button">
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.min.js"></script>
</html>