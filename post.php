<?php include "includes/header.php";?>
<?php include 'includes/db.php';?>
<?php include "Functions/fetch_post.php";?>
    <!-- Navigation -->
<?php include "includes/navigation.php"?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
                <?php

                if(isset($_GET['p_id'])){
                    $post_id = escape($_GET['p_id']);
                    $view_query = "UPDATE posts SET post_view_count=post_view_count+1 WHERE post_id=$post_id";
                    $view_query_result = mysqli_query($connection, $view_query);
                    $result = fetch_specific_post($post_id);
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
                <img class="img-responsive" src="/cms/images/<?php echo $post_image?>" alt="">
                <hr>
                <p><?php echo $post_content?></p>

                <hr>
                <?php
                    }}
                ?>
                 <!-- Blog Comments -->

                <!-- Comments Form -->
                <div class="well">
                    <?php
    if(isset($_POST['submit_comment'])){
        $comment_author = escape($_POST['comment_author']); 
        $comment_email = escape($_POST['comment_email']);
        $comment_content = escape($_POST['comment_content']);

        $query = "INSERT INTO comments(comment_post_id,comment_author,comment_email,comment_content,comment_status,comment_date) ";
        $query.="VALUES($post_id,'$comment_author','$comment_email','$comment_content','unapproved',now())";
        $result = mysqli_query($connection,$query);
        if(!$result){
            die("Query Failed ".mysqli_error($connection));
        }
        $query_increment_comment = "UPDATE posts SET post_comment_counts = post_comment_counts+1 where post_id=$post_id";
        $result_comment_increment = mysqli_query($connection,$query_increment_comment);
        if(!$result_comment_increment){
            die("Query Failed ".mysqli_error($connection));
        }
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
                $result = mysqli_query($connection,$query);
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
                }
                ?> 


            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php"?>;

        </div>
        <!-- /.row -->

        <hr>

        <!-- Footer -->
        <?php include "includes/footer.php" ?>
