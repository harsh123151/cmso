<?php 
include "admin/includes/classes/Session.php"; ?>
<?php use MyApp\Session; ?>
<?php Session::start_session()?>
<?php include "includes/Database.php";?>
<?php include "admin/includes/classes/Helper.php"?>
<?php include "admin/includes/classes/Post.php"?>
<?php include "admin/includes/classes/Authentication.php"?>
<?php include "admin/includes/classes/User.php"?>
<?php include "admin/includes/classes/Like.php"?>
<?php include "admin/includes/classes/Validation.php"?>
<?php 
include "admin/includes/classes/Category.php";

?>

<?php

// if(isset($_SESSION['user_role'])){
//     if($_SESSION['user_role']==='admin'){
//         header("Location: admin");
//         exit();
//     }
//     //else if($_SESSION['user_role']==='subscriber'){
//     //     header("Location: index.php");
//     //     exit();
//     // }else{
//     //     header("Location: baba.php");
//     //     exit();
//     // }
    
// }
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Blog Home - Start Bootstrap Template</title>

    <!-- Bootstrap Core CSS -->
    <link href="/cms/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="/cms/css/blog-home.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>