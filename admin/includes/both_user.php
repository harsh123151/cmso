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
<?php
if(isset($_GET['edit'])){
 $user_id = $database->escape($_GET['edit']);
 $user_result = User::fetch_specific_user($user_id);
  while($row = mysqli_fetch_assoc($user_result)){
    $username = $row['username'];
    $user_firstname = $row['user_firstname'];
    $user_lastname = $row['user_lastname'];
    $user_password = $row['user_password'];
    $user_email = $row['user_email'];
    $user_role = $row['user_role'];
  }
}
if(isset($_POST['edit_user_btn'])){
    $username = $database->escape($_POST['username']);
    $user_firstname = $database->escape($_POST['user_firstname']);
    $user_lastname = $database->escape($_POST['user_lastname']);
    $user_password = $database->escape($_POST['user_password']);
    $user_email = $database->escape($_POST['user_email']);
    $user_role = $database->escape($_POST['user_role']);
    // $user_image = $_POST['user_image'];
//  move_uploaded_file($post_image_tmp, "../images/$post_image" );
    if(!empty($user_password)){
        $user_password = password_hash($user_password , PASSWORD_BCRYPT , array('cost'=>12));
        $edit_user_query = "UPDATE users SET username='$username',user_firstname='$user_firstname',user_lastname='$user_lastname',user_password='$user_password',user_email='$user_email',user_role='$user_role' WHERE user_id=$user_id";
      
      $edit_user = $database->query($edit_user_query);
      echo "<div class='alert alert-success' role='alert'>
        User Created <a href='users.php' class='alert-link'>Edited User</a>
      </div>";
    }   
   
}
// else{
//   header("Location: ../index.php");
//   exit();
// }
?>

<?php
if(isset($_GET['source'])){
    if($_GET['source']==='edit_user'){
        $edit=true;
    }else{
        $edit=false;
    }
}
?>
    <form action="" method="post" enctype="multipart/form-data">    
     
     
      <div class="form-group">
         <label for="username">UserName</label>
          <input type="text" class="form-control" name="username" id="username" value=<?php echo $edit?$username:"" ?>>
      </div>
       <div class="form-group">
         <label for="user_firstname">FirstName</label>
          <input type="text" class="form-control" name="user_firstname" id="user_firstname" value=<?php echo $edit?$user_firstname:""?>>
      </div>

      <div class="form-group">
         <label for="user_lastname">LastName</label>
          <input type="text" class="form-control" name="user_lastname" id="user_lastname" value=<?php echo $edit?$user_lastname:""?>>
      </div>
      <div class="form-group">
       <label for="user_role">Role</label>
       <select class="form-select" name="user_role" id="user_role">
        <?php
        if($edit){
         if($user_role=='admin'){
          echo "<option value='subscriber' >subscriber</option>
          <option value='admin' selected>admin</option>
          ";
         }else{
          echo "<option value='admin' >admin</option>
          <option value='subscriber' selected>subscriber</option>
          ";
         }
        }else{
            echo "<option value='admin' >admin</option>
          <option value='subscriber'>subscriber</option>
          ";
        }
        ?>
       
       
      </select>
      </div>
      
      <div class="form-group">
         <label for="user_password">Password</label>
          <input type="password" class="form-control" name="user_password" id="user_password" autocomplete="off" required>
      </div>
       <div class="form-group">
         <label for="user_email">Email</label>
          <input type="email" class="form-control" name="user_email" id="user_email" value=<?php echo $edit?$user_email:""?>>
      </div>
      
      
      
    <div class="form-group">
         <label for="user_image">Post Image</label>
          <input type="file"  name="user_image" id="user_image">
      </div>

       <div class="form-group">
          <input class="btn btn-primary" type="submit" name="<?php echo $edit?"edit_user_btn":"create_user";?>" value="<?php echo $edit?"Edit user":"Create user";?>">
      </div>


</form>
    