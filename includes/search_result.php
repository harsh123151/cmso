<?php
                $post_per_page = 5;
                if(isset($_GET['page'])){
                    $page = $_GET['page'];
                }else{
                    $page = 1;
                }
                if(isset($_POST['submit'])){
                    $search = $_POST['search'];
                    if(isset($_SESSION['user_role']) && $_SESSION['user_role']==='admin'){
                        $count_query = "SELECT * FROM posts WHERE post_tags LIKE '%$search%'";
                        $count_query_result = mysqli_query($connection , $count_query);
                        $total_count = mysqli_num_rows($count_query_result);
                        $count  =ceil($total_count / $post_per_page);
                        $post_starting = ($page*$post_per_page) - $post_per_page;
                        $result = fetch_post_admin($_POST['search'],$post_starting,$post_per_page);
                    }else{
                        $count_query = "SELECT * FROM posts WHERE post_tags LIKE '%$search%' AND post_status='published'";
                        $count_query_result = mysqli_query($connection , $count_query);
                        $total_count = mysqli_num_rows($count_query_result);
                        $count  =ceil($total_count / $post_per_page);
                        $post_starting = ($page*$post_per_page) - $post_per_page;
                        $result = fetch_post($_POST['search'],$post_starting,$post_per_page);
                    }

                    if($total_count < 1){
                        echo "<h2 class='text-center'>No post available</h2>";
                    }else{
                          while($row = mysqli_fetch_assoc($result)){
                        $post_id = $row['post_id'];
                        $post_title = $row['post_title'];
                        $post_user = $row['post_user'];
                        $post_date = $row['post_date'];
                        $post_image = $row['post_image'];
                        $post_content = $row['post_content'];
                        $post_status = $row['post_status'];?>
                     
                        <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1>
                
                <!-- First Blog Post -->
                <h2>
                    <a href="post/<?php echo $post_id?>"><?php echo $post_title?></a>
                </h2>
                <p class="lead">
                    by 
                    <a href="author.php?author=<?php echo $post_user?>&p_id=<?php echo $post_id?>"><?php echo $post_user?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date?></p>
                <hr>
                <a href="post/<?php echo $post_id?>">
                        <img class="img-responsive" src="/cms/images/<?php echo $post_image?>" alt="">
                </a>
                <hr>
                <p><?php echo $post_content?></p>
                <a class="btn btn-primary" href="post/<?php echo $post_id?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>
<?php
                    }
                }
                    
                }else{
                    if(isset($_SESSION['user_role']) && $_SESSION['user_role']==='admin'){
                        $count_query = "SELECT * FROM posts";
                        $count_query_result = mysqli_query($connection , $count_query);
                        $total_count = mysqli_num_rows($count_query_result);
                        $count  =ceil($total_count / $post_per_page);
                        $post_starting = ($page*$post_per_page) - $post_per_page;
                        $result = fetch_post_Admin("",$post_starting,$post_per_page);
                    }else{
                        $count_query = "SELECT * FROM posts WHERE post_status='published'";
                        $count_query_result = mysqli_query($connection , $count_query);
                        $total_count = mysqli_num_rows($count_query_result);
                        $count  =ceil($total_count / $post_per_page);
                        $post_starting = ($page*$post_per_page) - $post_per_page;
                        $result = fetch_post("",$post_starting,$post_per_page);
                    }

                    if($total_count<1){
                        echo "<h2 class='text-center'>No post available</h2>";
                    }else{
                    
                     
                    while($row = mysqli_fetch_assoc($result)){
                        $post_id = $row['post_id'];
                        $post_title = $row['post_title'];
                        $post_user = $row['post_user'];
                        $post_date = $row['post_date'];
                        $post_image = $row['post_image'];
                        $post_content = $row['post_content'];
                        $post_status = $row['post_status'];
                ?>
                <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1>
                
                <!-- First Blog Post -->
                <h2>
                    <a href="post/<?php echo $post_id?>"><?php echo $post_title?></a>
                </h2>
                <p class="lead">
                    by 
                    <a href="author.php?author=<?php echo $post_user?>&p_id=<?php echo $post_id?>"><?php echo $post_user?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date?></p>
                <hr>
                <a href="post/<?php echo $post_id?>">
                        <img class="img-responsive" src="/cms/images/<?php echo $post_image?>" alt="">
                </a>
                <hr>
                <p><?php echo $post_content?></p>
                <a class="btn btn-primary" href="post/<?php echo $post_id?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>
                   

                <?php
                    }
                    }
                }
                ?>