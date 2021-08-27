<?php

include "../db.inc.php";

session_start();

$identifier = "is_clearanceList";

if (!isset($_SESSION['id'])) {
    header("Location:../login.php?error=Login Here First!");
} 

if($_SESSION['role']==3){

include "../controller/clearanceController.php";

?>
    <!DOCTYPE html>
    <html >

    <?php include './includes/header.php'; ?>

    <body>
        <div id="wrapper">
            <?php include './includes/navbar.php'; ?>
            <div id="page-wrapper">
                <div id="page-inner">
                    <?php include './includes/notify.php'; ?>
                    <div class="row">
                        <div class="col-md-12">
                            <?php include './includes/cListView.php'; ?>
                        </div>
                    </div>
                </div>
            </div>

        </div>
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
<?php } 
else{
    header("Location:../login.php?error=Trying to Access Unaoutorized Page!");
}
?>