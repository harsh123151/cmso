<?php  include "includes/header.php"; ?>
<?php use MyApp\Helper\Helper;?>
<?php
if(!isset($_GET['email']) || !isset($_GET['token'])){
 Helper::redirect('index');
}else{
 $token = $_GET['token'];
 $email = $_GET['email'];
 if(!User::user_email_exist($email)){
  Helper::redirect('index');
 }
 $stmt = mysqli_prepare($connection,"SELECT username,user_email,token FROM users WHERE user_email=?");
 mysqli_stmt_bind_param($stmt,'s',$email);
 mysqli_stmt_bind_result($stmt,$username,$user_email,$user_token);
 mysqli_stmt_execute($stmt);
 mysqli_stmt_fetch($stmt);
 mysqli_stmt_close($stmt);
 if($token!==$user_token){
  Helper::redirect('index.php');
 }
}
?>
<?php
if(isset($_POST['new_password']) && isset($_POST['password']) && isset($_POST['confirm_password'])){
    if($_POST['password']!==$_POST['confirm_password']){
      echo "Password did not match";
    }else{
    $hash_password = password_hash($_POST['password'],PASSWORD_BCRYPT,array('cost'=>12));
      $stmt =mysqli_prepare($connection , "UPDATE users set token='',user_password=? WHERE user_email=?");
      mysqli_stmt_bind_param($stmt,'ss',$hash_password,$user_email);
      mysqli_stmt_execute($stmt);
      if (mysqli_stmt_affected_rows($stmt) >= 1){
        Helper::redirect('/cms/login');
      }else{
        echo "change not happen";
      }
      mysqli_stmt_close($stmt);
      
    }
   }
?>

<!-- Page Content -->
<div class="container">

    <div class="form-gap"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="text-center">

                                <h3><i class="fa fa-lock fa-4x"></i></h3>
                                <h2 class="text-center">Enter New password</h2>
                                <p>You can enter your password here.</p>
                                <div class="panel-body">

                                    <form id="reset_form" action="reset.php?email=<?php echo $user_email?>&token=<?php echo $user_token?>" name="reset_form" role="form" autocomplete="off" class="form" method="post">

                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
                                                <input id="password" name="password" placeholder="Enter password" class="form-control"  type="password">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
                                                <input id="password" name="confirm_password" placeholder="Enter password again" class="form-control"  type="password">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <input name="new_password" class="btn btn-lg btn-primary btn-block" value="Change password" type="submit">
                                        </div>

                                        <input type="hidden" class="hide" name="token" id="token" value="">
                                    </form>

                                </div><!-- Body-->

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <hr>

    <?php include "includes/footer.php";?>

</div> <!-- /.container -->

