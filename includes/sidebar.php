<?php use MyApp\Session;?>
<div class="col-md-4">

                <!-- Blog Search Well -->
                <?php include "includes/search.php"?>
                <div class="well">
                    <?php if(Session::get_session('user_role')):?>
                    <h4>Logged in as <?php echo Session::get_session('username')?></h4>
                    <a href="/cmso/admin/includes/logout.php"><button class="btn btn-primary">Logout</button></a>
                    
                    <?Php else:?>
                        <form action="/cmso/login.php" method="post">
                    <div class="form-group">
                        <input type="text" name="username" class="form-control" placeholder="Enter username">
                    </div>
                    <div class="input-group">
                        <input type="password" name="password" id="password" class="form-control" placeholder="Enter password">
                        <span class="input-group-btn">
                            <button class="btn btn-primary" type="submit" name="submit_login">Submit</button>
                        </span>
                    </div>
                        <div class="form-group">
                            <a href="/cmso/forgot?forgot=<?php echo uniqid()?>">Forgot password?</a>
                        </div>
                    </form>
                    <?php endif;?>
                </div>

                <!-- Blog Categories Well -->
                <div class="well">
                    <h4>Blog Categories</h4>
                    <div class="row">
                        <div class="col-lg-12">
                            <ul class="list-unstyled">
                            <?php
                                $result_cat = Category::getallcategory();
                                while($row=mysqli_fetch_assoc($result_cat)){
                                    $cat_id = $row['cat_id'];
                                    $cat_title = $row['cat_title'];
                                    echo "<li><a href='/cmso/category/$cat_id'>$cat_title</a></li>";
                                }
                            ?>
                            </ul>
                        </div>
                    </div>
                    <!-- /.row -->
                </div>

                <!-- Side Widget Well -->
                <div class="well">
                    <h4>Side Widget Well</h4>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore, perspiciatis adipisci accusamus laudantium odit aliquam repellat tempore quos aspernatur vero.</p>
                </div>

            </div>