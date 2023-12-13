<?php include "../admin/includes/classes/Like.php"?>
<?php
if(isset($_POST["liked"])){
    if(isset($_POST["user_id"]) && isset($_POST["post_id"]) ){
        $user_id = $_POST['user_id'];
        $post_id = $_POST['post_id'];
        Like::like($user_id,$post_id);
        
    }
    
}

if(isset($_POST["unliked"])){
    if(isset($_POST["user_id"]) && isset($_POST["post_id"]) ){
        $user_id = $_POST['user_id'];
        $post_id = $_POST['post_id'];
        Like::unlike($user_id,$post_id);
        
    }
}

?>