<?php 

include("header.php");
include("classes/User.php");
include("post.php");

if (isset($_POST['post'])) {

    $post = new Post($con, $userLoggedIn);
    $post->submitPost($_POST['post_text'], 'none');

}

?>


<div class="container-fluid" style="height:10px;"></div>
<div class="container-fluid gedf-wrapper">
        <div class="row">
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <div class="h5"><a href='<?php echo "$userLoggedIn"; ?>'>
                        <?php echo $user['username']; ?>
                        </a></div>
                        <div class="h7 text-muted">Fullname :  <?php echo $user['first_name'] . '&nbsp;' . $user['last_name']; ?></div>
                        <div class="h7 text-muted">Email: <?php echo $user['email']; ?>
                        </div>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <div class="h6 text-muted">Date Joined</div>
                            <div class="h5"> <?php echo $user['signup_date']; ?></div>
                        </li>
                        <li class="list-group-item">
                            <div class="h6 text-muted">Posts:</div>
                            <div class="h5"><?php echo $user['num_posts']; ?></div>
                        </li>
                        <li class="list-group-item">
                            <div class="h6 text-muted">Likes:</div>
                            <div class="h5"><?php echo $user['num_likes']; ?></div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-6 gedf-main">

                <!--- \Form to submit post-->
                <form action="login_index.php" method="post">
                <div class="card gedf-card">
                    <div class="card-header">
                        <ul class="nav nav-tabs card-header-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="posts-tab" data-toggle="tab" href="#posts" role="tab" aria-controls="posts" aria-selected="true">Wanna share some GupShup?</a>
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
                                     <textarea class="form-control" id="post_text" name="post_text" rows="3" placeholder="What are you thinking?"></textarea>
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
                                <button type="submit" class="btn btn-primary" name="post" id="post_button">Share</button>
                            </div>
                        </div>
                    </div>
                </div>
                </form>
                <!-- Post /////-->


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


            
            <div class="col-md-3">
                <div class="card gedf-card">
                    <div class="card-body">
                        <h5 class="card-title">Advertisment</h5>
                        <h6 class="card-subtitle mb-2 text-muted">Lorem Ipsum</h6>
                        <p class="card-text">
                            Lorem ipsum, dolor sit amet consectetur adipisicing elit. Provident, consectetur.
                        </p>
                        <a href="#" class="card-link">lorem ipsum</a>
                        <a href="#" class="card-link">lorem ipsum</a>
                    </div>
                </div>
                <div class="card gedf-card">
                        <div class="card-body">
                            <h5 class="card-title">Advertisment</h5>
                            <h6 class="card-subtitle mb-2 text-muted">Lorem Ipsum</h6>
                            <p class="card-text">
                            Lorem ipsum dolor sit amet consectetur, adipisicing elit. Accusamus, possimus.
                            </p>
                            <a href="#" class="card-link">Lorem</a>
                            <a href="#" class="card-link">Lorem</a>
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