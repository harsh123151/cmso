<?php
use MyApp\Session;
$pagename = basename($_SERVER['PHP_SELF']);
?>
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <?php
                $home_class = "";
                if($pagename==='index.php'){
                    $home_class = 'active';
                }
                ?>
                <a class="navbar-brand nav-link <?php echo $home_class ?>" href="/cmso/index">Home</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                <?php
                    $result_cat = Category::getallcategory();
                    while($row=mysqli_fetch_assoc($result_cat)){
                        $cat_id = $row['cat_id'];
                        $cat_title = $row['cat_title'];
                        $category_class='';
                        if($pagename==='category.php' && isset($_GET['cat_id']) && $_GET['cat_id']===$cat_id){
                            $category_class='active';
                        }
                        echo "<li class=$category_class><a href='/cmso/category/$cat_id'>$cat_title</a></li>";
                    }
                    ?>

                    <?php if(Validation::isLoggedIn()):?>
                        <li>
                            <a href="/cmso/admin">Admin</a>
                        </li>
                        <li>
                            <a href="/cmso/admin/includes/logout.php">logout</a>
                        </li>
                    <?php else:?>
                         <li>
                            <a href="/cmso/login">Login</a>
                        </li>
                    <?php endif;?>
                    
                    
                    <?php
                        $resgistration_class='';
                        $contact_class = '';
                        if($pagename==='registration.php'){
                            $resgistration_class='active';
                        }elseif($pagename==='contact.php'){
                            $contact_class='active';
                        }
                    ?>
                    <li class=<?php echo $resgistration_class ?>><a href="/cmso/registration">Register</a></li>
                    <li class=<?php echo $contact_class ?>><a href="/cmso/contact">Contact</a></li>
                    <?php
                        if(Session::get_session('user_role') && Session::get_session('user_role')==='admin'){
                            if(isset($_GET['p_id'])){
                                $the_post_id = $_GET['p_id'];
                                echo "<li>
                        <a href='/cmso/admin/posts.php?source=edit_post&p_id=$the_post_id'>Edit post</a>
                    </li>";
                            }
                        }
                    ?>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>