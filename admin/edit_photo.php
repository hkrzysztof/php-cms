<?php include("includes/header.php") ?>

<?php if (!$session->is_signed_in()) {redirect('login.php');}?>

<?php

    if (empty($_GET['id'])) {
        redirect('photos.php');
    } else {
        $photo = Photo::find_by_id($_GET['id']);

         if (isset($_POST['update'])) {

            if($photo) {

                $photo->title = $_POST['title'];
                $photo->alt_text = $_POST['alt_text'];
                $photo->description = $_POST['description'];
                $photo->last_modified = date('d-m-y H:i:s');
                $session->message("Photo #{$photo->id} updated");
                $photo->save();
                redirect('photos.php');

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
                            Photo #<?php echo $photo->id?> edit panel
                        </h1>

                        <form action="" method="post">

                            <div class="col-md-8">

                                <div class="form-group">
                                    <a href="#"><img class="thumbnail center-block edit_photo_thumbnail" src="<?php echo $photo->picture_path();?>" alt=""></a>
                                </div>
                                
                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input type="text" name="title" class="form-control" value="<?php echo $photo->title; ?>">
                                </div>

                                <div class="form-group">
                                    <label for="alt_text">Alt text</label>
                                    <input type="text" name="alt_text" class="form-control" value="<?php echo $photo->alt_text; ?>">
                                </div>

                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea name="description" id="" cols="30" rows="8" class="form-control"><?php echo $photo->description ?></textarea>
                                </div>

                            </div>

                            <div class="col-md-4" >
                                <div  class="photo-info-box">
                                    <div class="info-box-header">
                                        <h4>Photo details: <a href="#"><span id="toggle" class="glyphicon glyphicon-menu-up pull-right"></span></a></h4>
                                    </div>
                                    <div class="inside">
                                        <div class="box-inner">
                                            <p class="text">
                                                <span class="glyphicon glyphicon-calendar"></span> Uploaded on: <?php echo $photo->created_at ?>
                                            </p>
                                            <p class="text ">
                                                Photo Id: <span class="data photo_id_box"><?php echo $photo->id ?></span>
                                            </p>
                                            <p class="text">
                                                Filename: <span class="data"><?php echo $photo->filename ?></span>
                                            </p>
                                            <p class="text">
                                                File Type: <span class="data"><?php echo $photo->type ?></span>
                                            </p>
                                            <p class="text">
                                                File Size: <span class="data"><?php echo $photo->size/1000 ?> kb</span>
                                            </p>
                                        </div>
                                        <div class="info-box-footer clearfix">
                                            <div class="info-box-delete pull-left">
                                                <a  href="delete_photo.php?id=<?php echo $photo->id; ?>" class="btn btn-danger btn-lg ">Delete</a>
                                            </div>
                                            <div class="info-box-update pull-right ">
                                                <input type="submit" name="update" value="Update" class="btn btn-primary btn-lg ">
                                            </div>
                                        </div>
                                    </div>
                                </div>
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