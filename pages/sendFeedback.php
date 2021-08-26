<?php

include "../db.inc.php";

session_start();

$identifier = "is_feedback";

if (!isset($_SESSION['id'])) {
    header("Location:../login.php?error=Login Here First!");
} else {
   include "./../controller/feedbackController.php";

?>
    <!DOCTYPE html>
    <html >

    <?php include './includes/header.php'; ?>

    <body>
        <div id="wrapper">

            <?php include './includes/navbar.php'; ?>

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
                    <!-- dont -->
                </div>
                <!-- /. ROW  -->
                <div class="row">
                    <!-- one -->
                    <!-- end one -->
                    <div class="row" style="margin-top: 25px;background-color:grey;padding:25px 10px">
                        <!-- office -->
                        <div class="col-md-6">
                            <form action="" method="POST">
                                <h3 style="color: #fff;">feedbacks Creation Form</h3>
                                <div class="form-group">
                                    <label>Choose Office</label>
                                    <select class="form-control" name="office">
                                        <?php

                                        $current = $_SESSION['id'];
                                        $sql = "SELECT * FROM `office`";
                                        $result = mysqli_query($conn, $sql);
                                        if ($result->num_rows > 0) {

                                            // print_r($result);
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                print_r($row);
                                        ?>
                                                <option value="<?php echo $row['id'] ?>"><?php echo $row['name'] ?></option>
                                            <?php }
                                        } else { ?>
                                            <div class="form-group">

                                                <input class="form-control" disabeld placeholder="No Offices Are Availabel Please Add One" />
                                            </div><?php } ?>
                                    </select>
                                </div>

                                <div class="form-group">

                                    <input type="textarea" class="form-control" name="mess" placeholder="Work Description">

                                </div>
                                <input type="submit" name="send" class="btn btn-warning btn-lg" value="Send Feedbacks">

                            </form>
                        </div>
                        <!-- Office -->


                        <!-- here -->
                        </form>

                    </div>

                </div>
                <!-- /. ROW  -->

                <!-- Clerance End -->
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
<?php } ?>