<?php include 'includes/admin_header.php';

?>
<?php use MyApp\Session; ?>

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
                        if(isset($_REQUEST['source'])){
                         $source = $_REQUEST['source'];
                        }else{
                         $source = " ";
                        }

                         switch($source){
                          case 'view_post':
                           include "includes/view_all_post.php";
                           break;

                          case 'edit_post':
                            include "includes/both.php";
                            break;
                          case 'add_post':
                           include "includes/both.php";
                           break;
                           default:
                           include "includes/view_all_post.php";
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
<script>
$(document).ready(function(){
    $('#postform').submit(function(e){
        e.preventDefault();
        var formData = new FormData($("#postform")[0]);
        formData.append("create_post","true");
        //var formDataObj = {};
        // for(var pair of formData.entries() ){
        //     formDataObj[pair[0]]=pair[1];
        // }
        //console.log(formDataObj);
        //var formDataJSON = JSON.stringify(formDataObj);
        $.ajax({
            url:"http://localhost/cmso/admin/posts.php?source=add_post",
            type:"post",
            data:formData,
            contentType:false,
            processData:false,
            success:function(){
                console.log("data sent");
            },
            error: function(xhr, status, error) {
                console.error("Error:", error);
                console.error("Status:", status);
                console.error("XHR object:", xhr);
            }
        })
    });

});
</script>

