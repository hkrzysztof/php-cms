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

                <div class="thumbnails row">
                    <?php foreach ($photos as $photo): ?>


                            <div class="col-xs-6 col-md-3">
                                <a href="photo.php?id=<?php echo $photo->id ?>" class="thumbnail">
                                        <img src="admin/<?php echo $photo->picture_path(); ?>" alt=""  class="gallery_homepage_photo img-responsive">
                                </a>
                            </div>


                    <?php endforeach ?>
                </div>

                <div class="row">
                    <ul class="pager">
                        <?php if ($pagination->page_total() > 1) {
                            if ($pagination->has_next()) {
                               echo "<li class='next'><a href='index.php?page={$pagination->next()}'>Next</a></li>";
                            }

                            for ($i=1; $i <= $pagination->page_total(); $i++) {
                                if ($i == $pagination->current_page) {
                                    echo "<li class='active'><a href='index.php?page={$i}'>{$i}</a></li>";
                                } else {
                                    echo "<li><a href='index.php?page={$i}'>{$i}</a></li>";
                                }
                            }



                            if ($pagination->has_previous()) {
                                echo "<li class='previous'><a href='index.php?page={$pagination->previous()}'>Previous</a></li>";
                            }
                        } ?>


                    </ul>
                </div>
            </div>

            <!-- Blog Sidebar Widgets Column -->
<!--            <div class="col-md-4">-->
<!--            -->
<!--                 --><?php //include("includes/sidebar.php"); ?>
        </div>
        <!-- /.row -->

        <?php include("includes/footer.php"); ?>
