<?php 
include("header.php");
include("classes/User.php");
include("post.php");

if (isset($_POST['post'])){

  $post = new Post($con, $userLoggedIn);
  $post->submitPost($_POST['post_text'], 'none');

}

if(isset($_GET['profile_username'])){

	$username = $_GET['profile_username'];
	$user_details_query = mysqli_query($con, "SELECT * FROM users WHERE username = '$username'");
	$user_array = mysqli_fetch_array($user_details_query);

	$num_friends = (substr_count($user_array['friend_array'], ",")) - 1;

	}


?>


<style>
#coverpic{	
    background-image: url('../img/cover_picture/default_cover.jpg');
    background-repeat: no-repeat;
    background-size: 100% 100%;
}
.shadow-lg0 {
    box-shadow: 0 1rem 2.5rem rgba(0,0,0,.175)!important;
}
</style>

<div class="container jumbotron text-center" style="margin-bottom:0;padding-bottom:1rem;height:auto;color:#fff;border-radius:0px;" id="coverpic">
	<div class="clearfix">
		<div class="profile_pic float-sm-left">
			<img src="<?php echo $user['profile_pic']; ?>" class="rounded-circle" style="height:150px;width:150px;border:5px solid #fff;"> 
		</div>
		<div class="float-sm-left ml-1 mt-4 text-dark">
			<h2><?php echo $user['first_name'].'&nbsp;'.$user['last_name'];  ?></h2>
			<h4><?php echo $user['username'];?></h4>
		</div>
	</div>
	<div class="clearfix">
		<div class="float-sm-right ml-1">
			<button type="button" class="btn"><i class="fa fa-check" style="color:blue;"></i>Add Friend</button>
		
			<button type="button" class="btn btn-info"><i class="fa fa-envelope-o"></i> Message</button>
		</div>
	</div>
</div>
<div class="container card shadow"style="border-radius:0px 0px 5px 5px;padding:0px 5px 0px 50px;">
	<!-- Nav tabs -->	
	<ul class="nav nav-tabs float-sm-left">
	  <li class="nav-item">
		<a class="nav-link active" data-toggle="tab" href="#home">Timeline</a>
	  </li>
	  <li class="nav-item">
		<a class="nav-link" data-toggle="tab" href="#menu1">About</a>
	  </li>
	  <li class="nav-item">
		<a class="nav-link" data-toggle="tab" href="#menu2">Friends</a>
	  </li>
	  <li class="nav-item">
		<a class="nav-link" data-toggle="tab" href="#menu2">Photos</a>
	  </li>
	</ul>
	
</div>

