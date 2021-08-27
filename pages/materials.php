<?php

include "../db.inc.php";

$identifier = "is_material";

session_start();

if (!isset($_SESSION['id'])) {
    header("Location:../login.php?error=Login Here First!");
}if($_SESSION['role'] ==2 || $_SESSION['role']==3){

include "../controller/materialController.php";
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
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-10">
                                <h3>Available Materials List</h3>

                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        Approved Clerances
                                        <div class="panel-body">
                                            <div class="table-responsive">
                                                <table class="table table-striped table-bordered table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Clerance Name</th>
                                                            <th>Quantity Available</th>
                                                            <th>In_charge</th>
                                                            <th>Date Created.</th>
                                                            <th>Change Material Status</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <form action="" method="POST">

                                                            <?php
                                                            $office = $_SESSION['office_id'];
                                                            // echo $office;
                                                            $sql = "SELECT * FROM `material` ORDERD  where in_charge = $office ORDER BY -date ";
                                                            $result = mysqli_query($conn, $sql);

                                                            if ($result->num_rows > 0) {
                                                                $count = 0;
                                                                // print_r($result);
                                                                while ($row = mysqli_fetch_assoc($result)) {
                                                                    $count += 1;
                                                            ?>

                                                                    <tr>
                                                                        <td><?php echo $count; ?></td>
                                                                        <td><?php echo $row['name'] ?></td>
                                                                        <td><?php echo $row['available_quantity'] ?></td>
                                                                        <td><?php echo $_SESSION['office'] . ' office' ?></td>
                                                                        <td><?php echo $row['date'] ?></td>
                                                                        <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
                                                                        <input type="hidden" name="name" value="<?php echo $row['name'] ?>">
                                                                        <input type="hidden" name="quantity" value="<?php echo $row['available_quantity'] ?>">
                                                                        <input type="hidden" name="office" value="<?php echo $office ?>">
                                                                        <input type="hidden" name="desc" value="<?php echo $row['description'] ?>">
                                                                        <input type="hidden" name="dt" value="<?php echo $row['date'] ?>">
                                                                        <td><a href="./updateMaterial.php?id=<?php echo $row['id'] ?>" style="margin:5px 15px;" name="update" class="btn btn-default"><i class=" fa fa-refresh "></i> Update</a><button name="view_detail_1" type="submit" class="btn btn-primary"><i class="fa fa-edit "></i> View Detail</button> <button name="delete_m" type="submit" class="btn btn-danger"><i class="fa fa-edit "></i>delete</button> </td>
                                                                    </tr>
                                                            <?php }
                                                            } ?>

                                                        </form>
                                                    </tbody>
                                                </table>
                                            </div>

                                            <!--  -->
                                            <?php
                                            if ($detail_1) {

                                            ?>
                                                Detail Tabs

                                                <div class="panel-body">
                                                    <ul class="nav nav-pills">
                                                        <li class=""><a href="#home-pills" data-toggle="tab">Description</a>
                                                        </li>
                                                        <li class=""><a href="#profile-pills" data-toggle="tab">Status</a>
                                                        </li>
                                                        <li class=""><a href="#messages-pills" data-toggle="tab">Date Created</a>
                                                        </li>
                                                        <li class="active"><a href="#settings-pills" data-toggle="tab">InCharge</a>
                                                        </li>
                                                    </ul>

                                                    <div class="tab-content">
                                                        <div class="tab-pane fade" id="home-pills">
                                                            <h4>Description</h4>
                                                            <p><?php echo $desc ?>.</p>
                                                            <p><?php echo "Available Quantity " . " " . $ful_n ?>.</p>
                                                            <p>Name <?php echo $it_name ?></p>
                                                        </div>
                                                      
                                                        <div class="tab-pane fade" id="messages-pills">
                                                            <h4>Material Creation Date</h4>
                                                            <p><?php echo $created ?>.</p>
                                                        </div>
                                                        <div class="tab-pane fade active in" id="settings-pills">
                                                            <h4>InCharge Of Controlling this Clerance and Management</h4>
                                                            <p><?php echo $_SESSION['office'] . ' office' ?>.</p>
                                                        </div>
                                                    </div>
                                                </div>
                                        </div>
                                    <?php } else { ?>


                                        <div class="panel-body">
                                            <ul class="nav nav-pills">
                                                <li class=""><a href="#home-pills" data-toggle="tab">Description</a>
                                                </li>
                                                <li class=""><a href="#profile-pills" data-toggle="tab">Status</a>
                                                </li>
                                                <li class=""><a href="#messages-pills" data-toggle="tab">Date Created</a>
                                                </li>
                                                <li class="active"><a href="#settings-pills" data-toggle="tab">InCharge</a>
                                                </li>
                                            </ul>

                                            <div class="tab-content">
                                                <div class="tab-pane fade" id="home-pills">
                                                    <!-- <h4>description</h4> -->
                                                    <p>Noting TO show Here Select one First</p>
                                                </div>
                                                <div class="tab-pane fade" id="profile-pills">
                                                    <!-- <h4>Status</h4> -->
                                                    <p>Noting TO show Here Select one First</p>
                                                </div>
                                                <div class="tab-pane fade" id="messages-pills">
                                                    <!-- <h4>Date Created</h4> -->
                                                    <p>Noting TO show Here Select one First</p>
                                                </div>
                                                <div class="tab-pane fade active in" id="settings-pills">
                                                    <!-- <h4>InCharge</h4> -->
                                                    <p>Noting TO show Here Select one First</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                                <!--  -->


                                <!--  -->
                                </div>
                            </div>
                        </div>


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
<?php }else{
    header("Location:../login.php?error=Trying to Access Unaoutorized Page!");
} ?>