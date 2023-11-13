 
<?php
 if(isset($_GET['p_id'])){
  $post_id = escape($_GET['p_id']);
  $result = fetch_specific_post($post_id);
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
 $post_title = escape($_POST['title']);
 $post_user = escape($_POST['post_users']);
 $post_category = escape($_POST['post_category']);
 $post_status = escape($_POST['post_status']);
 $post_image = escape($_FILES['image']['name']);
 $post_image_tmp = escape($_FILES['image']['tmp_name']);
 $post_tags = escape($_POST['post_tags']);
 $post_content = trim(escape($_POST['post_content']));
 move_uploaded_file($post_image_tmp, "../images/$post_image" );
 if(empty($post_image)){
  $result = fetch_specific_post($post_id);
  while($row = mysqli_fetch_assoc($result)){
   $post_image=$row['post_image'];
  }
 }
 $query = "UPDATE posts SET ";
 $query.="post_title='{$post_title}', ";
 $query.="post_user='{$post_user}', ";
 $query.="post_category_id={$post_category}, ";
 $query.="post_status='{$post_status}', ";
 $query.="post_image='{$post_image}', ";
 $query.="post_content='{$post_content}', ";
 $query.="post_tags='{$post_tags}' ";
 $query.= "WHERE post_id = {$post_id}";

 $result = mysqli_query($connection,$query);
 if(!$result){
  die("query failed" . mysqli_error($connection));
 }
 echo "<div class='alert alert-success' role='alert'>
  Post Created <a href='../post.php?p_id=$post_id' class='alert-link'>View Post</a>
</div>";

}
?>
 
 <form action="" method="post" enctype="multipart/form-data">    
 <div class="form-group">
    <label for="title">Post Title</label>
     <input value="<?php echo $post_title?>" type="text" class="form-control" name="title" id="title">
 </div>
  <div class="form-group">
  <label for="post_users">Post Users</label>
  <select name="post_users" id="post_users">
   <?php
    $result = fetch_all_user();
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
  <select name="post_category" id="category" >
   <?php
    $result = fetch_category();
    while($row = mysqli_fetch_assoc($result)){
     $cat_id = $row['cat_id'];
     $cat_title = $row['cat_title'];
     if($cat_id === $post_category){
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
    <select name="post_status" id="status" >
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
     <input  type="file"  name="image" id="post_image" value="images/$post_image">
 </div>

 <div class="form-group">
    <label for="post_tags">Post Tags</label>
     <input value="<?php echo $post_tags?>" type="text" class="form-control" name="post_tags" id="post_tags">
 </div>
 
 <div class="form-group">
    <label for="post_content">Post Content</label>
    <textarea  class="form-control" name="post_content" id="summernote" cols="30" rows="10"><?php echo str_replace('\r\n','<br>',$post_content) ?>
    </textarea>
 </div>
 
 

  <div class="form-group">
     <input class="btn btn-primary" type="submit" name="update_post" value="Edit Post">
 </div>


</form>
