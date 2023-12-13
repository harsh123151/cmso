<?php
if(isset($_POST['create_post'])){
 if(isset($_POST['title']) && isset($_POST['post_users'])  && isset($_POST['post_category']) && isset($_POST['post_status']) && isset($_POST['post_content'])){
 $post_title = $database->escape($_POST['title']);
 $post_user = $database->escape($_POST['post_users']);
 $userresult = $database->fetch_array($database->query("SELECT * FROM users WHERE username='$post_user'"));
 $user_id = $userresult['user_id'];
 $post_category_id =$database-> escape($_POST['post_category']);
 $post_status = $database->escape($_POST['post_status']);
 $post_image = $database->escape($_FILES['image']['name']);
 $post_image_tmp = $_FILES['image']['tmp_name'];
 $post_tags = $database->escape($_POST['post_tags']);
 $post_content = $database->escape($_POST['post_content']);
//  $base_dir = $_SERVER['DOCUMENT_ROOT'];
// move_uploaded_file($post_image_tmp, $base_dir . "/cms/images/$post_image" );
//   $query = "INSERT INTO posts (user_id,post_title, post_user, post_date, post_image, post_content, post_tags, post_status, post_category_id) ";
// $query .= "VALUES($user_id,'$post_title', '$post_user', NOW(), '$post_image', '$post_content', '$post_tags', '$post_status', $post_category_id)";
//  $add_post_result = mysqli_query($connection,$query);
//  if(!$add_post_result){
//   die("Query failed ".mysqli_error($connection));
//  }
//  $post_id = mysqli_insert_id($connection);
//  echo "<div class='alert alert-success' role='alert'>
//   Post Added <a href='../post.php?p_id=$post_id' class='alert-link'>View Post</a>
// </div>";
$post = new Post($post_title,$post_user,$post_category_id,$post_status,$post_image,$post_image_tmp, $post_content, $post_tags);
if($p_id = $post->add_post()){
 echo "<div class='alert alert-success' role='alert'>
  Post Added <a href='../post.php?p_id=$p_id' class='alert-link'>View Post</a>
</div>";
}


}
else{
  echo "<div class='alert alert-danger' role='alert'>
  Some field missing
</div>";
}



}
?>
    <form action="posts.php" method="post" enctype="multipart/form-data">    
     
     
      <div class="form-group">
         <label for="title">Post Title</label>
          <input type="text" class="form-control" name="title" id="title" required>
      </div>
       <div class="form-group">
  <label for="post_users">Post Users</label>
  <select name="post_users" id="post_users" require>
   <?php
    $result = User::getalluser();
    while($row = mysqli_fetch_assoc($result)){
     $user_id = $row['user_id'];
     $username = $row['username'];
     echo "<option value='{$username}'>{$username}</option>";
    }
   ?>
  </select>
 </div>
         
      
      
      
      
      <div class="form-group">
      <label for="category">Post Category</label>
      <select name="post_category" id="category">
      <?php
        $result = Category::getallcategory();
        while($row = mysqli_fetch_assoc($result)){
        $cat_id = $row['cat_id'];
        $cat_title = $row['cat_title'];
        echo "<option value='{$cat_id}'>{$cat_title}</option>";
        }
      ?>
      </select>
    </div>

      
       <div class="form-group">
        <label for='status'>Post Status</label>
         <select name="post_status" id="status" required>
             <option value="draft">Post Status</option>
             <option value="published">Published</option>
             <option value="draft">Draft</option>
         </select>
      </div>
      
      
      
    <div class="form-group">
         <label for="post_image">Post Image</label>
          <input type="file"  name="image" id="post_image" required>
      </div>

      <div class="form-group">
         <label for="post_tags">Post Tags</label>
          <input type="text" class="form-control" name="post_tags" id="post_tags" required>
      </div>
      
      <div class="form-group">
         <label for="summernote">Post Content</label>
         <textarea class="form-control" name="post_content" id="summernote" cols="30" rows="10" required></textarea>
      </div>
      
      <div class="form-group">
          <input class="form-control" type="hidden" name="source" value="add_post">
      </div>
       <div class="form-group">
          <input class="btn btn-primary" type="submit" name="create_post" value="Publish Post">
      </div>


</form>
    