    <?php

if(isset($_POST['login_button'])){


    $email1 = filter_var($_POST['log_email'], FILTER_SANITIZE_EMAIL); // Checks if email is in correct format

    $_SESSION['log_email'] = $email1; //stores emial into session variable

    $password_form = $_POST['log_password']; //get password
  
    $check_database_query = mysqli_query($con,"SELECT * FROM users WHERE email = '$email1'");
    
    $row = mysqli_fetch_array($check_database_query);
    
    $passwordHash = $row['password'];

   
     if(password_verify($password_form, $passwordHash)){

        $username = $row['username'];

        $user_closed_query = mysqli_query("SELECT * FROM users WHERE email = '$email1' AND user_closed = 'yes'");
        if(mysqli_num_rows($user_closed_query) == 1){

            $reopen_account = mysqli_query($con, "UPDATE users SET user_closed = 'no' WHERE email = '$email1'");
            
        }
        $_SESSION['username'] = $username;
        header("Location: login_index.php");
        exit();
    }
    else{
    array_push($error_array, "Email or Password is incorrect") ;
    $_SESSION['email']="";
    }


}



?>