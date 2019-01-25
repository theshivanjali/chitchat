<?php 

if ((isset($_GET['token'])) && (isset($_get['email']))) {
    $con = new mysqli("localhost", "root", "", "social");

    $email = filter_var($_POST['for_email'], FILTER_SANITIZE_EMAIL);
    $token = $con->real_escape_string($_GET['token']);

    $data = $con->query("SELECT * FROM recovery WHERE email ='$email' and token = '$token' ");

    $error_array = array();

    if ($data->num_rows > 0) {

        if (isset($_POST['reset_password'])) {

            $newpassword = strip_tags($_POST['new_password']);
            $cnfpassword = strip_tags($_POST['cnf_new_password']);

            if ($newpassword != $cnfpassword) {

                array_push($error_array, "Your passwords don't match");

            } else {
                if (preg_match('/[^A-Za-z0-9]/', $newpassword)) {                                    //checks if there are alphabets and numerals only

                    array_push($error_array, "Your password can only contain english characters or numbers");


                }
            }

            if (strlen($newpassword) > 30 || strlen($newpassword) < 8) {                       //checks the length of the string

                array_push($error_array, "Your password must be in between 5 and 30 characters");

            }
        
        
            //////////////////////////////////////////////////////////////Encrypting Password /////////////////////////////////////////////////////////////////////

            if (empty($error_array)) {

                $newpassword = password_hash($newpassword, PASSWORD_DEFAULT);

                $update = $con->query("UPDATE users SET password = '$newpassword' WHERE email = '$email'");

                array_push($error_array, "<span style='color: #14C800;'>You're all set! Go ahead and login!</span><br>");

            }

        } else {
            echo "Please Check your link!";
        }
    } else {
        header("location: index.php");
        exit();

    }
}

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

<div class="imgbg">
    <div class="dark-overlay">

      <div class="col-lg-12 d-lg-block">
        <div class="mx-5">
          <h1 class="title">Let's ChitChat</h1>
        </div>
      </div>
          
          <div class="container">
          <div class="row">
            <div class="card col-lg-4 mx-auto border-dark">
            <div class="card-body">
              <h3 class="display-5 text-center">
                Reset Password</h3>
                <hr style = "border-color:white; border-style:solid;">
                <form action="" method="post">                      
                     <div class="form-group">
                     <input type="password" name="new_password" id="new_password" placeholder="New Password" required class="form-control">
                     </div>   
                    
                     <div class="form-group">
                     <input type="password" name="cnf_new_password" id="cnf_new_password" placeholder="Confirm New Password" required class="form-control">
                     </div>      
                    
                     
                     <input type="submit" value="Submit" class="btn btn-block btn-danger" name="reset_password" id="reset_password">

                      </form>
                <br>
                     <a href="index.php">Sign in to continue?</a>
               
                    </form>
          
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
