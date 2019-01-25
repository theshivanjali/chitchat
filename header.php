<?php 
require 'config/dbconnect.php';

if (isset($_SESSION['username'])){

    $userLoggedIn = $_SESSION['username'];

    $user_detailed_query = mysqli_query($con, "SELECT * FROM users WHERE username = '$userLoggedIn'"); 

    $user = mysqli_fetch_array($user_detailed_query);
}
else {
    header("location: index.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Let's ChitChat</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="css/istyle.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Love+Ya+Like+A+Sister" rel="stylesheet">
    <style>
	.navbar-nav li{
		margin-right:25px;
	}
	</style>
</head>
<body> 
<nav class="navbar navbar-icon-top navbar-expand-lg navbar-dark bg-gray-dark sticky-top" style="padding:0.05rem 1rem !important;">
	<a class="navbar-brand title" href="login_index.php">Let's ChitChat</a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>

	<div class="collapse navbar-collapse" id="navbarSupportedContent">
		<form class="form-inline my-2 my-lg-0">
			<input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
			<button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
		</form>
		<ul class="navbar-nav ml-auto">
			<li class="nav-item">
				<a class="nav-link text-warning" href="profile.php">Hello,&nbsp;
                    <?php echo $user['first_name']; ?>
					
				</a>
			</li>
			<li class="nav-item active">
				<a class="nav-link" href="login_index.php">
					<i class="fa fa-home"></i>Home<span class="sr-only">(current)</span>
				</a>
			</li>			
			<li class="nav-item">
				<a class="nav-link" href="#">
					<i class="fa fa-envelope-o"><span class="badge badge-danger">11</span></i>Messages
				</a>
			</li>		
			<li class="nav-item">
				<a class="nav-link" href="#">
					<i class="fa fa-bell"><span class="badge badge-danger">11</span></i>Notifications
				</a>
			</li>
            <li class="nav-item">
				<a class="nav-link" href="#">
					<i class="fa fa-users"></i>Friends
				</a>
			</li>
            <li class="nav-item">
				<a class="nav-link" href="#">
					<i class="fa fa-gear"></i>Settings
				</a>
			</li>
            <li class="nav-item">
				<a class="nav-link" href="logout.php">
					<i class="fa fa-sign-out"></i>Log Out
				</a>
			</li>
		</ul>    
	</div>
</nav>