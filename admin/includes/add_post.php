<?php
if(isset($_POST['create_post'])){
 $post_title = escape($_POST['title']);
 $post_user = escape($_POST['post_users']);
 $post_category_id = escape($_POST['post_category']);
 $post_status = escape($_POST['post_status']);
 $post_image = escape($_FILES['image']['name']);
 $post_image_tmp = escape($_FILES['image']['tmp_name']);
 $post_tags = escape($_POST['post_tags']);
 $post_content = escape($_POST['post_content']);
 move_uploaded_file($post_image_tmp, "../images/$post_image" );
  $query = "INSERT INTO posts (post_title, post_user, post_date, post_image, post_content, post_tags, post_status, post_category_id) ";
$query .= "VALUES('$post_title', '$post_user', NOW(), '$post_image', '$post_content', '$post_tags', '$post_status', $post_category_id)";
 $add_post_result = mysqli_query($connection,$query);
 if(!$add_post_result){
  die("Query failed ".mysqli_error($connection));
 }
 $post_id = mysqli_insert_id($connection);
 echo "<div class='alert alert-success' role='alert'>
  Post Added <a href='../post.php?p_id=$post_id' class='alert-link'>View Post</a>
</div>";
}
?>
    <form action="posts.php?source=add_post" method="post" enctype="multipart/form-data">    
     
     
      <div class="form-group">
         <label for="title">Post Title</label>
          <input type="text" class="form-control" name="title" id="title">
      </div>
       <div class="form-group">
  <label for="post_users">Post Users</label>
  <select name="post_users" id="post_users">
   <?php
    $result = fetch_all_user();
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
        $result = fetch_category();
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
         <select name="post_status" id="status">
             <option value="draft">Post Status</option>
             <option value="published">Published</option>
             <option value="draft">Draft</option>
         </select>
      </div>
      
      
      
    <div class="form-group">
         <label for="post_image">Post Image</label>
          <input type="file"  name="image" id="post_image">
      </div>

      <div class="form-group">
         <label for="post_tags">Post Tags</label>
          <input type="text" class="form-control" name="post_tags" id="post_tags">
      </div>
      
      <div class="form-group">
         <label for="post_content">Post Content</label>
         <textarea class="form-control" name="post_content" id="summernote" cols="30" rows="10"></textarea>
      </div>
      
      

       <div class="form-group">
          <input class="btn btn-primary" type="submit" name="create_post" value="Publish Post">
      </div>


</form>
    