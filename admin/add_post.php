<?php include("includes/header.php") ?>

<?php if (!$session->is_signed_in()) {redirect('login.php');}?>

<?php

 if (isset($_POST['create'])) {

    $post = new Post();
    $user_found = User::find_by_id($session->user_id);

    if ($post) {

        $post->title = $_POST['title'];
        $post->body = $_POST['body'];
        $post->author = $user_found->username;
        $post->created_at = date('d-m-y H:i:s');

        $post->save();
        $session->message('post created');
        redirect('posts.php');
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
                            Create Post
                        </h1>

                        <form action="" method="post">

                            <div class="col-md-6">

                                <div class="form-group">
                                    <label for="title">Title: </label>
                                    <input type="text" name="title" class="form-control" >
                                </div>

                                <div class="form-group">
                                    <label for="body">Post: </label>
                                    <textarea name="body" id="" cols="30" rows="10" class="form-control"></textarea>
                                </div>

                                <input type="submit" name="create" value="Create" class="btn btn-primary pull-right">
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