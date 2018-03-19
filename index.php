<?php include("includes/header.php"); ?>

<?php //$photos = Photo::find_all(); ?>

<?php
    $page = !empty($_GET['page']) ? (int)$_GET['page'] : 1;
    $items_per_page = 4;
    $items_count = Photo::count_all();

    $pagination = new Pagination($page, $items_per_page, $items_count);

    $sql = "SELECT * FROM photos ";
    $sql .= "LIMIT {$items_per_page} ";
    $sql .= "OFFSET {$pagination->offset()}";
    $photos = Photo::find_query($sql);
?>

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-12">
                <h1 class="text-center">Welcome to my homepage</h1>
            </div>

            <!-- Blog Sidebar Widgets Column -->
<!--            <div class="col-md-4">-->
<!--            -->
<!--                 --><?php //include("includes/sidebar.php"); ?>
        </div>
        <!-- /.row -->

        <?php include("includes/footer.php"); ?>
