<?php include("includes/header.php") ?>

<?php if (!$session->is_signed_in()) {redirect('login.php');}?>

<?php $users = User::find_all(); ?>

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
                        <h1>Users</h1>
                        <?php if ($session->rights === 'owner'): ?>
                            <a href="add_user.php" class="btn btn-primary">Add user</a>
                        <?php endif; ?>

                    </div>

                    <div class="col-xs-2"><?php echo $session->message ?></div>

                    <div class="col-md-12">

                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>Picture</th>
                                <th>Id</th>
                                <th>Username</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Created At</th>
                                <th>Last Modified</th>
                                <th>Posts</th>
                                <th>Photos</th>
                                <th>Comments</th>
                                <?php if ($session->rights === 'owner'): ?>
                                <th>Rights</th>
                                <?php endif; ?>
                            </tr>
                            </thead>
                            <tbody>

                            <?php foreach ($users as $user): ?>

                                <tr>
                                    <td><img src="<?php echo $user->image_path_and_placeholder(); ?>" alt="user_pic" class="admin_thumbnail"></td>
                                    <td><?php echo $user->id; ?></td>
                                    <td><?php echo $user->username ?>
                                        <div class="action_links">
                                            <a href="delete_user.php?id=<?php echo $user->id; ?>">Delete</a>
                                            <a href="edit_user.php?id=<?php echo $user->id; ?>">Edit</a>
                                        </div>
                                    </td>
                                    <td><?php echo $user->first_name; ?></td>
                                    <td><?php echo $user->last_name; ?></td>
                                    <td><?php echo $user->created_at; ?></td>
                                    <td><?php echo $user->last_modified; ?></td>
                                    <td><?php echo Post::count_all_by_user($user->username); ?></td>
                                    <td><?php echo Photo::count_all_by_user($user->username); ?></td>
                                    <td><?php echo Comment::count_all_by_user($user->username); ?></td>
                                    <?php if ($session->rights === 'owner'): ?>
                                        <td><?php echo $user->rights; ?></td>
                                    <?php endif; ?>
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