<?php require_once('includes/header.php'); ?>

<?php
    if ($session->is_signed_in()) {
        redirect('../index.php');
    }

    //Trimming if submit is clicked
    if (isset($_POST['submit'])) {
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);

        $user_found = User::verify_user_secure(trim($username), trim($password));

        if ($user_found) {
            $session->login($user_found);
            redirect('../index.php');
//        echo $session->is_signed_in();
        } else {
            $the_msg = "Wrong login or password. Try again.";
        }

    } else {
        $username = '';
        $password = '';
        $the_msg = '';
    }
?>


<div class="col-md-4 col-md-offset-3">

    <h4 class="bg-danger"><?php echo $the_msg; ?></h4>
    <h4 class="bg-success"><?php echo $session->message ?></h4>

    <form id="login-id" action="" method="post">

        <div class="form-group">
            <label for="username" class="login_label">Username</label>
            <input type="text" class="form-control" name="username" value="<?php echo htmlentities($username); ?>" >

        </div>

        <div class="form-group">
            <label for="password" class="login_label">Password</label>
            <input type="password" class="form-control" name="password" value="<?php echo htmlentities($password); ?>">

        </div>


        <div class="form-group">
            <input type="submit" name="submit" value="Submit" class="btn btn-primary">
            <a class="btn btn-success pull-right" href="register.php">Register</a>
        </div>




    </form>


</div>
