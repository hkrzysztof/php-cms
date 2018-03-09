<?php require_once ('init.php'); ?>

<?php

    $user = new User();

    if (isset($_POST['img_name'])) {
        $user->ajax_save_user_image($_POST['img_name'], $_POST['user_id']);
    }
?>

