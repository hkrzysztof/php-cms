    <?php require_once('includes/header.php'); ?>

<?php
    if ($session->is_signed_in()) {
        redirect('../index.php');
    }

    //Trimming if submit is clicked
    if (isset($_POST['submit'])) {
        $user = new User();
        $user->username = trim($_POST['username']);
        $user->password = User::secured_hash(trim($_POST['password']));
        $user->first_name = trim($_POST['first_name']);
        $user->last_name = trim($_POST['last_name']);
        $user->created_at = date('d-m-y H:i:s');
        $user->create_account_secure($user->username, $user->password, $user->first_name, $user->last_name);
        $session->message("Account created successfully. Please log in.");
        redirect('login.php');
    }
?>


<div class="col-md-4 col-md-offset-3">

<!--    <h4 class="bg-danger">--><?php //echo $the_msg; ?><!--</h4>-->

    <form id="login-id" action="" method="post">

        <div class="form-group">
            <label for="username" class="login_label">Username</label>
            <input type="text" class="form-control" name="username">
        </div>

        <div class="form-group">
            <label for="password" class="login_label">Password</label>
            <input type="password" class="form-control" name="password">
        </div>

        <div class="form-group">
            <label for="first_name" class="login_label">First Name</label>
            <input type="text" class="form-control" name="first_name">
        </div>

        <div class="form-group">
            <label for="last_name" class="login_label">Last Name</label>
            <input type="text" class="form-control" name="last_name">
        </div>


        <div class="form-group">
            <input type="submit" name="submit" value="Submit" class="btn btn-primary">

        </div>


    </form>


</div>
