<?php 
require 'config/dbconnect.php';

if (isset($_POST['forgot_button'])){

  $email = filter_var($_POST['for_email'], FILTER_SANITIZE_EMAIL);
  $data = $con -> query("SELECT * FROM users WHERE email = '$email'");
  
  if($data -> num_rows > 0){

    $con -> query("INSERT into recovery (email) VALUES ('$email')");

      $str = '0123456789abcdefghijklmnopqrstuvwxyz';
    $str = str_shuffle($str);
    $str = substr($str, 0, 15);
    $url = "/chitchat/resetpassword.php?token=".$str."&email=".$email;
   
                     
    echo "<div class='d-block'><a href ='".$url."'>Click to reset </a></div>";


    

    $to = $email;
    $subject = "Reset Password";
    $message =  "To reset your password, please visit this:".$url;
    $headers = 'MIME-Version: 1.0'.'\r\n';
    $headers .= 'From: shivanjali012@gmail.com'.'\r\n';
    $headers .='Content-type: text/html; charset=iso-8859-1'.'\r\n';

     mail($to, $subject, $message, $headers);
    
    $con -> query("UPDATE recovery SET token='$str' WHERE email='$email'");
    echo "Mail Send";
  }
      else {
        echo "error!";
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
                Forgot Password?</h3>
                <hr style = "border-color:white; border-style:solid;">
                <form action="forget.php" method="post">                      
                     <div class="form-group">
                     <input type="email" name="for_email" id="for_email" placeholder="Enter Email" required class="form-control">
                     </div>                         
                     <input type="submit" value="Submit" class="btn btn-block btn-danger" name="forgot_button" id="forgot_button">
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
