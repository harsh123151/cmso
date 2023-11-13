<?php include "includes/header.php";?>
<?php include 'includes/db.php';?>
<?php include "Functions/fetch_post.php";?>

    <!-- Navigation -->
<?php include "includes/navigation.php"?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
                <?php include "includes/search_result.php";?>
               
            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php"?>;

        </div>
        <!-- /.row -->

        <hr>

        <nav aria-label="Page navigation example">
        <ul class="pagination ">
            <li class="page-item <?php echo ($page-1===0)?'disabled hidden':'' ?>">
            <a class="page-link" href="index.php?page=<?php
            echo $page - 1;
            
            ?>" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
                <span class="sr-only">Previous</span>
            </a>
            </li>
            <?php
            for($i=1;$i<=$count;$i++){
            echo "<li class='page-item'><a class='page-link' href='index.php?page=$i'>$i</a></li>";
            }
            ?>
            <li class="page-item <?php echo ($page+1>$count)?'disabled hidden':'' ?>">
            <a class="page-link" href="index.php?page=<?php 
            echo $page+1;
            ?>" aria-label="Next">
                <span aria-hidden="true">&raquo;</span>
                <span class="sr-only">Next</span>
            </a>
            </li>
        </ul>
        </nav>
        <!-- Footer -->
        <?php include "includes/footer.php" ?>
