<?php include("includes/header.php") ?>

<?php if (!$session->is_signed_in()) {redirect('login.php');}?>

<?php $posts = Post::find_all(); ?>


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

                    <div class="page-header">
                        <h1>Posts</h1>
                        <a href="add_post.php" class="btn btn-primary">Add post</a>
                    </div>

                    <div class="col-xs-2"><?php echo $session->message ?></div>

                    <div class="col-md-12">

                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Author</th>
                                <th>Title</th>
                                <th>Body</th>
                                <th>Created At</th>
                                <th>Last Modified</th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php foreach ($posts as $post): ?>

                                <tr>
                                    <td><?php echo $post->id; ?></td>
                                    <td><?php echo $post->author; ?></td>
                                    <td><?php echo $post->title ?>
                                        <div class="action_links">
                                            <a href="delete_post.php?id=<?php echo $post->id; ?>">Delete</a>
                                            <a href="edit_post.php?id=<?php echo $post->id; ?>">Edit</a>
                                        </div>
                                    </td>
                                    <td><p class="text"><?php echo $post->body; ?></p></td>
                                    <td><?php echo $post->created_at; ?></td>
                                    <td><?php echo $post->last_modified; ?></td>
                                </tr>

                            <?php endforeach ?>

                            </tbody>
                        </table>

                    </div>

                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->

<?php include("includes/footer.php") ?>