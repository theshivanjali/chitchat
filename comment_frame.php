<?php  
include("config/dbconnect.php");
include("classes/User.php");
include("post.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>
    <link rel="stylesheet" href="css/istyle.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Love+Ya+Like+A+Sister" rel="stylesheet">
    
    
</head>
<body>
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

<script>

function toggle(){

    var element = document.getElementByID("comment_section");
        if(element.style.display == "block"){
            element.style.display = "none";
        }else {
            element.style.display = "none";
        }
}

</script>

<?php 

//get id of the post

if(isset($_GET['post_id'])){

    $post_id = $_GET['post_id'];
}

$user_query = $con -> mysqli_query("SELECT added_by, user_to FROM posts WHERE id = '$post_id'");

$row = mysqli_fetch_array($user_query);

$posted_to = $row['added_by'];

if(isset($_POST['postComment'.$post_id])){

    $post_body = $_POST['post_body'];
    $post_body = mysqli_escape_string($con, $post_body);
    $date_time_now = date("Y-m-d H:i:s");
    $insert_post = mysqli_query($con, "INSERT INTO comments VALUES ('', '$post_body', '$userLoggedIn', '$posted_to', '$date_time_now', 'no', 'post_id')");
    echo "<p>Comment Posted</p>";
}

?>

<form action="comment_frame.php?post_id=<?php echo $post_id; ?>" id="comment_form" name="postComment<?php echo $post_id; ?>" method="post">

<textarea name="post_body" id="post_body" cols="30" rows="10"></textarea>
<input type="submit" value="Comment" name="postComment<?php echo $post_id; ?>">
</form>

<!----- Load Comments ---->$_POST
<?php 

$get_comments = mysqli_query($con, "SELECT * FROM comments WHERE post_id ='$post_id' ORDER BY id ASC");

?>


</body>
</html>