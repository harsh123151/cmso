<?php

function fetch_post_admin($search='' , $post_start=0,$post_per_page=5){
 global $connection;
 if($search==''){
  $query = "SELECT * FROM posts  LIMIT $post_start,$post_per_page ";
 }else{
  $query = "SELECT * FROM posts WHERE post_tags LIKE '%$search%' LIMIT $post_start,$post_per_page";
 }
 
 $result = mysqli_query($connection,$query);
 return $result;
}
function fetch_post($search='' , $post_start=0,$post_per_page=5){
 global $connection;
 if($search==''){
  $query = "SELECT * FROM posts WHERE post_status='published'  LIMIT $post_start,$post_per_page ";
 }else{
  $query = "SELECT * FROM posts WHERE post_tags LIKE '%$search%' AND post_status='published' LIMIT $post_start,$post_per_page";
 }
 
 $result = mysqli_query($connection,$query);
 return $result;
}
function fetch_specific_post($p_id){
 global $connection;
 $post_id = $p_id;
 $query = "SELECT * FROM posts where post_id={$post_id}";
 $result = mysqli_query($connection,$query);
 return $result;
}

function fetch_specific_cat_post_admin($cat_id){
 global $connection;
 $query = "SELECT * FROM posts where post_category_id={$cat_id}";
 $result = mysqli_query($connection,$query);
 return $result;
}
function fetch_specific_cat_post($cat_id){
 global $connection;
 $query = "SELECT * FROM posts where post_category_id={$cat_id} and post_status='published'";
 $result = mysqli_query($connection,$query);
 return $result;
}
?>