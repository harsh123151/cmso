<?php
use MyApp\Helper\Helper;
class Post{
    private $user_id;
    function __construct(private $post_title,private $post_user,private $post_category_id,private $post_status,private $post_image,private $post_image_tmp,private $post_tags,private $post_content)
    {
        
    }

    public static function edit_post($post_title,$post_user,$post_category,$post_status,$post_image,$post_image_tmp,$post_content,$post_tags,$post_id){
        global $database;
        $user_id = User::getuserid($post_user);
        if(!empty($post_image) && !empty($post_image_tmp)){
            Helper::move_file($post_image_tmp,$post_image);
        } 
        $database->query("UPDATE posts SET post_title='{$post_title}',
        user_id='{$user_id}',
        post_user='{$post_user}',
        post_category_id={$post_category}, 
        post_status='{$post_status}', 
        post_image='{$post_image}', 
        post_content='{$post_content}', 
        post_tags='{$post_tags}' 
        WHERE post_id = {$post_id}");
    }
    public static function  fetch_all_post_with_cat(){
        global $database;
        $result = $database->query("SELECT * FROM posts INNER JOIN categories on posts.post_category_id = categories.cat_id ORDER BY post_id DESC");
        return $result;
    }

    public static function fetch_specific_post($post_id){
        global $database;
        $result = $database->query("SELECT * FROM posts where post_id=$post_id");
        return $result;
    }
    public static function fetch_specific_cat_post($cat_id){
        global $database;
        $result = $database->query("SELECT * FROM posts where post_category_id={$cat_id} and post_status='published'");
        return $result;
    }
    public static function fetch_specific_cat_post_admin($cat_id){
        global $database;
        $result = $database->query("SELECT * FROM posts where post_category_id={$cat_id}");
        return $result;
    }

    public static function reset_post($post_id){
        global $database;
        $result = $database->query("UPDATE posts SET post_view_count = 0 WHERE post_id=$post_id");
    }

    public static function delete_post($post_id){
        global $database;
        $result = $database->query("DELETE FROM posts where post_id=$post_id");
    }

    public static function fetch_specific_user_post($start_date,$end_date){
        global $database;
        $result = $database->query("SELECT count(*) as count FROM posts WHERE user_id=".Validation::getUserId()." AND post_date BETWEEN '$start_date' AND '$end_date'");
        $fetch_row = mysqli_fetch_array($result);
        return $fetch_row['count'];
        
      }
    public static function fetch_specific_user_comment($start_date,$end_date){
        global $database;
        $result = $database->query("SELECT count(*) as count FROM comments INNER JOIN posts on comments.comment_post_id = posts.post_id WHERE posts.user_id=".Validation::getUserId()." AND comment_date BETWEEN '$start_date' AND '$end_date'");
        $fetch_row = mysqli_fetch_array($result);
        return $fetch_row['count'];
      }
      
    public static function fetch_specific_user_cat($start_date,$end_date){
        global $database;
        $result = $database->query("SELECT count(*) as count FROM categories where cat_user_id=".Validation::getUserId()." AND cat_date BETWEEN '$start_date' AND '$end_date'");
        $fetch_row = mysqli_fetch_array($result);
        return $fetch_row['count'];
      }
      public static function fetch_specific_user_like(){
        global $database;
        $result = $database->query("SELECT count(*) as count FROM posts JOIN likes on posts.post_id=likes.post_id WHERE posts.user_id=".Validation::getUserId());
        $fetch_row = mysqli_fetch_array($result);
        return $fetch_row['count'];
      }

      
    public static  function fetch_user_published_post($start_date,$end_date){
        global $database;
        $result = $database->query("SELECT count(*) as count FROM posts where user_id=".Validation::getUserId() . " AND post_status='published'"." AND post_date BETWEEN '$start_date' AND '$end_date'");
        $fetch_row = mysqli_fetch_array($result);
        return $fetch_row['count'];
    }
    
    public static function fetch_user_draft_post($start_date,$end_date){
        global $database;
        $result = $database->query("SELECT count(*) as count FROM posts where user_id=".Validation::getUserId() . " AND post_status='draft'"." AND post_date BETWEEN '$start_date' AND '$end_date'");
        $fetch_row = mysqli_fetch_array($result);
        return $fetch_row['count'];
    }
      
    public static function fetch_user_approved_comment($start_date,$end_date){
        global $database;
        $result = $database->query("SELECT count(*) as count FROM comments INNER JOIN posts on comments.comment_post_id = posts.post_id WHERE posts.user_id=".Validation::getUserId() . " AND comment_status='approved'"." AND comment_date BETWEEN '$start_date' AND '$end_date'");
        $fetch_row = mysqli_fetch_array($result);
        return $fetch_row['count'];
    }
    public static function fetch_user_unapproved_comment($start_date,$end_date){
        global $database;
        $result = $database->query("SELECT count(*) as count FROM comments INNER JOIN posts on comments.comment_post_id = posts.post_id WHERE posts.user_id=".Validation::getUserId() . " AND comment_status='unapproved'"." AND comment_date BETWEEN '$start_date' AND '$end_date'");
        $fetch_row = mysqli_fetch_array($result);
        return $fetch_row['count'];
    }

    public function add_post(){
        global $database;
        $this->user_id = User::getuserid($this->post_user);
        // $base_dir = $_SERVER['DOCUMENT_ROOT'];
        // move_uploaded_file($this->post_image_tmp, $base_dir . "/cms/images/$this->post_image" );
        Helper::move_file($this->post_image_tmp,$this->post_image);
        $database->query("INSERT INTO posts (user_id,post_title, post_user, post_date, post_image, post_content, post_tags, post_status, post_category_id) VALUES($this->user_id,'$this->post_title', '$this->post_user', NOW(), '$this->post_image', '$this->post_content', '$this->post_tags', '$this->post_status', $this->post_category_id)");
        return $database->getLastInsertedId();
    }

    public static function is_post_draft($post_id){
        $result = Post::fetch_specific_post($post_id);
        $row = mysqli_fetch_array($result);
        if($row['post_status']==='draft'){
            return true;
        }
        return false;
    }

    
 public static function fetch_post_admin($search='' , $post_start=0,$post_per_page=5){
    global $database;
    if($search==''){
     $query = "SELECT * FROM posts  LIMIT $post_start,$post_per_page ";
    }else{
     $query = "SELECT * FROM posts WHERE post_tags LIKE '%$search%' OR post_user LIKE '%$search%' OR post_title LIKE '%$search%' LIMIT $post_start,$post_per_page";
    }
    
    $result = $database->query($query);
    return $result;
   }
   public static function fetch_post($search='' , $post_start=0,$post_per_page=5){
    global $database;
    if($search==''){
     $query = "SELECT * FROM posts WHERE post_status='published'  LIMIT $post_start,$post_per_page ";
    }else{
     $query = "SELECT * FROM posts WHERE (post_tags LIKE '%$search%' OR post_user LIKE '%$search%' OR post_title LIKE '%$search%') AND post_status='published' LIMIT $post_start,$post_per_page";
    }
    
    $result =$database->query($query);
    return $result;
   }
}
?>