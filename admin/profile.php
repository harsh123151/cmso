
<?php 
include 'includes/admin_header.php';
?>
<?php
if(isset($_SESSION['username'])){
 $username = $_SESSION['username'];
 $user_result_query = "SELECT * from users where username='$username'";
 $user_result = mysqli_query($connection,$user_result_query); 
 while($row = mysqli_fetch_assoc($user_result)){
    $username = $row['username'];
    $user_firstname = $row['user_firstname'];
    $user_lastname = $row['user_lastname'];
    $user_password = $row['user_password'];
    $user_email = $row['user_email'];
    $user_role = $row['user_role'];
  }
}

if(isset($_POST['edit_profile_btn'])){
    $user_username = $_POST['username'];
    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
    $user_password = $_POST['user_password'];
    $user_email = $_POST['user_email'];
    $user_role = $_POST['user_role'];
    // $user_image = $_POST['user_image'];
//  move_uploaded_file($post_image_tmp, "../images/$post_image" );
  $user_password = password_hash($user_password , PASSWORD_BCRYPT , array('cost'=>12));
  $edit_user_query = "UPDATE users SET username='$user_username',user_firstname='$user_firstname',user_lastname='$user_lastname',user_password='$user_password',user_email='$user_email',user_role='$user_role' WHERE username='$username'";
 $edit_user = mysqli_query($connection,$edit_user_query);
 if(!$edit_user){
  die("Query failed ".mysqli_error($connection));
 }
 $_SESSION['username'] = $user_username;
 header("Location: profile.php");
 exit();
}
?>

    <div id="wrapper">

        <!-- Navigation -->
        <?php include "includes/admin_navigation.php"?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome Admin
                            <small><?php echo $_SESSION['username']?></small>
                        </h1>
                        <form action="profile.php" method="post" enctype="multipart/form-data">    
      <div class="form-group">
         <label for="username">UserName</label>
          <input type="text" class="form-control" name="username" id="username" value=<?php echo $username?>>
      </div>
       <div class="form-group">
         <label for="user_firstname">FirstName</label>
          <input type="text" class="form-control" name="user_firstname" id="user_firstname" value=<?php echo $user_firstname?>>
      </div>

      <div class="form-group">
         <label for="user_lastname">LastName</label>
          <input type="text" class="form-control" name="user_lastname" id="user_lastname" value=<?php echo $user_lastname?>>
      </div>
      <div class="form-group">
       <label for="user_role">Role</label>
       <select class="form-select" name="user_role" id="user_role">
        <?php
         if($user_role=='admin'){
          echo "<option value='subscriber' >subscriber</option>
          <option value='admin' selected>admin</option>
          ";
         }else{
          echo "<option value='admin' >admin</option>
          <option value='subscriber' selected>subscriber</option>
          ";
         }
        ?>
       
       
      </select>
      </div>
      
      <div class="form-group">
         <label for="user_password">Password</label>
          <input type="password" class="form-control" name="user_password" id="user_password" autocomplete="off">
      </div>
       <div class="form-group">
         <label for="user_email">Email</label>
          <input type="email" class="form-control" name="user_email" id="user_email" value=<?php echo $user_email?>>
      </div>
      
      
      
    <div class="form-group">
         <label for="user_image">Post Image</label>
          <input type="file"  name="user_image" id="user_image">
      </div>

       <div class="form-group">
          <input class="btn btn-primary" type="submit" name="edit_profile_btn" value="Edit Profile">
      </div>


</form>
                        
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

<?php include "includes/admin_footer.php" ?>

