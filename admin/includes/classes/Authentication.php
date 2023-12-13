<?php
namespace MyApp;
use MyApp\Helper\Helper;
class Authentication{
    public static function login_user($username , $password){
        global $database;
       $username = $_POST['username'];
        $password = $_POST['password'];
        $username = $database->escape($username);
        $password = $database->escape($password);
        $result = $database->query("SELECT * FROM users WHERE username = '{$username}'");
        if(mysqli_num_rows($result) <= 0){
         header("Location: /cmso/index.php");
         exit();
        }
        while($row = mysqli_fetch_assoc($result)){
         $db_userid = $row['user_id'];
         $db_username = $row['username'];
         $db_user_firstname = $row['user_firstname'];
         $db_user_lastname = $row['user_lastname'];
         $db_user_password = $row['user_password'];
         $db_user_role = $row['user_role'];
        if(password_verify($password,$db_user_password)){
         Session::set_session('user_id',$db_userid);
         Session::set_session('username',$db_username);
         Session::set_session('firstname', $db_user_firstname);
         Session::set_session('lastname',$db_user_lastname);
         Session::set_session('user_role',$db_user_role);
       
        Helper::redirect("http://localhost/cmso/admin");
         exit();
        }else{
        Helper::redirect("Location: /cmso/index.php");
         exit();
        }
       }
       }

       public static function logout_user(){
        Session::end_session();
        Helper::redirect("/cmso/index.php");
       }

       public static function register_user($username , $user_email ,$user_password){ 
         global $database;   
         $username = $database->escape($_POST['username']); 
         $user_password = $database->escape($_POST['password']);
         $user_email = $database->escape($_POST['email']);
         $user_password = password_hash($user_password , PASSWORD_BCRYPT , array('cost'=>12));
         $database->query("INSERT INTO users(username,user_password,user_email,user_role) VALUES('$username','$user_password','$user_email','subscriber')");
         echo "<div class='alert alert-success' role='alert'>
             User Registered
             </div>";
       }
}
?>