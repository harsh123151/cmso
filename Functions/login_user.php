<?php
function login_user($username , $password){
 global $connection;
$username = $_POST['username'];
 $password = $_POST['password'];
 $username = mysqli_real_escape_string($connection , $username);
 $password = mysqli_real_escape_string($connection,$password);
 $check_user_query = "SELECT * FROM users WHERE username = '{$username}'";
 $result = mysqli_query($connection,$check_user_query);
 if(mysqli_num_rows($result) <= 0){
  header("Location: /cms/index.php");
  exit();
 }
 while($row = mysqli_fetch_assoc($result)){
  $db_userid = $row['user_id'];
  $db_username = $row['username'];
  $db_user_firstname = $row['user_firstname'];
  $db_user_lastname = $row['user_lastname'];
  $db_user_password = $row['user_password'];
  $db_user_role = $row['user_role'];
 if(password_verify($password,$db_user_password)){
  $_SESSION['user_id']= $db_userid;
  $_SESSION['username']= $db_username;
  $_SESSION['firstname'] = $db_user_firstname ;
  $_SESSION['lastname'] = $db_user_lastname ;
  $_SESSION['user_role'] = $db_user_role;
  header("Location: http://localhost/cms/admin");
  exit();
 }else{
  header("Location: /cms/index.php");
  exit();
 }
}
}
?>