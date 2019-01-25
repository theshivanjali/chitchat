<?php

//Declaring Variables

$fname = "";    //first name
$lname = "";    //last name
$email = "";    //email
$email2 = "";    // confirm email
$password = ""; //password
$password2 = ""; //password2
$date = ""; //sign up date
$error_array = array(); //to hold error messages

if (isset($_POST['reg_button'])) {

    //Registering the form values

    //First Name
    $fname = strip_tags($_POST['reg_fname']);   //remove html if any
    $fname = str_replace(" ", "", $fname); //removes blank spaces
    $fname = ucfirst(strtolower($fname)); // only first letter in uppercase
    $_SESSION['reg_fname'] = $fname; //stores first name into session variable

    //Last Name
    $lname = strip_tags($_POST['reg_lname']);   //remove html if any
    $lname = str_replace(" ", "", $lname); //removes blank spaces
    $lname = ucfirst(strtolower($lname)); // only first letter in uppercase
    $_SESSION['reg_lname'] = $lname; //stores last name into session variable

    //Email 
    $email = strip_tags($_POST['reg_email']); //removes html if any
    $email = str_replace(" ", "", $email); // removse blank spaces
    $email = ucfirst(strtolower($email)); // email first letter
    $_SESSION['reg_email'] = $email; //stores email into session variable

    // confirm Email 
    $email2 = strip_tags($_POST['reg_email2']); //removes html if any
    $email2 = str_replace(" ", "", $email2); // removse blank spaces
    $email2 = ucfirst(strtolower($email2)); // email2 first letter
    $_SESSION['reg_email2'] = $email; //stores email2 into session variable

    //password
    $password = strip_tags($_POST['reg_password2']); //removes html if any
    $_SESSION['reg_password'] = $password; //stores email into session variable

    //confirm password
    $password2 = strip_tags($_POST['reg_password2']); //removes html if any
    $_SESSION['reg_password2'] = $password2; //stores email into session variable
    
    //date
    $date = date("Y-m-d"); //current date

    //////////////////////////////////////////////////////////Email Validation//////////////////////////////////////////////////////////

    if ($email == $email2) {

        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

            $email = filter_var($email, FILTER_VALIDATE_EMAIL); //validated version of the email

            //check if email already exists
            $e_check = mysqli_query($con, "SELECT email FROM users WHERE email = '$email'");

            //count the number of rows
            $num_rows = mysqli_num_rows($e_check);

            if ($num_rows > 0) {
                array_push($error_array, "This email already exists");
            }

        } else {

            array_push($error_array, "invalid Format for Email");

        }

    } else {
        array_push($error_array, "Emails do not match");
    }

    if (strlen($fname) > 25 || strlen($fname) < 2) {
        array_push($error_array, "Your first name must be between 2 and 25 characters"); //first name validation 
    }


    if (strlen($lname) > 25 || strlen($lname) < 2) {
        array_push($error_array, "Your last name must be between 2 and 25 characters"); //last name validation 
    }

    /////////////////////////////// password validation //////////////////////////////////////////////////

    if ($password != $password2) {

        array_push($error_array, "Your passwords don't match");

    } else {
        if (preg_match('/[^A-Za-z0-9]/', $password)) {                                    //checks if there are alphabets and numerals only

            array_push($error_array, "Your password can only contain english characters or numbers");


        }
    }

    if (strlen($password) > 30 || strlen($password) < 8) {                       //checks the length of the string

        array_push($error_array, "Your password must be in between 5 and 30 characters");

    }


    //////////////////////////////////////////////////////////////Encrypting Password /////////////////////////////////////////////////////////////////////

    if(empty($error_array)){

        $password = password_hash($password, PASSWORD_DEFAULT); //ecrypting password before sending it to database

        //Generating username by concataning first name and last name.

        $username = strtolower($fname)."_".strtolower($lname);
        $check_username_query = mysqli_query($con, "SELECT username FROM users WHERE username = '$username'");

        $i = 0;
        //if username exist add number to username

        while(mysqli_num_rows($check_username_query) != 0) {
            $i++; //Add 1 to i
            $username = $username."_".$i;
            $check_username_query = mysqli_query($con, "SELECT username FROM users WHERE username = '$username'");
        }

        //Profile picture assignment

        $rand = rand(1,2);

        if($rand == 1){
        $profile_pic = "img/profile_picture/black_profile.png";}
        else if ($rand == 2){
        $profile_pic = "img/profile_picture/blue_profile.png";}


        $query = mysqli_query($con, "INSERT INTO users VALUES ('', '$fname', '$lname', '$username', '$email', '$password', '$date', '$profile_pic', '0', '0', 'no', ',')");
      
        array_push($error_array, "<span style='color: #14C800;'>You're all set! Go ahead and login!</span><br>");

        //Clear session variables 
		$_SESSION['reg_fname'] = "";
		$_SESSION['reg_lname'] = "";
		$_SESSION['reg_email'] = "";
		$_SESSION['reg_email2'] = "";
    }

}
?>
