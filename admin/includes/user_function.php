<?php
function fetch_all_user(){
 global $connection;
 $user_query = "SELECT * FROM users";
 $user_result = mysqli_query($connection,$user_query);
 if(!$user_result){
  die("Query Failed " . mysqli_error($connection));
 }
 return $user_result;
}
function delete_user($user_id){
 global $connection;
 $delete_query = "DELETE FROM users where user_id=$user_id";
 $delete_user_result = mysqli_query($connection,$delete_query);
 if(!$delete_user_result){
  die("Query Failed " . mysqli_error($connection));
 }
}

function set_user_admin($user_id){
 global $connection;
 $admin_query = "UPDATE users SET user_role='admin' where user_id=$user_id";
 $admin_user_result = mysqli_query($connection,$admin_query);
 if(!$admin_user_result){
  die("Query Failed " . mysqli_error($connection));
 }
}

function set_user_subscriber($user_id){
 global $connection;
 $subscriber_query = "UPDATE users SET user_role='subscriber' where user_id=$user_id";
 $subscriber_user_result = mysqli_query($connection,$subscriber_query);
 if(!$subscriber_user_result){
  die("Query Failed " . mysqli_error($connection));
 }
}

function fetch_specific_user($user_id){
 global $connection;
 $user_query = "SELECT * FROM users WHERE user_id=$user_id";
 $user_result = mysqli_query($connection,$user_query);
 if(!$user_result){
  die("Query Failed " . mysqli_error($connection));
 }
 return $user_result;
}
?>