<?php include("includes/header.php") ?>

<?php if (!$session->is_signed_in()) {redirect('login.php');}?>

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
                            Admin Page
                            <small>Subheading</small>
                        </h1>

                            <?php
//                                $results = User::find_all_users();
//
//                                while($row = mysqli_fetch_array($results)) {
//                                    echo $row['username'].'<br>';
//                                }
//
//                                $user_found = User::find_by_id(1);
//                                echo $user_found['username'];

//                                $user_found = User::find_by_id(1);
//                                $user = User::instantation($user_found);
//
//                                echo $user->id;
//                                echo $user->password;

//                                $users = User::find_all_users();
//
//                                foreach ($users as $user) {
//                                    echo $user->username.'<br>';
//                                }

//                            $user_found = User::find_by_id(2);
//////                            $user_found = new User();
//                            $user_found->last_name = "tester";
//                            $user_found->save();
//                            echo $user_found->username;

//                            $hid = new User();
//                            $hid->username = 'hidok';
//                            $hid->password = '1234';
//                            $hid->first_name = 'ferst';
//                            $hid->last_name = 'last';
//                            $hid->save();

                            ?>

                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.html">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> Blank Page
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

  <?php include("includes/footer.php") ?>