<?php
function redirect($location){


    header("Location:" . $location);
    exit;

}
function confirm_query($query_result , $connection){
 if(!$query_result){
  die("Query Failed " . mysqli_error($connection));
 }
}
function escape($input){
global $connection;
return mysqli_real_escape_string($connection , $input);
}


function ifItIsMethod($method=null){

    if($_SERVER['REQUEST_METHOD'] == strtoupper($method)){

        return true;

    }

    return false;

}

function isLoggedIn(){

    if(isset($_SESSION['user_role'])){

        return true;


    }


   return false;

}

function checkIfUserIsLoggedInAndRedirect($redirectLocation=null){

    if(isLoggedIn()){

        redirect($redirectLocation);

    }

}
function user_exist($username){
 global $connection;
 $query = "SELECT username from users WHERE username='$username'";
 $result  = mysqli_query($connection,$query);
 confirm_query($result , $connection);
 if(mysqli_num_rows($result) > 0){
  return true;
 }else{
  return false;
 }
}

function user_email_exist($email){
 global $connection;
 $query = "SELECT user_email from users WHERE user_email='$email'";
 $result  = mysqli_query($connection,$query);
 confirm_query($result , $connection);
 if(mysqli_num_rows($result) > 0){
  return true;
 }else{
  return false;
 }
}
?>