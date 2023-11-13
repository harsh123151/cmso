<!-- Button trigger modal -->
<!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#deleteModal">
  Launch demo modal
</button> -->

<!-- Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <!-- <h5 class="modal-title" id="exampleModalLabel"></h5> -->
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h3 class="text-center">Are you sure you want to delete</h3>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <a id="deletelink" href=""><button type="button" class="btn btn-danger">Delete</button></a>
      </div>
    </div>
  </div>
</div>
<?php
if(isset($_POST['submit_bulk'])){
 if(isset($_POST['selectBoxes'])){
 $operation = $_POST['selectBoxes']; 
 if(isset($_POST['checkBoxArray'])){ 
 foreach($_POST['checkBoxArray'] as $thePostId){ 
 switch($operation){
  case "publish":
      $publish_query = "UPDATE posts SET post_status='published' WHERE post_id=$thePostId";
      $result_publish_query = mysqli_query($connection,$publish_query);
      if(!$result_publish_query){
       die("Query failed " . mysqli_error($connection));
      }
   break;
  case  "draft":
      $draft_query = "UPDATE posts SET post_status='draft' WHERE post_id=$thePostId";
      $result_draft_query = mysqli_query($connection,$draft_query);
   break;
  case "delete":
      $delete_query = "DELETE FROM posts  WHERE post_id=$thePostId";
      $result_delete_query = mysqli_query($connection,$delete_query);
   break;
  case "clone":
      $result = fetch_specific_post($thePostId);
      $row = mysqli_fetch_assoc($result);
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
      $clone_query = "INSERT INTO posts (post_title, post_user, post_date, post_image, post_content, post_tags, post_status, post_category_id) ";
      $clone_query.= "VALUES('$post_title', '$post_user', NOW(), '$post_image', '$post_content', '$post_tags', '$post_status', $post_category_id)";
      $clone_result = mysqli_query($connection , $clone_query);
      if(!$clone_query){
        die("Query failed " . mysqli_error($connection));
      }
    break;
 }
}
}
}
}
?>
<form action="" class="form" method="post">
 <div class="col-xs-4" id="selectallbox" style="padding: 0;">
 <select class="form-control" aria-label="Default select example" name="selectBoxes">
  <option selected value="">Selected option</option> 
  <option value="publish">Publish</option>
   <option value="draft">Draft</option>
   <option value="delete">Delete</option>
   <option value="clone">Clone</option>
 </select>
 </div> 
 <div class="col-xs-4">
  <button type="submit" class="btn btn-success" name="submit_bulk">Apply</button>
  <a href="" class="btn btn-primary">Add new</a>
 </div>
 
 
 
<table class="table table-bordered table-hover">
 
 <thead>
  <tr>
   <th><input id="selectallboxes" type="checkbox" ></th>
   <th>Id</th>
   <th>Users</th>
   <th>Title</th>
   <th>Content</th>
   <th>Image</th>
   <th>Category</th>
   <th>Tags</th>
   <th>Comments</th>
   <th>status</th>
   <th>Date</th>
   <th>View</th>
   <th>Edit</th>
   <th>Delete</th>
   <th>View count</th>
  </tr>
 </thead>
 <tbody>
  <?php
   $result_post = fetch_all_post();
   while($row = mysqli_fetch_assoc($result_post)){
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
    $post_view_count = $row['post_view_count'];
    $result_cat = fetch_specific_cat($post_category_id);
    while($title = mysqli_fetch_assoc($result_cat)){
     $cat_title = $title['cat_title'];
    }
    echo "<tr>
   <td><input type='checkbox' class='checkBoxes' name='checkBoxArray[]' value={$post_id}></td>
   <td>{$post_id}</td>
   <td>{$post_user}</td>
   <td>{$post_title}</td>
   <td>{$post_content}</td>
   <td><img width='100px' src='../images/{$post_image}' alt='image'/></td>
  
   <td>{$cat_title}</td>
   <td>{$post_tags}</td>
   <td><a href='post_comment.php?post_id={$post_id}'>{$post_comment_counts}</a></td>
   <td>{$post_status}</td>
   <td>{$post_date}</td>
   <td><a href='../post.php?p_id={$post_id}'>View</a></td>
   <td><a href='posts.php?source=edit_post&p_id={$post_id}'>Edit</a></td>";
   //  <td><a href='posts.php?delete={$post_id}'>Delete</a></td>
   echo "
    <td><a rel={$post_id} class='delete_link' href=''>Delete</a></td>
   <td><a href='posts.php?reset={$post_id}'>{$post_view_count}</a></td>
  </tr>";

   }
  ?>
 </tbody>
</table>
</form>

<?php
if(isset($_GET['delete'])){
 $post_id = $_GET['delete'];
 delete_post($post_id);
 delete_comment_of_post($post_id);
 header("Location: posts.php");
 exit();
}

if(isset($_GET['reset'])){
 $post_id = $_GET['reset'];
 reset_post($post_id);
 header("Location: posts.php");
 exit();
}
?>