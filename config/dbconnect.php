<?php

ob_start(); //turns on output buffering

session_start();    

$timezone = date_default_timezone_set("Asia/Kolkata");

$con = mysqli_connect("localhost", "root", "", "social"); //checking the connnection

if (mysqli_connect_errno()) {

    echo "Failed to connect" . mysqli_connect_errno();

}

?>