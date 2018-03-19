<?php require_once ('includes/header.php')?>

<?php

    if($session->is_signed_in()) {
        $user_found = User::find_by_id($session->user_id);
        $username = $user_found->username;
    }

    $posts = Post::find_all();
?>

        <div class="row">

            <?php foreach ($posts as $post): ?>
            <!-- Blog Post Content Column -->
            <div class="col-lg-10 col-lg-offset-1 posts_box">


                <!-- Blog Post -->

                <!-- Title -->
                <h2><?php echo $post->title; ?></h2>

                <hr>

                <!-- Date/Time and Author-->
                <p><span class="glyphicon glyphicon-time"></span> Posted at <?php echo $post->created_at; ?> by <strong><?php echo $post->author;?></strong></p>


                <hr>

                <!-- Body -->
                <p class="text"><?php echo $post->body ?></p>
                <a href="post.php?id=<?php echo $post->id ?>">Read more</a>

            </div>
                <?php endforeach; ?>
<!--                <!-- Blog Comments -->
<!---->
<!--                --><?php //if ($session->is_signed_in()):?>
<!--                <!-- Comments Form -->
<!--                <div class="well">-->
<!--<!--                    <h4>Leave a Comment:</h4>-->
<!--                    <form role="form" method="post">-->
<!--<!--                        <div class="form-group">-->
<!--<!--                            <input type="text" name="author" hidden="hidden" value="--><?php ////echo $username ?><!--<!--">-->
<!--<!--                        </div>-->
<!---->
<!--                        <div class="form-group">-->
<!--                            <label for="body">Comment:</label>-->
<!--                            <textarea class="form-control" rows="5" name="body"></textarea>-->
<!--                        </div>-->
<!--                        <button type="submit" name="submit" class="btn btn-primary">Submit</button>-->
<!--                    </form>-->
<!--                </div>-->
<!--                --><?php //endif; ?>
<!---->
<!--                <hr>-->
<!---->
<!--                <!-- Posted Comments -->
<!--                --><?php //foreach ($comments as $comment): ?>
<!--                <!-- Comment -->
<!--                <div class="media">-->
<!--                    <a class="pull-left" href="#">-->
<!--                        <img class="media-object" src="http://placehold.it/64x64" alt="">-->
<!--                    </a>-->
<!--                    <div class="media-body">-->
<!--                        <h4 class="media-heading">--><?php //echo $comment->author?>
<!--                            <small>--><?php //echo $comment->created_at ?><!--</small>-->
<!--                        </h4>-->
<!--                        --><?php //echo $comment->body?>
<!--                    </div>-->
<!--                </div>-->
<!--                --><?php //endforeach; ?>


            <!-- Blog Sidebar Widgets Column -->
<!--            <div class="col-md-4">-->

<!--                --><?php //include("includes/sidebar.php"); ?>

        </div>
        <!-- /.row -->

    <?php include("includes/footer.php"); ?>