<div class="container" style="margin-top:40px;">
	<div class="row">
		<div class="col-sm-3">
			<div class="card shadow">
				<div class="card-body">
					<h5><i class="fa fa-globe"></i> Intro</h5>
					
                </div>
				<ul class="list-group list-group-flush">
                    <li class="list-group-item">
					<h6><i class="fa fa-heart"></i> Likes: <?php echo $user['num_likes']; ?></h6>
						<h6><i class="fa fa-comment"></i> Total Posts: <?php echo $user['num_posts']; ?></h6>
						<h6><i class="fa fa-clock-o"></i> Date Joined: <?php echo $user['signup_date']; ?></h6>
						<h6><i class="fa fa-users"></i> Friends: <?php  ?></h6>
					
						
                        
                    </li>                   
                </ul>
            </div><!-----1st card end here--->
			<div class="card mt-2">                
				<div class="card-body">
					<h5 class="card-title"><i class="fa fa-picture-o"></i> Photos</h5>					
				  <!----- photos--->
					<div class="">
						<img src="users/img/maleAvatar.png" class="m-1" style="width:60px">
						<img src="users/img/maleAvatar.png" class="m-1" style="width:60px">
						<img src="users/img/maleAvatar.png" class="m-1" style="width:60px">
						<img src="users/img/maleAvatar.png" class="m-1" style="width:60px">
						
						<img src="users/img/maleAvatar.png" class="m-1" style="width:60px">
						<img src="users/img/maleAvatar.png" class="m-1" style="width:60px">
					</div>					
                </div>
            </div> <!-----2nd card end here--->
			<div class="card mt-2">
                <div class="card-body">
					<h5 class="card-title"><i class="fa fa-users"></i>Friends</h5>
                    <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                            card's content.</p>
                    <a href="#" class="card-link">Card link</a>
                    <a href="#" class="card-link">Another link</a>
                </div>
            </div>                		
		<!--------======================== Side bar profile end below =======================----------------->
		</div>
		
		<div class="col-sm-6">
		<!--------======================== Make a post section start =======================----------------->
		<form action="profile.php" method="post">
		
		<div class="card shadow-sm">
                    <div class="card-header">
                        <ul class="nav nav-tabs card-header-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="posts-tab" data-toggle="tab" href="#posts" role="tab" aria-controls="posts" aria-selected="true">Wanna Share some GupShup?
                                    </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="images-tab" data-toggle="tab" role="tab" aria-controls="images" aria-selected="false" href="#images">Images</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="posts" role="tabpanel" aria-labelledby="posts-tab">
                                <div class="form-group">
                                    <label class="sr-only" for="message">post</label>
                                    <textarea class="form-control" id="message" rows="3" placeholder="What are you thinking?" name="post_text"></textarea>
                                </div>

                            </div>
                            <div class="tab-pane fade" id="images" role="tabpanel" aria-labelledby="images-tab">
                                <div class="form-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="customFile">
                                        <label class="custom-file-label" for="customFile">Upload image</label>
                                    </div>
                                </div>
                                <div class="py-4"></div>
                            </div>
                        </div>
                        <div class="btn-toolbar justify-content-between">
                            <div class="btn-group">
                                <button type="submit" class="btn btn-primary" name="post">share</button>
                            </div>
                            <div class="btn-group">
                                <button id="btnGroupDrop1" type="button" class="btn btn-link dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                    <i class="fa fa-globe"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="btnGroupDrop1">
                                    <a class="dropdown-item" href="#"><i class="fa fa-globe"></i> Public</a>
                                    <a class="dropdown-item" href="#"><i class="fa fa-users"></i> Friends</a>
                                    <a class="dropdown-item" href="#"><i class="fa fa-user"></i> Only me</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
		
				
				</form>
			
			<!------------ //////////-------  Posts/ NewsFeed start here ------- ////////-----------///////////-->
			<div class="posts_area"></div>
<img src="img/icons/loading.gif" alt="loading" id = "loading">

</div>
<!-- Post /////-->
<script>

    var userLoggedIn = '<?php echo $userLoggedIn; ?>';

        $(document).ready(function(){

            $('#loading').show();

            //original ajax request for loading first post

            $.ajax({

                url: "ajax_load_posts.php",
                type: "POST",
                data: "page=1&userLoggedIn=" + userLoggedIn,
                cache: false,

                success: function(data){

                    $('#loading').hide();
                    $('.posts_area').html(data);
                }
            });

            $(window).scroll(function(){
                var height = $('.posts_area').height(); //div containing posts
                var scroll_top = $(this).scrollTop();
                var page = $('.posts_area').find('.nextPage').val();
                var noMorePosts = $('.posts_area').find('.noMorePosts').val();

                if ((document.body.scrollHeight == document.body.scrollTop + window.innerHeight) && noMorePosts == 'false'){
                    $('#loading').show();
                  

                       var ajaxReq =  $.ajax({

                            url: "ajax_load_posts.php",
                                type: "POST",
                                data: "page=" + page +"&userLoggedIn=" + userLoggedIn,
                                cache: false,
                                success: function(response){

                                    $('.posts_area').find('.nextPage').remove(); //removes next page
                                    $('.posts_area').find('.noMorePosts').remove(); 

                                $('#loading').hide();
                                $('.posts_area').append(response);
                            }
                                });
                        } //End if
                        
                        return false;
            });  //End window .scroll function

        });

</script>



			<!--- \\\\\\\Post-->
                
                <!-- Post /////-->

			
	
		<!--//////-----------------==============------   Col-sm 8- end below ////// =============--------/////------- /////-->			
		</div>
	
	</div>
</div>

<?php
include_once('footer.php');
?>
