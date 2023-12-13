
<?php 
include 'includes/admin_header.php';
?>
<?php use MyApp\Session; ?>
<?php
if(isset($_POST['submit_date'])){
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
     if($start_date > $end_date){
        $invalid_date = true;
        $end_date = date('Y-m-d');
        $start_date = date('Y-m-d',strtotime('-30 days',strtotime($end_date)));
    }
}else{
    $end_date = date('Y-m-d');
    $start_date = date('Y-m-d',strtotime('-30 days',strtotime($end_date)));
}
?>
<?php
$total_post = $database->query_count('posts','post_date',$start_date,$end_date);
$total_comment = $database->query_count('comments','comment_date',$start_date,$end_date);
$total_users = $database->count_rows($database->query("SELECT * FROM users"));
// query_count('users');
$total_category = $database->query_count('categories','cat_date',$start_date,$end_date);

$total_active_post = $database->query_count_condition("posts","post_status","published",'post_date',$start_date,$end_date);   
$total_draft_post = $database->query_count_condition("posts","post_status","draft",'post_date',$start_date,$end_date);
$total_unapprove_comment =$database-> query_count_condition("comments","comment_status","unapproved",'comment_date',$start_date,$end_date);
$total_subscriber_users = $database->count_rows($database->query("SELECT * FROM users WHERE user_role='subscriber'"));
?>
    <div id="wrapper">
        <!-- Navigation -->
        <?php include "includes/admin_navigation.php"?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-6">
                    <h1 class="page-header">
                            Welcome <?Php echo Session::get_session('user_role')?>
                            <small> <?Php echo Session::get_session('username')?></small>
                        </h1>
                        
                    </div>
                    <?php
                        if(isset($invalid_date) && $invalid_date===true){
                            echo "Invalid date";
                        }
                    ?>
                    <div class="col-lg-6" >

                            <div class="form-row">
                            <form action="" method="post">
                                <div class="form-group col-md-4">
                                <label for="start_date" >Start Date</label>
                                <input type="date" class="form-control" name="start_date" id="start_date" value=<?php echo $start_date ?> required>
                                </div>
                                <div class="form-group col-md-4">
                                <label for="end_date" >End Date</label>   
                                <input type="date" class="form-control" name="end_date" id="end_date" value=<?php echo $end_date ?> required>
                                </div>
                                <div class="form-group col-md-2">
                                    <button type="submit" class="btn btn-primary" type="submit" name="submit_date" required>Submit</button>
                                </div>
                            </div>
                          </form>

                        
                    </div>
                </div>
                </div>
                <!-- /.row -->
                       
                <!-- /.row -->
                
<div class="row">
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-file-text fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                  <?php
                    
                    echo "<div class='huge'>{$total_post}</div>"
                  ?>

                        <div>Posts</div>
                    </div>
                </div>
            </div>
            <a href="posts.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">  
                        <i class="fa fa-comments fa-5x"></i>                                                                
                    </div>
                    <div class="col-xs-9 text-right">
                     <?php
                    echo "<div class='huge'>{$total_comment}</div>"
                  ?>
                      <div>Comments</div>
                    </div>
                </div>
            </div>
            <a href="comment.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-yellow">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-user fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                     <?php
                    echo "<div class='huge'>{$total_users}</div>"
                  ?>
                        <div> Users</div>
                    </div>
                </div>
            </div>
            <a href="users.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-red">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-list fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                     <?php
                    echo "<div class='huge'>{$total_category}</div>"
                  ?>    
                         <div>Categories</div>
                    </div>
                </div>
            </div>
            <a href="categories.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
</div>
                <!-- /.row -->




                <div class="row">
                      <script type="text/javascript">
                            google.charts.load('current', {'packages':['bar']});
                            google.charts.setOnLoadCallback(drawChart);

                            function drawChart() {
                                var data = google.visualization.arrayToDataTable([
                                ['data', 'count'],
                                <?php
                                echo "
                                    ['posts',$total_post],
                                    ['active post',$total_active_post],
                                    ['draft',$total_draft_post],
                                    ['comments',$total_comment],
                                    ['comment pending',$total_unapprove_comment],
                                    ['users',$total_users],
                                    ['subscriber',$total_subscriber_users],
                                    ['category',$total_category]
                                ";
                                ?>
                                

                                ]);

                                var options = {
                                chart: {
                                    title: '',
                                    subtitle: '',
                                }
                                };

                                var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

                                chart.draw(data, google.charts.Bar.convertOptions(options));
                            }
                        </script>
                         <div id="columnchart_material" style="width: 'auto'; height: 500px;"></div>
                </div>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>

    <!-- /#wrapper -->

    <!-- jQuery -->
 <?php include "includes/admin_footer.php" ?>
