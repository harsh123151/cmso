<?php  include "includes/db.php"; ?>
<?php  include "includes/header.php"; ?>

<?php
if(!ifItIsMethod('get') || !isset($_GET['email']) || !isset($_GET['token'])){
 redirect('index');
}else{
 $token = $_GET['token'];
 $email = $_GET['email'];
 if(!user_email_exist($email)){
  redirect('index');
 }
 $stmt = mysqli_prepare($connection,"SELECT username,user_email,token FROM users WHERE user_email=?");
 mysqli_stmt_bind_param($stmt,'s',$email);
 mysqli_stmt_bind_result($stmt,$username,$user_email,$user_token);
 mysqli_stmt_execute($stmt);
 mysqli_stmt_fetch($stmt);
 mysqli_stmt_close($stmt);
 echo $token ."<br>";
 echo $user_token . " it user token";
 if($token!==$user_token){
  redirect('index.php');
 }
 if(isset($_POST['rest_form']) && isset($_POST['password']) && isset($_POST['confirm_password'])){
  echo "all good";
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

                                    <form id="reset_form" action="" name="reset_form"role="form" autocomplete="off" class="form" method="post">

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

