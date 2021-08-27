<div class="panel-heading">
    Remaining Clearances
    <div class="panel-body">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Clearance Name</th>
                        <th>Clearance Owner</th>
                        <th>In_charge</th>
                        <th>Date Created.</th>
                        <th>Change Status</th>
                    </tr>
                </thead>
                <tbody>
                    <form action="" method="POST">

                        <?php
                    $office = $_SESSION['office_id'];
                    // echo $office;
                    $sql = "SELECT * FROM `clearance_list` where office = $office and `approved` = 0 ";
                    $result = mysqli_query($conn, $sql);
                    $remaning = $result->num_rows;

                    //  print_r($result);
                    if ($result->num_rows > 0) {
                        $count = 0;
                        // print_r($result);
                        while ($row = mysqli_fetch_assoc($result)) {
                            $owner = $row['clearance_owner'];


                            $count += 1;
                            $sql2 = "SELECT * FROM `users` where id = $owner ";
                            $result2 = mysqli_query($conn, $sql2);

                            $data = mysqli_fetch_assoc($result2);

                    ?>
                            <tr>
                                <td>
                                    <?php echo $count; ?>
                                </td>
                                <td>
                                    <?php echo $row['name'] ?>
                                </td>
                                <td>
                                    <?php echo $data['full_name'] ?>
                                </td>
                                <td>
                                    <?php echo $_SESSION['office'] . ' office' ?>
                                </td>
                                <td>
                                    <?php echo $row['date_created'] ?>
                                </td>
                                <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
                                <input type="hidden" name="name" value="<?php echo $row['name'] ?>">
                                <input type="hidden" name="full_name" value="<?php echo $data['full_name'] ?>">
                                <input type="hidden" name="completed" value="<?php echo $row['completed'] ?>">
                                <input type="hidden" name="app" value="<?php echo $row['approved'] ?>">
                                <input type="hidden" name="desc" value="<?php echo $row['description'] ?>">
                                <input type="hidden" name="dt" value="<?php echo $row['date_created'] ?>">
                                <td>
                                    <button name="view_detail_1" type="submit" class="btn btn-primary"><i class="fa fa-edit "></i> View Detail</button> 
                                    <button name="approve" type="submit" class="btn btn-warning"><i class="fa fa-pencil"></i> Approve</button>                                                                    <button name="delete" type="submit" class="btn btn-danger"><i class="fa fa-pencil"></i> Delete</button><a href="./updateClearance.php?id=<?php echo $row['id'] ?>" style="margin:5px 15px;"
                                        name="update" class="btn btn-default"><i class=" fa fa-refresh "></i> Update</a></td>
                            </tr>
                            <?php }
                    } ?>

                    </form>
                </tbody>
            </table>

            <!--  -->
            <?php
        if ($detail_1) {

        ?>
                <!-- Detail Tabs -->

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
                        <div class="tab-pane fade container-fluid" style="padding: 2em 0em;" id="home-pills">
                            <!-- <h4>Description</h4> -->
                            <p>
                                <?php echo $desc ?>.</p>
                            <p>
                                <?php echo "<strong>Clearance Owner</strong> " . " : " . $ful_n ?>.</p>
                            <p>
                                <?php echo "<strong>Clearance Name</strong> " . " : " . $it_name ?>.</p>
                        </div>
                        <div class="tab-pane fade container-fluid" style="padding: 2em 0em;" id="profile-pills">
                            <!-- <h4>Clearance Status</h4> -->
                            <strong>
                                <?php
                            if ($comp == 0 && $app == 1) {
                                echo "<h4 style='color:orange;'>you have Approved it , Waiting Supper Admin Approval!</h4>";
                            }
                            if ($comp == 1 && $app == 1) {
                                echo "<h4 style='color:green'>Clearance Approval Process Is Completed!</h4>";
                            }

                            if ($app ==  0) {
                                echo "<h4 style='color:blue' >Still Waiting For Your Approval ,Please approve as soon as possible!</h4>";
                            }

                            ?>.</strong>
                        </div>
                        <div class="tab-pane fade container-fluid" style="padding: 2em 0em;" id="messages-pills">
                            <!-- <h4>Clearance Creation Date</h4> -->
                            <strong>
                                <?php echo $created ?>.</strong>
                        </div>
                        <div class="tab-pane fade container-fluid active in" style="padding: 2em 0em;" id="settings-pills">
                            <!-- <h4>InCharge Of Controlling this Clearance and Management</h4> -->
                            <strong>
                                <?php echo $_SESSION['office'] . ' office' ?>.</strong>
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
                    <p style="color:red; font-weight: 900;">Nothing to show Here Select one First</p>
                </div>
                <div class="tab-pane fade" id="profile-pills">
                    <!-- <h4>Status</h4> -->
                    <p style="color:red; font-weight: 900;">Nothing to show Here Select one First</p>
                </div>
                <div class="tab-pane fade" id="messages-pills">
                    <!-- <h4>Date Created</h4> -->
                    <p style="color:red; font-weight: 900;">Nothing to show Here Select one First</p>
                </div>
                <div class="tab-pane fade active in" id="settings-pills">
                    <!-- <h4>InCharge</h4> -->
                    <p style="color:red; font-weight: 900;">Nothing to show Here Select one First</p>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>

</div>