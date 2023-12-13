<?php
include "../../includes/Database.php";
include "classes/Session.php";
include "classes/User.php";
if(isset($_GET['runfunction']) && $_GET['runfunction'] === 'useronline') {
    users_online();
}

function users_online(){
    User::get_user_on(); 
}
?>