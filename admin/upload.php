<?php include("includes/header.php") ?>

<?php if (!$session->is_signed_in()) {redirect('login.php');}?>

<?php
$message="";
$user_found = User::find_by_id($session->user_id);

if (isset($_POST['submit'])) {
    $photo = new Photo();
    $photo->created_at = date('d-m-y H:i:s');
    $photo->title = $_POST['title'];
    $photo->description = $_POST['description'];
    $photo->author = $user_found->username;
    $photo->set_file($_FILES['file_uploaded']);

    if ($photo->save_with_image()) {
        $message = "Photo uploaded successfully";
    } else {
        $message = join("<br>", $photo->errors);
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
                            Upload image
                        </h1>

                        <div class="col-md-6">
                            <?php  echo $message?>
                            <form action="upload.php" method="post" enctype="multipart/form-data">

                                <div class="form-group">
                                    <label for="title">Title: </label>
                                    <input type="text" name="title" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label for="description">Description: </label>
                                    <textarea name="description" id="" cols="30" rows="5" class="form-control"></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="file">File</label>
                                    <input type="file" name="file_uploaded" class="form-control">
                                </div>

                                <input type="submit" name="submit" value="Upload">

                            </form>
                        </div>

                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

  <?php include("includes/footer.php") ?>