<?php require_once ('includes/header.php')?>

<?php

    if(empty($_GET['id'])) {
        redirect('index.php');
    }
    $photo = Photo::find_by_id($_GET['id']);
    $comments = Comment::find_by_photo_id($_GET['id']);

//    if (isset($_POST['submit'])){
//        $new_comment = Comment::create_comment($photo->id, trim($_POST['author']), trim($_POST['body']));
//
//        if ($new_comment && $new_comment->save()) {
//            redirect('photo.php?id='.$photo->id);
//        } else {
//            $message = "Some problem ocured";
//        }
//    }
    if (isset($_POST['submit'])){
        $comment = new Comment();

        if($comment && !empty($photo->id) && !empty($_POST['author']) && !empty($_POST['body'])) {
            $comment->photo_id = $photo->id;
            $comment->author = $_POST['author'];
            $comment->body = $_POST['body'];
            $comment->created_at =date('d-m-y H:i:s');
            $comment->save();
            redirect('photo.php?id='.$photo->id);
        } else {
            $message = 'Wrong input';
        }
    }
?>

<?php include 'includes/header.php' ?>

        <div class="row">

            <!-- Blog Post Content Column -->
            <div class="col-lg-12">

                <!-- Blog Post -->

                <!-- Title -->
                <h1><?php echo $photo->title; ?></h1>

                <!-- Author -->


                <hr>

                <!-- Date/Time -->
                <p><span class="glyphicon glyphicon-time"></span> Posted at <?php echo $photo->created_at; ?> by <strong><?php echo $photo->author;?></strong></p>

                <hr>

                <!-- Preview Image -->
                <img class="img-responsive" src="admin/<?php echo $photo->picture_path(); ?>" alt="">

                <hr>

                <!-- Image description -->
                <p class="lead"><?php echo $photo->description ?></p>

                <hr>

                <!-- Blog Comments -->

                <!-- Comments Form -->
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form role="form" method="post">
                        <div class="form-group">
                            <label for="author">Author:</label>
                            <input type="text" name="author">
                        </div>

                        <div class="form-group">
                            <label for="body">Comment:</label>
                            <textarea class="form-control" rows="5" name="body"></textarea>
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>

                <hr>

                <!-- Posted Comments -->
                <?php foreach ($comments as $comment): ?>
                <!-- Comment -->
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading"><?php echo $comment->author?>
                            <small><?php echo $comment->created_at ?></small>
                        </h4>
                        <?php echo $comment->body?>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>

            <!-- Blog Sidebar Widgets Column -->
<!--            <div class="col-md-4">-->

<!--                --><?php //include("includes/sidebar.php"); ?>

        </div>
        <!-- /.row -->

    <?php include("includes/footer.php"); ?>