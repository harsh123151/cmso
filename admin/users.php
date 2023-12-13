<?php include 'includes/admin_header.php';?>
<?php use MyApp\Session;
use MyApp\Helper\Helper;
?>
<?php

if(Session::get_session('user_role') && Session::get_session('user_role')!=='admin'){
    Helper::redirect('index.php');
}
?>

    <div id="wrapper">

        <!-- Navigation -->
        <?php include "includes/admin_navigation.php"?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                    <h1 class="page-header">
                            Welcome <?Php echo Session::get_session('user_role')?>
                            <small> <?Php echo Session::get_session('username')?></small>
                        </h1>
                        <?php
                        if(isset($_GET['source'])){
                         $source = $_GET['source'];
                        }else{
                         $source = " ";
                        }

                         switch($source){
                          case 'view_user':
                           include "includes/view_all_user.php";
                           break;

                          case 'edit_user':
                            include "includes/both_user.php";
                            break;
                            
                           case 'add_user':
                            include "includes/both_user.php";
                            break;

                           default:
                           include "includes/view_all_user.php";
                           break;
                         }
                  
                        
                        
                        ?>
                        
                        
                    </div>
        
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
<?php include "includes/admin_footer.php" ?>