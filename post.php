<?php include "includes/header.php";
use MyApp\Session;
use MyApp\Helper\Helper;

?>
<!-- Navigation -->
<?php include "includes/navigation.php"?>
<?php
if(isset($_GET['p_id']) && !Validation::isAdmin() && Post::is_post_draft($_GET['p_id']) ){
    Helper::redirect('/cms/index');
}
?>


    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
                <?php

                if(isset($_GET['p_id'])){
                    $post_id = $database->escape($_GET['p_id']);
                    $view_query_result = $database->query("UPDATE posts SET post_view_count=post_view_count+1 WHERE post_id=$post_id");
                    $result = Post::fetch_specific_post($post_id);
                // else{
                //     $result = fetch_post();
                // }
                    
                    while($row = mysqli_fetch_assoc($result)){
                        $post_title = $row['post_title'];
                        $post_author = $row['post_user'];
                        $post_date = $row['post_date'];
                        $post_image = $row['post_image'];
                        $post_content = $row['post_content'];
                ?>
            
                <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1>

                <!-- First Blog Post -->
                <h2>
                    <a href="#"><?php echo $post_title?></a>
                </h2>
                <p class="lead">
                    by <a href=""><?php echo $post_author?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date?></p>
                <hr>
                <img class="img-responsive" src="/cmso/images/<?php echo $post_image?>" alt="">
                <hr>
                <p><?php echo $post_content?></p>

                <hr>
                <?php
                    }
                ?>
                <?php if(Validation::isLoggedIn()):?>
                    <?php
                 $liked = Like::userLikedThis($post_id,Validation::getUserId());
                ?>
                <div class="row">
                        <p class="pull-right"><a
                                class="<?php echo $liked?'unlike':'like'; ?>"
                                href=""><span class="<?php echo $liked?'glyphicon glyphicon-thumbs-down':'glyphicon glyphicon-thumbs-up'; ?>"></span><?php echo $liked?" Unlike":" Like"?>
                            </a></p>
                    </div>
                <?php else:?>
                    <div class="row">
                    <p class="pull-right">You need to <a href="/cms/login">login </a>to like this post</p>
                    </div>
                    
                <?php endif;?>
                <div class="row">
                    <p class="pull-right">Like: <span class="likes"><?php echo Like::getPostLikes($post_id) ?></span> </p>
                </div>

                 <div class="clearfix"></div>


                 <!-- Blog Comments -->

                <!-- Comments Form -->
                <div class="well">
                    <?php
    if(isset($_POST['submit_comment'])){
        $comment_author = $database->escape($_POST['comment_author']); 
        $comment_email = $database->escape($_POST['comment_email']);
        $comment_content = $database->escape($_POST['comment_content']);

        $query = "INSERT INTO comments(comment_post_id,comment_author,comment_email,comment_content,comment_status,comment_date) VALUES($post_id,'$comment_author','$comment_email','$comment_content','unapproved',now())";
        $result = $database->query($query);
        $query_increment_comment = "UPDATE posts SET post_comment_counts = post_comment_counts+1 where post_id=$post_id";
        $result_comment_increment = $database->query($query_increment_comment);
    }
?>
                    <h4>Leave a Comment:</h4>
                    <form  action="" method="post" class="form">
                        <div class="form-group">
                            <label for="comment_author" class="label-dark" >Author</label>
                            <input type="text" name="comment_author" id="comment_author" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="comment_email" class="label-dark">Email</label>
                            <input type="email" name="comment_email" id="comment_email" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="comment_content" class="label-dark">Comment</label>
                            <textarea class="form-control" name="comment_content" id="comment_content" rows="3"></textarea required>
                        </div>
                        <button type="submit" name="submit_comment" class="btn btn-primary">Submit</button>
                    </form>
                </div>

                <hr>

                <!-- Posted Comments -->

                <!-- Comment -->

                <?php
                $query = "SELECT * FROM comments WHERE comment_status = 'approved' ORDER BY comment_id DESC";
                $result = $database->query($query);
                while($row = mysqli_fetch_assoc($result)){
                    $comment_author = $row['comment_author'];
                    $comment_date = $row['comment_date'];
                    $comment_content = $row['comment_content'];
                ?>
                
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading"><?php echo $comment_author?>
                            <small><?php echo $comment_date?></small>
                        </h4>
                        <?php echo $comment_content?>
                    </div>
                </div>

               <?php
                }}
                ?> 


            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php"?>;

        </div>
        <!-- /.row -->

        <hr>

        <!-- Footer -->
        <?php include "includes/footer.php" ?>
        <script>
           $(document).ready(function(){
    var user_id = <?php echo Session::get_session('user_id'); ?>;
    var post_id = <?php echo $post_id; ?>;

    // Use event delegation for dynamic elements
    $(document).on('click', '.like', function(e) {
        e.preventDefault();
        $.ajax({
            url: "http://localhost/cms/includes/handle_like.php",
            type: 'post',
            data: {
                'liked': 1,
                'user_id': user_id,
                'post_id': post_id
            },
            success: function(response) {
                const data = JSON.parse(response);
                console.log(data.likes);
                $('.like').removeClass('like').addClass('unlike').html("<span class='glyphicon glyphicon-thumbs-down'></span> Unlike");
                $('.likes').text(data.likes);
            }
        });
    });

    $(document).on('click', '.unlike', function(e) {
        e.preventDefault();
        $.ajax({
            url: "http://localhost/cms/includes/handle_like.php",
            type: 'post',
            data: {
                'unliked': 1,
                'user_id': user_id,
                'post_id': post_id
            },
            success: function(response) {
                const data = JSON.parse(response);
                console.log(data.likes);
                $('.unlike').removeClass('unlike').addClass('like').html("<span class='glyphicon glyphicon-thumbs-up'></span> Like");
                $('.likes').text(data.likes);
            }
        });
    });
});
            
        </script>
