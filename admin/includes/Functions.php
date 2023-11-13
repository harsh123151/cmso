<?php
function redirect($location){
  header("Location: ".$location);
}
function delete_cat($cat_id){
 global $connection;
 $query = "DELETE FROM categories WHERE cat_id=$cat_id";
 $result = mysqli_query($connection,$query);
 if(!$result){
  die("Query failed");
 }
}

function add_cat($cat_title){
 global $connection;
 $query = "INSERT INTO categories(cat_title) Values('$cat_title')";
 $result = mysqli_query($connection,$query);
 if(!$result){
  die("Query Failed");
 }
}

function edit_cat($cat_title,$cat_id){
 global $connection;
 $query = "UPDATE categories SET cat_title='$cat_title' where cat_id=$cat_id";
 echo $cat_id." hello<br>";
 $result = mysqli_query($connection,$query);
 print_r($result);
 if(!$result){
  die("Query Failed");
 }
}

function fetch_specific_cat($cat_id){
 global $connection;
 $query = "SELECT * FROM categories where cat_id=$cat_id";
 $result = mysqli_query($connection,$query);
 if(!$result){
  die("Query Failed");
 }
 return $result;

}


function fetch_all_post(){
global $connection;
$query = "SELECT * FROM posts ORDER BY post_id DESC";
$result = mysqli_query($connection,$query);
return $result;
}

function delete_post($post_id){
 global $connection;
 $query = "DELETE FROM posts where post_id=$post_id";
 $result = mysqli_query($connection,$query);
 if(!$result){
  die("Query failed " . mysqli_error($connection));
 }
}

function fetch_specific_post($post_id){
 global $connection;
 $query = "SELECT * FROM posts where post_id=$post_id";
 $result = mysqli_query($connection,$query);
 if(!$result){
  die("Query failed " . mysqli_error($connection));
 }
 return $result;
}

function fetch_category(){
 global $connection;
 $query = "SELECT * FROM categories ORDER BY cat_title DESC  ";
 $result = mysqli_query($connection,$query);
 if(!$result){
  die("query failed");
 }
 return $result;
}

function reset_post($post_id){
 global $connection;
 $query = "UPDATE posts SET post_view_count = 0 WHERE post_id=$post_id";
 $result = mysqli_query($connection,$query);
 if(!$result){
  die("query failed");
 }
}

function escape($input){
global $connection;
return mysqli_real_escape_string($connection , $input);
}

function users_online(){
 if(isset($_GET['runfunction'])){
   global $connection;
  if(!$connection){
   include "../../includes/db.php";
   session_start();
  }
  $session = session_id();
 $time = time();
 $time_out_seconds = $time - 30;
 $check_user_query = "SELECT * FROM users_online WHERE sessionid='$session'";
 $check_user_result = mysqli_query($connection , $check_user_query);
 $user_on = mysqli_num_rows($check_user_result);
 if($user_on==NULL){
 mysqli_query($connection,"INSERT INTO users_online (sessionid,on_time) VALUES('$session',$time)");
 }else{
 mysqli_query($connection,"UPDATE users_online SET on_time=$time WHERE sessionid='$session'");
 }
 $users_online =mysqli_num_rows(mysqli_query($connection , "SELECT * FROM users_online WHERE on_time > $time_out_seconds"));
 echo $users_online;
}
}
users_online();



function query_count($table){
  global $connection;
  $query = "SELECT * FROM $table";
  $query_result = mysqli_query($connection,$query);
  if(!$query_result){
    die("Query Failed ". mysqli_error($connection));
  }
  return mysqli_num_rows($query_result);
}

function query_count_condition($table,$column,$field){
  global $connection;
  $query = "SELECT * FROM ". $table . " WHERE " . "$column" ."=" . "'$field'";
  $query_result = mysqli_query($connection,$query);
  if(!$query_result){
    die("Query Failed ". mysqli_error($connection));
  }
  return mysqli_num_rows($query_result);
}
?>