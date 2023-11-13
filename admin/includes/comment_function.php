<?php
function fetch_all_comment(){
 global $connection;
 $query = "SELECT * FROM comments";
 $result = mysqli_query($connection,$query);
 return $result;
}
function fetch_specific_comment($post_id){
 global $connection;
 $query = "SELECT * FROM comments WHERE comment_post_id=$post_id";
 $result = mysqli_query($connection,$query);
 return $result;
}
function delete_comment($comment_id){
 global $connection;
 $query = "DELETE FROM comments WHERE comment_id=$comment_id";
 $result = mysqli_query($connection,$query);
 if(!$result){
  die("Query Failed " . mysqli_error($connection));
 }
}

function approve_comment($comment_id){
 global $connection;
 $query = "UPDATE comments set comment_status='approved' WHERE comment_id=$comment_id";
 $result = mysqli_query($connection,$query);
 if(!$result){
  die("Query Failed " . mysqli_error($connection));
 }
}

function unapprove_comment($comment_id){
 global $connection;
 $query = "UPDATE comments set comment_status='unapproved' WHERE comment_id=$comment_id";
 $result = mysqli_query($connection,$query);
 if(!$result){
  die("Query Failed " . mysqli_error($connection));
 }
}

function decrement_comment($comment_id){
 global $connection;
 $query = "SELECT * FROM comments where comment_id=$comment_id";
 $result = mysqli_query($connection,$query);
 $row = mysqli_fetch_assoc($result);
 $the_post_id = $row['comment_post_id'];
 $query_decrement_post_comment  = "UPDATE posts set post_comment_counts=post_comment_counts-1 where post_id=$the_post_id";
 $result_decrement_comment = mysqli_query($connection,$query_decrement_post_comment);
 if(!$result_decrement_comment){
  die("Query failed ". mysqli_error($connection));
 }
}

function delete_comment_of_post($post_id){
 global $connection;
 $query = "DELETE FROM comments WHERE comment_post_id=$post_id";
 $result = mysqli_query($connection,$query);
 if(!$result){
  die("Query Failed " . mysqli_error($connection));
 }
}
?>