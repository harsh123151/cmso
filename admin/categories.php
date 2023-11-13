<?php include 'includes/admin_header.php';
?>

<?php 
 if(isset($_GET['delete'])){
    delete_cat($_GET['delete']);
    header("Location: categories.php");
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
                            Welcome Admin
                            <small>Harsh</small>
                        </h1>
                        
                    </div>
                    
                    <div class="col-xs-6">
                        <?php
                     if(isset($_POST['add_cat'])){
                        $cat_title = $_POST['cat_title'];
                        if($cat_title=='' || empty($cat_title)){
                            echo "<small class='text-danger'>It cannot be empty</small>";
                        }else{
                            add_cat($cat_title);
                    }
                    }
                    ?>
                     <form action="categories.php" method="post">
                      <div class="form-group">
                       <label class="form-label" for="cat_title">Add Categories</label> 
                       <input type="text" class="form-control" name="cat_title" id="cat_title">
                      </div>
                      <div class="form-group">
                        <input class="btn btn-primary" type="submit" name="add_cat" id="" value="Add">
                      </div>
                      
                     </form>

                    
                    </div>


                    <div class="col-xs-6">
                        <table class="table table-bordered table-hover">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Id</th>
                                     <th>Category</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                
                                $result = fetch_category();
                                while($row = mysqli_fetch_assoc($result)){
                                    $cat_id = $row['cat_id'];
                                    $cat_title = $row['cat_title'];
                                ?> 

                                
                               <tr>
                                    <td><?php echo $cat_id?></td>
                                <td><?php echo $cat_title?></td>
                                <td><a href="?edit=<?php echo $cat_id?>">Edit</a></td>
                                <td><a href="?delete=<?php echo $cat_id?>">Delete</a></td>
                
                               </tr>
                            <?php
                            }
                            ?>   
                                
                            </tbody>
                        </table>
                    </div>
                    <?php
                     if(isset($_GET['edit'])){
                        $edit_id = $_GET['edit'];  
                        include "includes/edit_categories.php";
                    }
                    if(isset($_POST['edit_cat'])){
                    $edit_cat_title = $_POST['cat_title'];
                    $edit_id = $_POST['edit_id'];
                    edit_cat($edit_cat_title,$edit_id);
                    header("Location: categories.php");
                    exit();
                    }
                    ?>

        
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

 <?php include 'includes/admin_footer.php'?>
