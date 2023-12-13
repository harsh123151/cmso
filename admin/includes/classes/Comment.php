<?php
class Comment{
    public static function fetch_all_comment(){
        global $database;
        $result = $database->query("SELECT * FROM comments JOIN posts on comments.comment_post_id=posts.post_id");
        return $result;
    }
    public static function fetch_specific_comment($post_id){
        global $database;
        $result = $database->query("SELECT * FROM comments WHERE comment_post_id=$post_id");
        return $result;
    }
    public static function delete_comment($comment_id){
        global $database;
        $database->query("DELETE FROM comments WHERE comment_id=$comment_id");        
    }
       
    public static function approve_comment($comment_id){
        global $database;
        $database->query("UPDATE comments set comment_status='approved' WHERE comment_id=$comment_id");
    }
       
    public static function unapprove_comment($comment_id){
        global $database;
        $database->query("UPDATE comments set comment_status='unapproved' WHERE comment_id=$comment_id");
    }

    public static function delete_all_comment_post($post_id){
        global $database;
        $database->query(" DELETE FROM comments WHERE comment_post_id=$post_id");   
    }
    public static function decrement_comment($comment_id){
        global $database;
        $result =$database->query("SELECT * FROM comments where comment_id=$comment_id");
        $row = $database->fetch_array($result);
        $the_post_id = $row['comment_post_id'];
        $database->query("UPDATE posts set post_comment_counts=post_comment_counts-1 where post_id=$the_post_id");
    }
}
?>