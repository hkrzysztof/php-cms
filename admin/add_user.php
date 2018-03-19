<?php include("includes/header.php") ?>

<?php if (!$session->is_signed_in() || !($session->rights === 'owner')) {redirect('login.php');}?>

<?php

 if (isset($_POST['create'])) {

    $user = new User();

    if ($user) {

        $user->username = $_POST['username'];
        $user->password = User::secured_hash(trim($_POST['password']));
        $user->first_name = $_POST['first_name'];
        $user->last_name = $_POST['last_name'];
        $user->created_at = date('d-m-y H:i:s');
        $user->rights = $_POST['rights'];

        if (empty($_FILES['user_image'])) {
            $user->save();
            $session->message('User created');
            redirect('users.php');
        } else {
            $user->set_file($_FILES['user_image']);
            $user->save_with_image();
            $user->save();
            $session->message('User created');
            redirect('users.php');
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
                            Add User
                        </h1>

                        <form action="" method="post" enctype="multipart/form-data">

                            <div class="col-md-6">

                                <div class="form-group">
                                    <label for="user_image">User Image</label>
                                    <input type="file" name="user_image" class="form-control" >
                                </div>

                                <div class="form-group">
                                    <label for="title">Username</label>
                                    <input type="text" name="username" class="form-control" >
                                </div>

                                <div class="form-group">
                                    <label for="caption">Password</label>
                                    <input type="password" name="password" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label for="alt_text">First Name</label>
                                    <input type="text" name="first_name" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label for="alt_text">Last Name</label>
                                    <input type="text" name="last_name" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label for="rights">Rights</label>
                                    <select name="rights">
                                        <option value="owner">Owner</option>
                                        <option value="administrator">Administrator</option>
                                        <option value="subscriber" selected>Subscriber</option>
                                    </select>
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