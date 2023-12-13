
<div class="col-xs-6">
 <form action="categories.php" method="post">
<div class="form-group">
<label class="form-label" for="cat_title">Edit Categories</label> 
<?php
if(isset($_GET['edit'])){
 $edit_id = $database->escape($_GET['edit']);  
 $result = Category::fetch_specific_cat($edit_id);
 while($row = mysqli_fetch_assoc($result)){
 $cat_title = $row['cat_title'];

?>
<input type="text" class="form-control" name="cat_title" id="cat_title" value=<?php echo $cat_title?>>
<input type="hidden" hidden class="form-control" name="edit_id" id="edit_id" value=<?php echo $edit_id?>>

<?php
}}
?>
</div>
<div class="form-group">
<input class="btn btn-secondary" type="submit" name="edit_cat" id="" value="Edit">

</div>

</form>
