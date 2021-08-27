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
                    <?php include './includes/notify.php'; ?>
                    <!-- dont -->
                </div>
                <!-- /. ROW  -->
                <div class="row container-fluid" >
                    <!-- one -->
                    <!-- end one -->
                    <div class="row" style="margin-top: 25px;background-color:whitesmoke;padding:25px 10px; display:flex; justify-content:center;">
                        <!-- office -->
                        <div class="col-md-6">
                            <form action="" method="POST">
                                <h3>Write a feedback</h3>
                                <div class="form-group">
                                    <br>
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
                                                <textarea class="form-control" disabeld placeholder="No Offices Are Availabel Please Add One"> </textarea>
                                            </div><?php } ?>
                                    </select>
                                </div>

                                <div class="form-group">

                                    <textarea class="form-control" name="mess" placeholder="Work Description" rows="3"></textarea>

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