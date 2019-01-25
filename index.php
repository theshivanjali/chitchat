<?php 
require 'config/dbconnect.php';
require 'handlers/form_handler/register_handler.php';
require 'handlers/form_handler/login_handler.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Let'sChitChat</title>
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Love+Ya+Like+A+Sister" rel="stylesheet">
  </head>
  
<body>

<?php if(isset($_POST['reg_button']))
{
  echo'
<script>
$(document).ready(function() {

$("#reg_button").click(function(){

  $("#first").hide();
  $("#second").show();
    });
  });
</script>';
}

?>

  <div class="imgbg">
    <div class="dark-overlay">

      <div class="col-lg-12 d-lg-block">
        <div class="mx-5">
          <h1 class="title">Let's ChitChat</h1>
        </div>
      </div>


        <div id="first">

          <div class="container">
            <div class="row">
              <div class="col-lg-4 mx-auto mt-5">
                <div class="card">
                    <div class="card-header">
                        <h4 class= "text-center">
                          Login  
                        </h4>
                        <hr style = "border-color:white; border-style:solid;">
                        <div class="card-body">
                             <form action="index.php" method="post">
                               
                                 <div class="form-group"> 
                                    
                                     <input type="email" class="form-control" name="log_email" placeholder ="Email"
                                     value = "<?php 
                                              if (isset($_SESSION['log_email'])) {

                                                echo $_SESSION['log_email'];

                                              }
                                              ?>"
                                     required >
                                </div>

                                                          
                                 <div class="form-group">
                                     
                                        <input type="password" class="form-control" name = "log_password" placeholder = "Password">
                                    </div>
                                    <?php 
                                    if (in_array("Email or Password is incorrect", $error_array))
                                      echo "<p class=' text-bold text-center text-danger'> Email or Password is incorrect</p>";
                                    ?>   
                                    
                                        <a href="forget.php" id="forgot" class="forgot">Forget Password?</a>
                                        
                                  <br>
                                  <input type="submit" class="btn btn-primary btn-block mt-1" value="Login" name = "login_button">

                                   
                                    <br>
                                                
                                                <a href="#" id="signup" class="signup">Need an account? Register here!</a>
                                                                                    
                             </form>
                        </div>
                    </div>
                </div>
              </div>
          </div>
        </div>   
    </div>

      <div id="second">
      <div class="container">
        <div class="row">
            <div class=" card col-lg-4 mx-auto border-dark">
                <div class="card-body text-center">
                    <h3 class="display-5"> Sign Up Today </h3>
                    <p class="lead">Please fill out this form to register</p>
                    <hr style = "border-color:white; border-style:solid;">
                      <form action="index.php" method="post">
                        <div class="form-group">
                            <input type="text" name="reg_fname" placeholder="First Name" required class="form-control" 
                             value = "<?php 
                                      if (isset($_SESSION['reg_fname'])) {

                                        echo $_SESSION['reg_fname'];

                                      }
                                      ?>" >
                                 
                       <?php 
                      if (in_array("Your first name must be between 2 and 25 characters", $error_array))
                        echo "Your first name must be between 2 and 25 characters";

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
                          echo "<Your last name must be between 2 and 25 characters";
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
                                      echo "invalid Format for Email";
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
                          echo "Emails do not match";
                        }
                        ?>
                        </div>
                        <div class="form-group">
                         <input type="password" name="reg_password" placeholder="Password" required class="form-control"> 
                        <?php

                        if (in_array("Your password must be in between 5 and 30 characters", $error_array)) {
                          echo "Your password must be in between 5 and 30 characters<br>";
                        }
                        if (in_array("Your password can only contain english characters or numbers", $error_array))
                          echo "Your password can only contain english characters or numbers";
                        ?>
                        </div>
                        <div class="form-group">
                         <input type="password" name="reg_password2" placeholder=" Confirm Password" required class="form-control" >
                        <?php
                        if (in_array("Your passwords don't match", $error_array))
                          echo "Your passwords don't match";
                        ?>
                        </div>
                        <input type="submit" value="Register" class="btn btn-block btn-danger" name="reg_button" id="reg_button">
                    </form>
                    <?php if (in_array("<span style='color: #14C800;'>You're all set! Go ahead and login!</span><br>", $error_array)) echo "<span style='color: #14C800;'>You're all set! Go ahead and login!</span><br>"; ?>
                       <br>
                        <a href="#" id="signin" class="signin">Already have an account? Sign in here!</a>
                </div>
            </div>
        </div>
      </div>         
  </div>
  </div>
</div>
</body>

<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="js/register.js"></script>
</html>