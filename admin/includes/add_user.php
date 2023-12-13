<?php
if(isset($_POST['create_user'])){
    $username = $database->escape($_POST['username']);
    $user_firstname = $database->escape($_POST['user_firstname']);
    $user_lastname = $database->escape($_POST['user_lastname']);
    $user_password = $database->escape($_POST['user_password']);
    $user_email = $database->escape($_POST['user_email']);
    // $user_image = $_POST['user_image'];
//  move_uploaded_file($post_image_tmp, "../images/$post_image" );
    $user_password = password_hash($user_password , PASSWORD_BCRYPT , array('cost'=>10));
  $query = "INSERT INTO users (username,user_firstname,user_lastname,user_password,user_email,user_role) ";
$query .= "VALUES('$username', '$user_firstname', '$user_lastname', '$user_password','$user_email','subscriber')";
 $add_user = mysqli_query($connection,$query);
 if(!$add_user){
  die("Query failed ".mysqli_error($connection));
 }
 echo "<div class='alert alert-success' role='alert'>
  User Created <a href='users.php' class='alert-link'>View User</a>
</div>";
}
?>
    <form action="users.php?source=add_user" method="post" enctype="multipart/form-data">    
     
     
      <div class="form-group">
         <label for="username">UserName</label>
          <input type="text" class="form-control" name="username" id="username">
      </div>
       <div class="form-group">
         <label for="user_firstname">FirstName</label>
          <input type="text" class="form-control" name="user_firstname" id="user_firstname">
      </div>
      <div class="form-group">
         <label for="user_lastname">LastName</label>
          <input type="text" class="form-control" name="user_lastname" id="user_lastname">
      </div>
      <div class="form-group">
         <label for="user_password">Password</label>
          <input type="password" class="form-control" name="user_password" id="user_password">
      </div>
       <div class="form-group">
         <label for="user_email">Email</label>
          <input type="email" class="form-control" name="user_email" id="user_email">
      </div>
      
      
      
    <div class="form-group">
         <label for="user_image">Post Image</label>
          <input type="file"  name="user_image" id="user_image">
      </div>

       <div class="form-group">
          <input class="btn btn-primary" type="submit" name="create_user" value="Create User">
      </div>


</form>
    