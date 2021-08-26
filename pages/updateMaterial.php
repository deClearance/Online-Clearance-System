<?php

include "../db.inc.php";

session_start();

$identifier = "is_updateMaterial";

if (!isset($_SESSION['id'])) {
    header("Location:../login.php?error=Login Here First!");
}if($_SESSION['role'] ==2 || $_SESSION['role']==3){

  include "../controller/updateMaterialController.php"

?>

    <!DOCTYPE html>
    <html>

    <?php include './includes/header.php' ?>

    <body>
        <div id="wrapper">

            <?php include './includes/navbar.php' ?>

            <div id="page-wrapper">
                <div id="page-inner">
                    <div class="row">
                        <div class="col-md-12">
                            <h2>Admin <?php echo $_SESSION['office'] . '   '  ?> Dashboard</h2>
                            <h5>Welcome <?php echo $_SESSION['userName'] ?> , Love to see you back. </h5>
                        </div>
                        

                    </div>
                    <?php if (isset($_GET['message'])) { ?>
                        <div class="message">
                            <h5>
                                <p class="error"><?php echo $_GET['message']; ?></p>
                            </h5>
                            
                        </div>
                    <?php } ?>
                    <!-- here -->

                    <div class="row">
                    <div class="col-md-8">
                            <div class="col-md-10">
                                <div class="col-md-8">
                                <h3>Material Update Form</h3>
                                <form role="form" action="" method="POST">

                                    <!-- MaterialName -->
                                    <div class="form-group">

                                        <input class="form-control" name="name" placeholder="Material Name <?php echo $row['name'] ?>" />

                                    </div>
                                
                                    <!-- Available Quantity -->
                                    <div class="form-group">

                                        <input class="form-control" type="number" min="1" name="quantity" placeholder="Availabel Quantity  <?php echo $row['available_quantity']?>" />

                                    </div>
                                    <!-- End of AvailableQuantity -->
                                    <!-- Select Owener -->
                                    <div class="form-group">

                                        <input class="form-control" type="hidden" name="id" value="<?php echo $row['id'] ?>" />

                                    </div>
                                    <!-- End Owner -->
                                    <!-- Description -->
                                    <div class="form-group">

                                        <textarea class="form-control" name="desc" placeholder="<?php echo $row['description'] ?>"></textarea>

                                    </div>
                                    <!-- Description -->

                                    <button type="submit" name="update_material" class="btn btn-success btn-lg">Update Material</button>

                                </form>
                            
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- /. ROW  -->
            
            <!-- /. ROW  -->
            
        </div>
        <!-- /. ROW  -->
        </div>
        <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
        </div>
        <!-- /. WRAPPER  -->
    </body>

    </html>
<?php } else{
    header("Location:../login.php?error=Trying to Access Unaoutorized Page!");
}
?>