<?php include("includes/header.php") ?>

<?php if (!$session->is_signed_in()) {redirect('login.php');}?>

<?php

    if (empty($_GET['id'])) {
        redirect('posts.php');
    } else {
        $post = Post::find_by_id($_GET['id']);

        if (isset($_POST['update'])) {

            if($post) {

                $post->title = $_POST['title'];
                $post->body = $_POST['body'];
                $post->last_modified = date('d-m-y H:i:s');
                $session->message("Post #{$post->id} updated");
                $post->save();
                redirect('posts.php');

            }
        }
    }
?>



        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <?php include("includes/top_nav.php") ?>

            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <?php include("includes/side_nav.php") ?>
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">
    
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Posts
                        </h1>

                        <form action="" method="post">

                            <div class="col-md-6">

                                <div class="form-group">
                                    <label for="title">Title: </label>
                                    <input type="text" name="title" class="form-control" value="<?php echo $post->title; ?>">
                                </div>

                                <div class="form-group">
                                    <label for="body">Post: </label>
                                    <textarea name="body" id="" cols="30" rows="10" class="form-control"><?php echo $post->body; ?></textarea>
                                </div>
                                <a id="post_id" href="delete_post.php?id=<?php echo $post->id; ?>" class="btn btn-danger pull-left">Delete</a>
                                <input type="submit" name="update" value="Update" class="btn btn-primary pull-right">
                            </div>

                        </form>

                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

  <?php include("includes/footer.php") ?>