<?php  include "includes/header.php"; 
use MyApp\Session;
use MyApp\Authentication;
?>
<?php
if(isset($_GET['lang']) && !empty($_GET['lang'])){
    Session::set_session('lang',$_GET['lang']);
}
if(Session::get_session('lang')){
    include "includes/languages/".Session::get_session('lang').".php";
}else{
    include "includes/languages/"."en".".php";
}

?>
<?php
    if(isset($_POST['register_btn'])){
        $username = $database->escape(trim($_POST['username']));
        $user_password = $database->escape(trim($_POST['password']));
        $user_email = $database->escape(trim($_POST['email']));
        
        $errors = ['username'=>[],'email'=>[],'password'=>[]];
        if(strlen($username)<4){
            $errors['username'][]='Username cannot be short';
        }
        if(User::user_exist($username)){
            $errors['username'][]="Username not available";
        }
        if(User::user_email_exist($user_email)){
            $errors['email'][]="Email already exists";
        }
        if(strlen($user_password)<6){
            $errors['password'][]="Password cannot be shorter than 6 character";
        }
        foreach($errors as $key => $value){
            if(empty($errors[$key])){
                unset($errors[$key]);
            }
        }
        if(empty($errors)){
            Authentication::register_user($username,$user_email,$user_password);
            Authentication::login_user($username,$user_password);
        }
    }
?>
    <!-- Navigation -->
    
    <?php  include "includes/navigation.php"; ?>
    
 
    <!-- Page Content -->
    <div class="container">
    
<section id="login">
    <div class="container">
        <form action="" method="get" class="navbar-form navbar-right" id="langform">
            <div class="form-group">
                <select name="lang" id="" onchange="submitform()">
                    <option value="en"  <?php if(Session::get_session('lang') && $_SESSION['lang']==='en'){echo "selected";}?>>English</option>
                    <option value="es"<?php if(Session::get_session('lang') && $_SESSION['lang']==='es'){echo "selected";}?> >Spanish</option>
                </select>
        </div>
        </form>
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1><?php echo _Register?> </h1>
                    <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                        <div class="form-group">
                            <label for="username" class="sr-only">username</label>
                            <input type="text" name="username" id="username" class="form-control" placeholder=<?php echo _Username?>  required autocomplete="on">
                            
                                <?php
                                if(isset($errors['username'])){
                                    echo "<p class='d-inline alert alert-danger '>";
                                    foreach($errors['username'] as $error){
                                        echo $error . "<br>";
                                    }
                                    echo "</p>";
                                }
                                ?>


                            </p>
                        </div>
                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder=<?php echo _Email?>  required autocomplete="on">
                            <?php
                                if(isset($errors['email'])){
                                    echo "<p class='d-inline alert alert-danger '>";
                                    foreach($errors['email'] as $error){
                                        echo $error . "<br>";
                                    }
                                    echo "</p>";
                                }
                                ?>
                        </div>
                         
                         <div class="form-group">
                            <label for="password" class="sr-only">Password</label>
                            <input type="password" name="password" id="key" class="form-control" placeholder=<?php echo _Password?>  required>
                            <?php
                                if(isset($errors['password'])){
                                    echo "<p class='d-inline alert alert-danger '>";
                                    foreach($errors['password'] as $error){
                                        echo $error . "<br>";
                                    }
                                    echo "</p>";
                                }
                                ?>
                        </div>
                        
                        
                
                        <input type="submit" name="register_btn" id="btn-login" class="btn btn-custom btn-lg btn-block btn-primary" value="Register">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>



<?php include "includes/footer.php";?>
<script>
function submitform(){
    document.getElementById('langform').submit();
}
</script>
