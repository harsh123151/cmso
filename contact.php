<?php  include "includes/header.php"; ?>


<?php
    if(isset($_POST['contact_btn'])){
        $to = "harshsdesai258@gmail.com";
        $subject = $_POST['contact_subject'];
        $sender = $_POST['contact_email'];
        $message = wordwrap("sender email " . $sender . " " .$_POST['contact_message'] ,70);
        $headers = "from: " . $sender."\n";
        echo $headers;
       if(mail($to, $subject, $message, $headers)){
         echo "<div class='alert alert-success' role='alert'>
            Message sent
            </div>";
       }else{
         echo "<div class='alert alert-danger' role='alert'>
            Message Not sent
            </div>";
       }
        
        
    }
?>
    <!-- Navigation -->
    
    <?php  include "includes/navigation.php"; ?>
    
 
    <!-- Page Content -->
    <div class="container">
    
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1>Conatct</h1>
                    <form role="form" action="" method="post" id="login-form">
                        <div class="form-group">
                            <label for="contact_subject" class="sr-only">Subject</label>
                            <input type="text" name="contact_subject" id="contact_subject" class="form-control" placeholder="Enter Your Subject" required>
                        </div>
                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="contact_email" id="email" class="form-control" placeholder="Enter your email address" required>
                        </div>
                         <div class="form-group">
                            <label for="contact_message" class="sr-only">Message</label>
                            <textarea class="form-control" name="contact_message" id="contact_message" cols="30" rows="10"></textarea>
                            
                        </div>
                
                        <input type="submit" name="contact_btn" id="btn-login" class="btn btn-custom btn-lg btn-block" value="submit">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>



<?php include "includes/footer.php";?>
