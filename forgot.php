<?Php 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
?>
<?php  include "includes/header.php"; 
use MyApp\Helper\Helper;
?>
<?php 
require 'vendor/autoload.php';
?>
<?php 
if(!isset($_GET['forgot'])){
 Helper::redirect('/cms/');
}

if(Validation::ifItIsMethod('post')){
 if(isset($_POST['email'])){
 $enter_email = $database->escape(trim($_POST['email']));
 if(User::user_email_exist($enter_email)){ 
  $length = 50;
  $token = bin2hex(openssl_random_pseudo_bytes($length));
  $token_result = $database->query("UPDATE users SET token='$token' where user_email='$enter_email'");
  $mail = new PHPMailer();
  $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      
    $mail->isSMTP();                                           
    $mail->Host       = Config::host;                   
    $mail->SMTPAuth   = true;                                   
    $mail->Username   = Config::username;                     
    $mail->Password   = Config::password;                              
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;           
    $mail->Port       = Config::port;
    $mail->SMTPDebug = SMTP::DEBUG_OFF;
    $mail->CharSet = 'UTF-8';
    $mail->setFrom('harshsdesai258@gmail.com', 'Harsh Desai');
    $mail->addAddress('hello@gmail.com', 'Hello User');    
    
    $mail->isHTML(true);                             
    $mail->Subject = 'Forgot password link';
    $mail->Body    = "<p>Click on the link to rest password
    <a href='http:://localhost/cms/reset.php?email=$enter_email&token=$token'>http:://localhost/cms/reset.php?email=$enter_email&token=$token</a>
    </p>";
    if($mail->send()){
        $message_sent=true;
    }else{
        echo 'Message has not been sent';
    }
    
 }else{
  echo "Invalid email";
 }
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
                                <h2 class="text-center">Forgot Password?</h2>
                                <p>You can reset your password here.</p>
                                <div class="panel-body">


                                    <?php if(isset($message_sent) && $message_sent===true):?>
                                        <h2>Check your email</h2>
                                    <?php else:?>
                                         <form id="register-form" role="form" autocomplete="off" class="form" method="post">

                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
                                                <input id="email" name="email" placeholder="email address" class="form-control"  type="email">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <input name="recover-submit" class="btn btn-lg btn-primary btn-block" value="Reset Password" type="submit">
                                        </div>

                                        <input type="hidden" class="hide" name="token" id="token" value="">
                                    </form>
                                    <?php endif;?>

                                   

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

