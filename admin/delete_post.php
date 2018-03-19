<?php require_once ('includes/init.php') ?>
<?php if (!$session->is_signed_in()) {redirect('login.php');}?>

<?php

    if (empty($_GET['id'])) {
        redirect('posts.php');
    } else {
        $post = post::find_by_id($_GET['id']);

        if ($post) {
            $post->delete();
            $session->message("post #{$post->id} deleted");
            redirect('posts.php');
        } else {
            redirect('posts.php');
        }
    }
?>
