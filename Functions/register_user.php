<?php
function register_user($username , $user_email ,$user_password){
 global $connection;
  $username = escape($_POST['username']); 
  $user_password = escape($_POST['password']);
  $user_email = escape($_POST['email']);
  $user_password = password_hash($user_password , PASSWORD_BCRYPT , array('cost'=>12));
  $register_query = "INSERT INTO users(username,user_password,user_email,user_role) VALUES('$username','$user_password','$user_email','subscriber')";
  $register_query_result = mysqli_query($connection,$register_query);
  confirm_query($register_query_result,$connection);
  echo "<div class='alert alert-success' role='alert'>
      User Registered
      </div>";
}
?>