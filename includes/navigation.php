    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">Home Page</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="gallery.php">Gallery</a>
                    </li>
                    <li>
                        <a href="posts.php">Posts</a>
                    </li>

                </ul>
                <?php if (!$session->is_signed_in()): ?>
                <ul class="nav navbar-nav pull-right">
                    <li>
                        <a href="/admin/register.php">Register</a>
                    </li>
                    <li class="pull-right">
                        <a href="/admin/login.php">Sign in</a>
                    </li>
                </ul>
                <?php endif ?>

                <?php if ($session->is_signed_in()): ?>
                    <ul class="nav navbar-nav pull-right">
                        <?php if ($session->is_signed_in() && ($session->rights === 'administrator' || $session->rights === 'owner') ): ?>
                            <li>
                                <a href="/admin">Admin Panel</a>
                            </li>
                        <?php endif ?>
                        <li class="pull-right">
                            <a href="/admin/logout.php">Log out</a>
                        </li>
                    </ul>
                <?php endif ?>

            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>