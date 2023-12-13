<?php include "classes/Session.php";?>
<?php include "classes/Helper.php";?>
<?php use MyApp\Session; ?>
<?php use MyApp\Authentication; ?>
<?php Session::start_session()?>
<?php include "classes/Authentication.php";?>
<?php
 Authentication::logout_user();
?>