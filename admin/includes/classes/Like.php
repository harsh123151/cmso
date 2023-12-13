<?php
class Like{
    public static function getPostLikes($post_id){
        global $database;
        $result = $database->query("SELECT count(*) as count FROM likes WHERE post_id=$post_id");
        $likes = $database->fetch_array($result);
        return $likes['count'];
    }
    
    
    public static function userLikedThis($post_id,$user_id){
        global $database;
        $result = $database->query("SELECT * FROM likes WHERE post_id=$post_id AND user_id=$user_id");
        if($database->count_rows($result)> 0){
            return true;
        }
        return false;
    }

    public static function like($post_id,$user_id){
        global $database;
        $database->query("UPDATE posts SET likes=likes+1 WHERE post_id=$post_id");
        $database->query("INSERT INTO likes (post_id,user_id,like_date) VALUES ($post_id,$user_id,NOW())");
        $result =$database->query("SELECT count(*) as count FROM posts JOIN likes on posts.post_id=likes.post_id WHERE posts.post_id=$post_id");
        $fetch_row = $database->fetch_array($result);
        $likescount = $fetch_row['count'];
        $response = array('liked'=>1,'likes'=>$likescount);
        Like::userLikedThis($post_id,$user_id);
        echo json_encode($response);
    }

    public static function unlike($post_id,$user_id){
        global $database;
        $database->query("UPDATE posts SET likes=likes-1 WHERE post_id=$post_id");
        $database->query("DELETE FROM likes WHERE post_id=$post_id AND user_id=$user_id");
        $result = $database->query("SELECT count(*) as count FROM posts JOIN likes on posts.post_id=likes.post_id WHERE posts.post_id=$post_id");
        $fetch_row =  $database->fetch_array($result);
        $likescount = $fetch_row['count'];
        $response = array('unliked'=>1,'likes'=>$likescount);
        $liked = Like::userLikedThis($post_id,$user_id);
        echo json_encode($response);

    }
}
?>