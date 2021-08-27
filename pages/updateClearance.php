<?php

include "../db.inc.php";

session_start();

if (!isset($_SESSION['id'])) {
    header("Location:../login.php?error=Login Here First!");
    }
if($_SESSION['role'] ==2 || $_SESSION['role']==3){
    include "../controller/cleranceUpdateController.php";
?>
    <!DOCTYPE html>
    <html>

    <?php include './includes/header.php' ?>

    <body>
        <div id="wrapper">
    
            <?php include './includes/navbar.php' ?>
            
            <div id="page-wrapper">
                <div id="page-inner">
                    <?php include './includes/notify.php'; ?>
                    <!-- here -->

                    <div class="row container">
                    <div class="col-md-8" style="margin:auto 15vw;background-color:whitesmoke;padding:15px 15px;">
                            <div class="col-md-10">
                                <h3>Clerance Update Form</h3>
                                <form role="form" action="" method="POST">
                                    <!-- office -->
                                    <div class="form-group">

                                        <input class="form-control" name="office" type="hidden" value="<?php echo $_SESSION['office_id'] ?>" />

                                    </div>
                                    <div class="form-group">

                                        <input class="form-control" name="id" type="hidden" value="<?php echo $_GET['id'] ?>" />

                                    </div>
                                    <!-- ClearanceName -->
                                    <div class="form-group">

                                        <input class="form-control" name="name" value="<?php echo $ray['name'] ?>" required />

                                    </div>
                                    <!-- ClearanceName -->
                                    <!--  -->

                                    <!-- InCharge -->
                                    <div class="form-group">

                                        <input class="form-control" type="hidden" name="in_charge" value="<?php echo $_SESSION['id'] ?>" />

                                    </div>
                                    <!-- In Charge -->
                                    <!--  -->
                                    <!-- Material -->
                                    <div class="form-group">
                                        <label>Select Clearance Material to Update</label>
                                        <select class="form-control" name="material">

                                            <?php

                                            $sql = "SELECT * FROM `material` where available_quantity > 0";
                                            $result = mysqli_query($conn, $sql);
                                            if ($result->num_rows > 0) {

                                                print_r($result);
                                                while ($row = mysqli_fetch_assoc($result)) {
                                            ?>
                                                    <option value="<?php echo $row['id'] ?>"><?php echo $row['name'] ?></option>
                                                <?php }
                                            } else { ?>
                                                <div class="form-group">

                                                    <input class="form-control" disabeld placeholder="No Materials Are Availabel Please Add One" />
                                                </div><?php } ?>

                                        </select>
                                    </div>
                                    <!-- End Material -->
                                    <!--  -->
                                    <!-- Select Owener -->
                                    <div class="form-group">
                                        <label>Select Clearance Oweners to Update</label>
                                        <select class="form-control" name="owener">

                                            <?php

                                            $current = $_SESSION['id'];
                                            $sql = "SELECT * FROM `users` where id!=$current";
                                            $result = mysqli_query($conn, $sql);
                                            if ($result->num_rows > 0) {

                                                print_r($result);
                                                while ($row = mysqli_fetch_assoc($result)) {
                                            ?>
                                                    <option value="<?php echo $row['id'] ?>"><?php echo $row['full_name'] ?></option>
                                                <?php }
                                            } else { ?>
                                                <div class="form-group">

                                                    <input class="form-control" disabeld placeholder="No Materials Are Availabel Please Add One" />
                                                </div><?php } ?>
                                        </select>
                                    </div>
                                    <!-- End Owner -->
                                    <!-- Description -->
                                    <div class="form-group">

                                        <textarea class="form-control" name="desc"  value="<?php echo $ray['description']; ?>"></textarea>

                                    </div>
                                    <!-- Description -->

                                    <button type="submit" name="Update_clearance" class="btn btn-info btn-lg">Update Clearance</button>

                                </form>
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