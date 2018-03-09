<?php require_once ('includes/init.php') ?>
<?php if (!$session->is_signed_in()) {redirect('login.php');}?>

<?php

    if (empty($_GET['id'])) {
        redirect("comments.php");
    } else {
        $comment = Comment::find_by_id($_GET['id']);

        if ($comment) {
            $comment->delete();
            $session->message("Comment #{$comment->id} deleted");
            redirect("comments_photo.php?id={$comment->photo_id}");
        } else {
            redirect("comments_photo.php?id={$comment->photo_id}");
        }
    }
?>
