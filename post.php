<?php
class Post
{
	private $user_obj;
	private $con;

	public function __construct($con, $user)
	{
		$this->con = $con;
		$this->user_obj = new User($con, $user);
	}
	public function submitPost($body, $user_to)
	{
		$body = strip_tags($body); //removes html tags 
		$body = mysqli_real_escape_string($this->con, $body);
		$check_empty = preg_replace('/\s+/', '', $body); //Deltes all spaces 
		if ($check_empty != "") {

			//current date and time
			$date_added = date("Y-m-d H:i:s");
			//Get Username
			$added_by = $this->user_obj->getUsername();

			//If user is on own profile, user_to is 'none'

			if ($user_to == $added_by) {
				$user_to = "none";
			}

			//insert post
			$query = mysqli_query($this->con, "INSERT INTO posts VALUES('', '$body', '$added_by', '$user_to', '$date_added','no', 'no', '0')");
			$returned_id = mysqli_insert_id($this->con);

			//Update post count for user 
			$num_posts = $this->user_obj->getNumPosts();
			$num_posts++;
			$update_query = mysqli_query($this->con, "UPDATE users SET num_posts='$num_posts' WHERE username='$added_by'");

		}



	}
	public function loadPostsFriends($data, $limit)
	{

		$page = $data['page'];
		$userLoggedIn = $this->user_obj->getUsername();

		if ($page == 1) {
			$start = 0;
		} else {
			$start = ($page - 1) * $limit;
		}


		$str = ""; //string to return
		$data_query = mysqli_query($this->con, "SELECT * FROM posts WHERE deleted='no' ORDER BY id DESC");

		if(mysqli_num_rows($data_query) > 0){

			$num_iterations = 0;
			$count = 1;			

		while ($row = mysqli_fetch_array($data_query)) {
			$id = $row['id'];
			$body = $row['body'];
			$added_by = $row['added_by'];
			$date_time = $row['date_added'];

				//Prepare user_to string so it can be included even if not posted to a user
			if ($row['user_to'] == "none") {
				$user_to = "";
			} else {
				$user_to_obj = new User($con, $row['user_to']);
				$user_to_name = $user_to_obj->getFirstAndLastName();
				$user_to = "to <a href='" . $row['user_to'] . "'>" . $user_to_name . "</a>";
			}

				//Check if user who posted, has their account closed
			$added_by_obj = new User($this->con, $added_by);
			if ($added_by_obj->isClosed()) {
				continue;
			}

			if($num_iterations++ < $start){
				continue;
			}

			//once 10 posts have been loaded, break

			if($count > $limit){
				break;
			}else {
				$count ++;
			}

			$user_logged_obj = new User($this->con, $userLoggedIn);
			if ($user_logged_obj->isFriend($added_by)) {



				$user_details_query = mysqli_query($this->con, "SELECT first_name, last_name, profile_pic FROM users WHERE username='$added_by'");
				$user_row = mysqli_fetch_array($user_details_query);
				$first_name = $user_row['first_name'];
				$last_name = $user_row['last_name'];
				$profile_pic = $user_row['profile_pic'];
				?>
					<script> 
					function toggle<?php echo $id; ?>(){

						var target = $(event.target);
						if (!target.is("a")) {
							var element = document.getElementById("toggleComment<?php echo $id; ?>");

							if(element.style.display == "block") 
								element.style.display = "none";
							else 
								element.style.display = "block";
						}
					}

				</script>

<?php
					//Timeframe
$date_time_now = date("Y-m-d H:i:s");
$start_date = new DateTime($date_time); //Time of post
$end_date = new DateTime($date_time_now); //Current time
$interval = $start_date->diff($end_date); //Difference between dates 
if ($interval->y >= 1) {
	if ($interval == 1)
		$time_message = $interval->y . " year ago"; //1 year ago
	else
		$time_message = $interval->y . " years ago"; //1+ year ago
} else if ($interval->m >= 1) {
	if ($interval->d == 0) {
		$days = " ago";
	} else if ($interval->d == 1) {
		$days = $interval->d . " day ago";
	} else {
		$days = $interval->d . " days ago";
	}


	if ($interval->m == 1) {
		$time_message = $interval->m . " month" . $days;
	} else {
		$time_message = $interval->m . " months" . $days;
	}

} else if ($interval->d >= 1) {
	if ($interval->d == 1) {
		$time_message = "Yesterday";
	} else {
		$time_message = $interval->d . " days ago";
	}
} else if ($interval->h >= 1) {
	if ($interval->h == 1) {
		$time_message = $interval->h . " hour ago";
	} else {
		$time_message = $interval->h . " hours ago";
	}
} else if ($interval->i >= 1) {
	if ($interval->i == 1) {
		$time_message = $interval->i . " minute ago";
	} else {
		$time_message = $interval->i . " minutes ago";
	}
} else {
	if ($interval->s < 30) {
		$time_message = "Just now";
	} else {
		$time_message = $interval->s . " seconds ago";
	}
}

$str .= '<div class="card gedf-card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="mr-2">
                                    <img class="rounded-circle" width="45" src="' . $profile_pic . '" alt="">
                                </div>
                                <div class="ml-2">
                                    <div class="h5 m-0">
                                    <a href="' . $added_by . '">' . $first_name . '&nbsp;' . $last_name . '</a>' . $user_to . '
                                   </div>
                                </div>
                            </div>
                            <div>
                                <div class="dropdown">
                                    <button class="btn btn-link dropdown-toggle" type="button" id="gedf-drop1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-ellipsis-h"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="gedf-drop1">
                                        <div class="h6 dropdown-header">Configuration</div>
                                        <a class="dropdown-item" href="#">Save</a>
                                        <a class="dropdown-item" href="#">Hide</a>
                                        <a class="dropdown-item" href="#">Report</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="text-muted h7 mb-2"> <i class="fa fa-clock-o"></i>' . $time_message . '</div>
                        <p class="card-text">' .
	$body . '
                        </p>
                    </div>
                    <div class="card-footer">
                        <a href="#" class="card-link"><i class="fa fa-gittip"></i> Like</a>
                        <a href="#" onclick="javascript:toggle' . $id . '();" class="card-link"><i class="fa fa-comment"></i> Comment</a>
                        <a href="#" class="card-link"><i class="fa fa-mail-forward"></i> Share</a>
                    </div>
				</div>
				<div class="" id=toggleComment' . $id . ' style = "display:none;">
						<iframe src="comment_frame.php?post_id=' . $id . ' id="comment_frame" frameborder="0"></iframe>
						</div>
                ';
}
}

} //End while loop


echo $str;


}




}

?>