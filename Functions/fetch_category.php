<?php
function fetch_category(){
 global $connection;
 $query = "SELECT * FROM categories ORDER BY cat_title DESC  ";
 $result = mysqli_query($connection,$query);
 if(!$result){
  die("query failed");
 }
 return $result;
}
?>