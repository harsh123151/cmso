<?php
if(isset($_GET['delete'])){
 $comment_id = escape($_GET['delete']);
 decrement_comment($comment_id);
 delete_comment($comment_id);
 header("Location: comment.php");
 exit();
}


if(isset($_GET['approve'])){
 $comment_id = escape($_GET['approve']);
 approve_comment($comment_id);
 header("Location: comment.php");
 exit();
}

if(isset($_GET['unapprove'])){
 $comment_id = escape($_GET['unapprove']);
 unapprove_comment($comment_id);
 header("Location: comment.php");
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
   $result_comment = fetch_all_comment();
   while($row = mysqli_fetch_assoc($result_comment)){
    $comment_id = $row['comment_id'];
    $comment_post_id = $row['comment_post_id'];
    $comment_author = $row['comment_author'];
    $comment_email = $row['comment_email'];
    $comment_content = $row['comment_content'];
    $comment_date = $row['comment_date'];
    $comment_status = $row['comment_status'];
    $result_specific_post = fetch_specific_post($comment_post_id);
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
   <td><a href='comment.php?approve={$comment_id}'>Approve</a></td>
   <td><a href='comment.php?unapprove={$comment_id}'>Unapprove</a></td>
   <td><a href='comment.php?delete={$comment_id}'>Delete</a></td>
  </tr>";

   }
  ?>
 </tbody>
</table>
