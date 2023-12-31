 
<?php
 if(isset($_GET['p_id'])){
  $post_id = $database->escape($_GET['p_id']);
  $result = Post::fetch_specific_post($post_id);
  while($row = mysqli_fetch_assoc($result)){
    $post_id = $row['post_id'];
    $post_user = $row['post_user'];
    $post_category_id = $row['post_category_id'];
    $post_title = $row['post_title'];
    $post_content = $row['post_content'];
    $post_date = $row['post_date'];
    $post_tags = $row['post_tags'];
    $post_comment_counts = $row['post_comment_counts'];
    $post_status = $row['post_status'];
    $post_image = $row['post_image'];
  }
 }
 ?>
 <?php
if(isset($_POST['update_post'])){
 $post_title = $database->escape($_POST['title']);
 $post_user = $database->escape($_POST['post_users']);
 $userresult = $database->fetch_array($database->query("SELECT * FROM users WHERE username='$post_user'"));
 $user_id = $userresult['user_id'];
 $post_category = $database->escape($_POST['post_category']);
 $post_status = $database->escape($_POST['post_status']);
 $post_image = $database->escape($_FILES['image']['name']);
 $post_image_tmp = $_FILES['image']['tmp_name'];
 $post_tags = $database->escape($_POST['post_tags']);
 $post_content = trim($database->escape($_POST['post_content']));
 if(empty($post_image)){
  $result = Post::fetch_specific_post($post_id);
  while($row = mysqli_fetch_assoc($result)){
   $post_image=$row['post_image'];
}
 }
 Post::edit_post($post_title,$post_user,$post_category,$post_status,$post_image,$post_image_tmp,$post_content,$post_tags,$post_id);
 echo "<div class='alert alert-success' role='alert'>
  Post Created <a href='../post.php?p_id=$post_id' class='alert-link'>View Post</a>
</div>";

}
?>
 
 <form action="" method="post" enctype="multipart/form-data">    
 <div class="form-group">
    <label for="title">Post Title</label>
     <input value="<?php echo $post_title?>" type="text" class="form-control" name="title" id="title" required>
 </div>
  <div class="form-group">
  <label for="post_users">Post Users</label>
  <select name="post_users" id="post_users" required>
   <?php
    $result = User::getalluser();
    while($row = mysqli_fetch_assoc($result)){
     $username = $row['username'];
     if($post_user===$username){
      echo "<option value='{$username}'>{$username}</option>";
     }else{
     echo "<option value='{$username}'>{$username}</option>";
     }
    }
   ?>
  </select>
 </div>
   <div class="form-group">
  <label for="category">Post Category</label>
  <select name="post_category" id="category" required>
   <?php
    $result = Category::getallcategory();
    while($row = mysqli_fetch_assoc($result)){
     $cat_id = $row['cat_id'];
     $cat_title = $row['cat_title'];
     if($cat_id === $post_category_id){
      echo "<option value='{$cat_id}' selected>{$cat_title}</option>";
     }else{
     echo "<option value='{$cat_id}'>{$cat_title}</option>";
    }
  }

   ?>
  </select>
 </div>

 
  <div class="form-group">
   <label for='status'>Post Status</label>
    <select name="post_status" id="status" required>
        <?php
          if($post_status==='published'){
            echo "<option selected value='published'>Published</option>
        <option value='draft'>Draft</option>";
          }else{
            echo "<option  value='published'>Published</option>
        <option selected value='draft'>Draft</option>";
          }
        ?>
        
    </select>
 </div>
 
 
 
<div class="form-group">
    <label for="post_image">Post Image</label>
    <img width='100px' src="../images/<?php echo $post_image?>" alt="image">
     <input  type="file"  name="image" id="post_image"  >
 </div>

 <div class="form-group">
    <label for="post_tags">Post Tags</label>
     <input value="<?php echo $post_tags?>" type="text" class="form-control" name="post_tags" id="post_tags" required>
 </div>
 
 <div class="form-group">
    <label for="post_content">Post Content</label>
    <textarea  class="form-control" name="post_content" id="summernote" cols="30" rows="10" required><?php echo str_replace('\r\n','<br>',$post_content) ?>
    </textarea>
 </div>
 
 

  <div class="form-group">
     <input class="btn btn-primary" type="submit" name="update_post" value="Edit Post">
 </div>


</form>
