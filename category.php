<?php include "includes/header.php";
use MyApp\Session;
use MyApp\Helper\Helper;
?>
    <!-- Navigation -->
<?php include "includes/navigation.php"?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
                <?php
                if(isset($_GET['cat_id'])){ 
                 $cat_id =  $database->escape($_GET['cat_id']);
                 if(Session::get_session('user_role') && Session::get_session('user_role')==='admin'){
                    $result=Post::fetch_specific_cat_post_admin($cat_id);
                 }else{
                    $result=Post::fetch_specific_cat_post($cat_id);
                 }
                 $count = mysqli_num_rows($result);
                 if($count<1){
                    echo "<h2 class='text-center'>No category post available</h2>";
                 }else{
                    while($row = mysqli_fetch_assoc($result)){
                        $post_id = $row['post_id'];
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
                    <a href="post.php?p_id=<?php echo $post_id?>"><?php echo $post_title?></a>
                </h2>
                <p class="lead">
                    by <a href="/cmso/index.php"><?php echo $post_author?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date?></p>
                <hr>
                <img class="img-responsive" src="/cmso/images/<?php echo $post_image?>" alt="">
                <hr>
                <p><?php echo $post_content?></p>
                <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>
                <?php
                 }}}else{
                    Helper::redirect("index");
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
