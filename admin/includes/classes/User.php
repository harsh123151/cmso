<?php
use MyApp\Session;
class User{
    public static function getuserid($post_user){
        global $database;
        $result = $database->fetch_array($database->query("SELECT * FROM users WHERE username='$post_user'"));
        return $result['user_id'];
    }
    public static function getalluser(){
        global $database;
        $result = $database->query("SELECT * FROM users");
        return $result;
    }
    public static function delete_user($user_id){
       global $database;
       $database->query("DELETE FROM users where user_id=$user_id");
    }

    public static function set_user_admin($user_id){
        global $database;
        $database->query("UPDATE users SET user_role='admin' where user_id=$user_id");
    }

    public static function set_user_subscriber($user_id){
        global $database;
        $database->query("UPDATE users SET user_role='subscriber' where user_id=$user_id");
    }
       
    public static function fetch_specific_user($user_id){
        global $database;
        $result = $database->query("SELECT * FROM users WHERE user_id=$user_id");
        return $result;
    }

    public static function get_user_on(){
       global $database;
       $session = Session::get_session_id();
       $time = time(); 
       $time_out_seconds = $time - 30;
       $check_user_result = $database->query("SELECT * FROM users_online WHERE sessionid='$session'");
       $user_on = $database->count_rows($check_user_result);
       if($user_on==NULL){
        $database->query("INSERT INTO users_online (sessionid,on_time) VALUES('$session',$time)");
       }else{
        $database->query("UPDATE users_online SET on_time=$time WHERE sessionid='$session'");
       }
       $users_online =$database->count_rows($database->query("SELECT * FROM users_online WHERE on_time > $time_out_seconds"));
       echo $users_online;
    }

    public static function user_exist($username){
        global $database;
        $result  = $database->query("SELECT username from users WHERE username='$username'");
        if($database->count_rows($result) > 0){
         return true;
        }else{
         return false;
        }
       }
       
    public static function user_email_exist($email){
        global $database;
        $result  = $database->query("SELECT user_email from users WHERE user_email='$email'");
        if($database->count_rows($result) > 0){
            return true;
        }else{
            return false;
        }
    }
}
?>