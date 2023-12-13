<?php 
include 'includes/admin_header.php';
?>
<?php use MyApp\Session; ?>
  <div id="wrapper">

        <!-- Navigation -->
        <?php include "includes/admin_navigation.php"?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                    <h1 class="page-header">
                            Welcome <?Php echo Session::get_session('user_role')?>
                            <small> <?Php echo Session::get_session('username')?></small>
                        </h1>
<?php
if(isset($_GET['delete'])){
 $comment_id = $_GET['delete'];
 $post_id = $_GET['post_id'];
 Comment::decrement_comment($comment_id);
 Comment::delete_comment($comment_id);
 header("Location: post_comment.php?post_id={$post_id}");
 exit();
}


if(isset($_GET['approve'])){
 $comment_id = $_GET['approve'];
 $post_id = $_GET['post_id'];
 Comment::approve_comment($comment_id);
 header("Location: post_comment.php?post_id={$post_id}");
 exit();
}

if(isset($_GET['unapprove'])){
 $comment_id = $_GET['unapprove'];
 $post_id = $_GET['post_id'];
 Comment::unapprove_comment($comment_id);
 header("Location: post_comment.php?post_id={$post_id}");
 exit();
}
?>
<table class="table table-bordered table-hover">
 <thead>
  <tr>
   <th>comment_id</th>
   <th>Response To</th>
   <th>author</th>
   <th>Email</th>
   <th>Content</th>
   <th>Date</th>
   <th>Status</th>
   <th>Approve</th>
   <th>Unapprove</th>
   <th>Delete</th>
  </tr>
 </thead>
 <tbody>
  <?php
   if(isset($_GET['post_id'])){
   $the_post_id = $_GET['post_id'];
   $result_comment = Comment::fetch_specific_comment($the_post_id);
   while($row = mysqli_fetch_assoc($result_comment)){
    $comment_id = $row['comment_id'];
    $comment_post_id = $row['comment_post_id'];
    $comment_author = $row['comment_author'];
    $comment_email = $row['comment_email'];
    $comment_content = $row['comment_content'];
    $comment_date = $row['comment_date'];
    $comment_status = $row['comment_status'];
    $result_specific_post = Post::fetch_specific_post($comment_post_id);
    while($row_post = mysqli_fetch_assoc($result_specific_post)){
     $post_title=$row_post['post_title'];
    }
    echo "<tr>
   <td>{$comment_id}</td>
   <td><a href='../post.php?p_id={$comment_post_id}'>{$post_title}</a></td>
   <td>{$comment_author}</td>
   <td>{$comment_email}</td>
   <td>{$comment_content}</td>
   <td>{$comment_status}</td>
   <td>{$comment_date}</td>
   <td><a href='post_comment.php?approve={$comment_id}&post_id={$comment_post_id}'>Approve</a></td>
   <td><a href='post_comment.php?unapprove={$comment_id}&post_id={$comment_post_id}'>Unapprove</a></td>
   <td><a href='post_comment.php?delete={$comment_id}&post_id={$comment_post_id}'>Delete</a></td>
  </tr>";

   }
  }
  ?>
 </tbody>
</table>
               </div>
        
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
<?php include 'includes/admin_footer.php'?>
