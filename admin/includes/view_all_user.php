<?php use MyApp\Session; ?>
 <?php
 if(isset($_GET['delete'])){
 $user_id = $database->escape($_GET['delete']);
 User::delete_user($user_id);
 header("Location: users.php");
 exit();
}


if(isset($_GET['admin'])){
 $user_id =  $database->escape($_GET['admin']);
 User::set_user_admin($user_id);
 if($user_id===Session::get_session('user_id')){
    Session::set_session('user_role','admin');
 }
 header("Location: users.php");
 exit();
}

if(isset($_GET['subscriber'])){
 $user_id =  $database->escape($_GET['subscriber']);
 User::set_user_subscriber($user_id);
 if($user_id===Session::get_session('user_id')){
  Session::set_session('user_role','subscriber');
 }
 header("Location: users.php");
 exit();
}
?>

 
 <table class="table table-bordered table-hover">
 <thead>
  <tr>
   <th>user_id</th>
   <th>username</th>
   <th>FirstName</th>
   <th>LastName</th>
   <th>Email</th>
   <!-- <th>Image</th> -->
   <th>Role</th>
   <th>admin</th>
   <th>subscriber</th>
   <th>Edit</th>
   <th>Delete</th>
  </tr>
 </thead>
 <tbody>
  <?php
   $result_user = User::getalluser();
   while($row = mysqli_fetch_assoc($result_user)){
    $user_id = $row['user_id'];
    $username = $row['username'];
    $user_firstname = $row['user_firstname'];
    $user_lastname = $row['user_lastname'];
    $user_email = $row['user_email'];
    $user_password = $row['user_password'];
    $user_image = $row['user_image'];
    $user_role = $row['user_role'];
    echo "<tr>
   <td>{$user_id}</td>
   <td>{$username}</td>
   <td>{$user_firstname}</td>
   <td>{$user_lastname}</td>
   <td>{$user_email}</td>
   <td>{$user_role}</td>
   <td><a href='users.php?admin={$user_id}'>admin</a></td>
   <td><a href='users.php?subscriber={$user_id}'>subscriber</a></td>
   <td><a href='users.php?source=edit_user&edit={$user_id}'>Edit</a></td>
   <td><a onClick=\"javascript: return confirm('Are you sure you want to delete'); \" href='users.php?delete={$user_id}'>Delete</a></td>
  </tr>";

   }
  ?>
 </tbody>



</table>
