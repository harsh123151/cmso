<?php
$db = ['db_server'=>'localhost','db_user'=>'root','db_password'=>"",'db_name'=>'cms'];
foreach($db as $key=>$value){
 define(strtoupper($key),$value);
}
$connection = mysqli_connect(DB_SERVER,DB_USER,DB_PASSWORD,DB_NAME);
if(!$connection){
 echo "can't able to connect";
}
?>