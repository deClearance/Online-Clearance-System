<?php

include "../db.inc.php";

session_start();

$identifier = "is_home";

if (!isset($_SESSION['id'])) {
    header("Location:../login.php?error=Login Here First!");
} else {

   include "../controller/indexController.php";
?>
    <!DOCTYPE html>
    <html>

    <?php include './includes/header.php' ?>

    <body>
        <div id="wrapper">

            <?php include_once './includes/navbar.php' ?>

            <div id="page-wrapper">
                <div id="page-inner">
                    <div class="row">
                        <div class="col-md-7">
                            <h2>Admin <?php echo $_SESSION['office'] . '   '  ?> Dashboard</h2>
                        </div>
                        <div class="col-sm-1" style="margin-top: 15px;">
                            <button type="button" class="btn btn-info btn-circle">
                                <h1 style="color:#fff; font-size:20px; margin:0;font-weight:700;"> 
                                    <?php
                                        $m_id = $_SESSION['id'];
                                        $sql = "SELECT * FROM message where to_user = $m_id";
                                        $result = mysqli_query($conn, $sql);
                                        echo $result->num_rows;
                                    ?>
                                </h1>
                            </button>
                        </div>
                        <div class="col-md-1">
                            <h2>Messages</h2>
                        </div>
                    </div>

                    <?php if (isset($_GET['error'])) { ?>
                    <div class="message">
                        <h5>
                            <p class="error">
                                <?php echo $_GET['error']; ?>
                            </p>
                        </h5>
                    </div>
                    <?php } ?>
                    <!-- /. ROW  -->
                    <hr />
                    <!-- Admins Only -->
                    <?php if($_SESSION['role'] ==3 || $_SESSION['role'] == 2) {?>

                    <div class="row">
                        <div class="col-md-3 col-sm-6 col-xs-6">
                            <div class="panel panel-back noti-box">
                                <span class="icon-box bg-color-red set-icon">
                                    <i class="fa fa-envelope-o"></i>
                                </span>
                                <div class="text-box">
                                    <p class="main-text">
                                        <?php
                                        $my_of = $_SESSION['office_id'];
                                        $sql = "SELECT * FROM `feedbacks` where to_office = $my_of ";
                                        $result = mysqli_query($conn, $sql);
                                        echo $result->num_rows;
                                        ?> Review</p>
                                    <p class="text-muted">Feedbacks</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 col-xs-6">
                            <div class="panel panel-back noti-box">
                                <span class="icon-box bg-color-green set-icon">
                                    <i class="fa fa-bars"></i>
                                </span>
                                <div class="text-box">
                                    <p class="main-text">
                                        <?php
                                        $office = $_SESSION['office_id'];
                                        $result = approvedClearance($office, 0);
                                        $remaning = count($result);
                                        $no_of_not_approved = $remaning;
                                        echo $remaning; ?> Clearance</p>
                                    <p class="text-muted">Remaining Pending</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 col-xs-6">
                            <div class="panel panel-back noti-box">
                                <span class="icon-box bg-color-blue set-icon">
                                    <i class="fa fa-check"></i>
                                </span>
                                <div class="text-box">
                                    <p class="main-text">
                                        <?php
                                            $result = approvedClearance($office, 1);
                                            $remaning = count($result);
                                            $no_of_approved = $remaning;
                                            echo count($result);
                                        ?> Approved</p>
                                    <p class="text-muted">Approved Clearances</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 col-xs-6">
                            <div class="panel panel-back noti-box">
                                <span class="icon-box bg-color-brown set-icon">
                                    <i class="fa fa-question"></i>
                                </span>
                                <div class="text-box">
                                    <p class="main-text">
                                        <?php
                                        $sql = "SELECT * FROM `clerance_request` where office_requested  = $office";
                                        $result = mysqli_query($conn, $sql);
                                        echo $result->num_rows;

                                        ?> Requests</p>
                                    <p class="text-muted">Total</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php }?>
                    <!-- Admins Only -->
                    <!-- /. ROW  -->
                    <hr />
                    <div class="row">
                        <!-- Admins Only -->
                        <?php if($_SESSION['role'] ==3 || $_SESSION['role'] == 2) {?>
                        <div class="col-md-6 col-sm-12 col-xs-12">
                            <div class="panel panel-back noti-box">
                                <span class="icon-box bg-color-blue">
                                    <i class="fa fa-warning"></i>
                                </span>
                                <div class="text-box">
                                    <p class="main-text">
                                        <?php
                                        // $sql = "SELECT * FROM `clearance_list` where office = $office";
                                        // $result = approvedClearance($office, "");
                                        // $result = mysqli_query($conn, $sql);
                                        echo $no_of_approved + $no_of_not_approved;
                                        ?> Clearances are Available </p>
                                    <p class="text-muted">Add Clearances and View Details Here</p>
                                    <a href="./addClerance.php" class="btn btn-primary"><i class="fa fa-edit "></i> Add Clearances</a>
                                    <?php
                                    if ($_SESSION['role'] == 3) {
                                        echo "<a href='./clearanceList.php' class='btn btn-warning'><i class='fa fa-pencil'></i> View Clearance List</a>  ";
                                    }
                                    ?>
                                        <a href="./materials.php" class="btn btn-success"><i class="fa fa-edit "></i> View Materials</a>
                                        </td>
                                        <hr />
                                        <p class="text-muted">
                                            <span></span>
                                        </p>
                                </div>
                            </div>
                        </div>
                        <?php }?>
                        <!-- Admins Only -->
                        <div class="col-md-6 col-sm-12 col-xs-12">
                            <div class="panel back-dash">
                                <i class="fa fa-tasks fa-3x"></i><strong> &nbsp; Todo List</strong>

                                <?php
                                $office = $_SESSION['office_id'];
                                $user_id =  $_SESSION['id'];
                                // echo $office;
                                $sql = "SELECT * FROM `todos` where office = $office and `incharge` = $user_id ";
                                $result = mysqli_query($conn, $sql);
                                $remaning = $result->num_rows;
                                if ($result->num_rows > 0) {
                                    $count = 0;
                                    while ($row = mysqli_fetch_assoc($result)) {
                                ?>
                                    <div class="row" style="background-color: whitesmoke; margin:5px 5px;border-radius:5px; color:black;">
                                        <div class="col-sm-3" >
                                            <p style="color: black;">
                                                <?php echo $row['content'] ?> 
                                            </p>

                                        </div>
                                        <div class="col-sm-3">

                                            <p style="color: black;">
                                                <?php
                                                if ($row['completed'] == 0) {
                                                    echo "Ongoing Task!";
                                                } else {
                                                    echo "Comleted Task!";
                                                }
                                                ?>
                                            </p>
                                        </div>
                                        <div class="col-sm-3">
                                            <p style="color: black;">
                                                <?php echo "Date:" . $row['date'] ?> </p>
                                        </div>
                                        <form action="" method="POST">
                                            <input class="form-control" name="id" type="hidden" value="<?php echo $row['id'] ?>" />
                                            <input class="form-control" name="state" type="hidden" value="<?php echo $row['completed'] ?>" />
                                            <div class="col-sm-3" style="padding-top: 8px;">
                                                <?php

                                                    if ($row['completed'] == 0) {
                                                        echo "<button type='submit' name='todo' class='btn btn-warning btn-sm' >complete</button>";
                                                    } else {
                                                        echo "<button type='submit' name='todo' class='btn btn-info btn-sm' >Renew</button>";
                                                    }
                                                    ?>
                                            </div>
                                            <button style="margin-left:15px;" type='submit' name='delete_todo' class='btn btn-danger btn-sm'>delete</button>
                                        </form>
                                    </div>
                                    <?php }
                                } ?>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12 col-xs-12 ">
                            <div class="panel ">
                                <div class="main-temp-back">
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-xs-6"> <i class="fa fa-cloud fa-3x"></i> Add todo </div>
                                            <div class="col-xs-6">
                                                <div class="text-temp">

                                                    <?php
                                                    $office = $_SESSION['office_id'];
                                                    $user_id =  $_SESSION['id'];
                                                    // echo $office;
                                                    $sql = "SELECT * FROM `todos` where office = $office and `incharge` = $user_id ";
                                                    $result = mysqli_query($conn, $sql);
                                                    $remaning = $result->num_rows;
                                                    echo $remaning . " " . "Tasks";

                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="panel panel-back noti-box">
                                <span class="icon-box bg-color-green set-icon">
                                    <i class="fa fa-tasks"></i>
                                </span>
                                <div class="text-box">
                                    <!-- Add Task -->
                                    <form action="" method="POST">
                                        <div class="form-group">

                                            <textarea class="form-control" name="content" type="text" placeholder="task content" rows="2"></textarea>

                                        </div>
                                        <button name="add_todo" type="submit" class="btn btn-primary">Add Task</button>
                                    </form>
                                    <!-- Add Task -->
                                </div>
                            </div>

                        </div>
                        <!-- Send Message -->

                        <div class="col-md-6 col-sm-12 col-xs-12 shadow-lg">
                            <div class="panel ">
                                <div class="main-temp-back">
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-xs-6"> <i class="fa fa-cloud fa-3x"></i> Send Message </div>
                                            <div class="col-xs-6">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-back noti-box">
                                <span class="icon-box bg-color-red set-icon">
                                    <i class="fa fa-envelope-o"></i>
                                </span>
                                <div class="text-box">
                                    <!-- Send -->
                                    <form action="" method="POST">

                                        <div class="form-group">
                                            <label>Select Reciver</label>
                                            <select class="form-control" name="reciver">

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
                                        <div class="form-group">

                                            <textarea name="cont" id="" cols="63" rows="5"></textarea>
                                        </div>
                                        <button name="sendM" type="submit" class="btn btn-primary">Send Message</button>
                                    </form>
                                    <!-- Send -->
                                </div>
                            </div>

                        </div>
                        <!-- Send Message -->

                    </div>
                    <!-- /. ROW  -->
                    <!-- Admins Only -->
                    <div class="row col-md-12 col-sm-12 col-xs-12">

                        <?php if($_SESSION['role'] ==3 || $_SESSION['role'] == 2) {?>

                        <section id="remaining-clearance">

                            <div class="panel panel-default">
                                <?php include_once './includes/cListView.php'; ?>
                            </div>
                    </div>
                    </section>
                    <?php }?>
                    <!-- Admins Only -->
                </div>
            </div>
            <!-- /. ROW  -->
            <div class="row">
                <!-- here notification -->
                <!-- Admins Only -->
                <?php if($_SESSION['role'] ==3 || $_SESSION['role'] == 2) {?>

                <div class="col-md-12 col-sm-12 col-xs-12">

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Approved Clearances
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
                                                <th>Super Admin Approval Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <form action="" method="POST">
                                                <?php
                                                $office = $_SESSION['office_id'];
                                                // $sql = "SELECT * FROM `clearance_list` where office = $office and `approved` = 1 ";
                                                // $result = mysqli_query($conn, $sql);
                                                $result = approvedClearance($office, 1);
                                                // echo $result;
                                                if (count($result) > 0) {
                                                    $count = 0;
                                                    foreach($result as $row) {
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
                                                        <td><a href="./updateClearance.php?id=<?php echo $row['id'] ?>" style="margin:5px 15px;" name="update" class="btn btn-default"><i class=" fa fa-refresh "></i> Update</a><button name="view_detail_1" type="submit"
                                                                class="btn btn-primary"><i class="fa fa-edit "></i> View Detail</button> <button name="dis_approve" type="submit" class="btn btn-danger"><i class="fa fa-edit "></i>disApprove</button>
                                                            <button class="btn<?php
                                                if ($row['completed'] == 0) {
                                                    echo " btn-warning ";
                                                } else {
                                                    echo "btn-primary ";
                                                }
                                                ?>"><i class="fa fa-check"></i>
                                                                <?php
                                                                    if ($row['completed'] == 0) {
                                                                        echo "Pending";
                                                                    } else {
                                                                        echo "Completed";
                                                                    }
                                                                    ?></button>
                                                        </td>
                                                    </tr>
                                                    <?php }
                                                } ?>
                                            </form>
                                        </tbody>
                                    </table>
                                </div>
                                <!--  -->
                            </div>
                        </div>
                    </div>
                </div>
                <?php }?>
            </div>
            <!-- /. ROW  -->
            <div class="row">
                <!-- Admins Only -->
                <?php if($_SESSION['role'] == 3 || $_SESSION['role'] == 2) {?>
                <div class="col-md-6 col-sm-12 col-xs-12">
                    <div class="chat-panel panel panel-default chat-boder chat-panel-head" style="margin:20px auto; ">
                        <div class="panel-heading">
                            <i class="fa fa-comments fa-fw"></i> Some Feedbacks From users For You
                            <div class="btn-group pull-right">

                                <ul class="dropdown-menu slidedown">
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-refresh fa-fw"></i>Refresh
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-check-circle fa-fw"></i>Available
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-times fa-fw"></i>Busy
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-clock-o fa-fw"></i>Away
                                        </a>
                                    </li>
                                    <li class="divider"></li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-sign-out fa-fw"></i>Sign Out
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="panel-body">
                            <ul class="chat-box">
                                <?php
                                $my_of = $_SESSION['office_id'];
                                $result = feedbacks($my_of);
                                if (count($result) > 0) {
                                    foreach($result as $row) {
                                ?>
                                    <li class="left clearfix">
                                        <span class="chat-img pull-left">
                                                <img src="../img/3.png" alt="User" class="img-circle" />
                                            </span>
                                        <div class="chat-body clearfix">

                                            <strong><?php
                                                        $user = $row['from_user'];
                                                        $fn = findUser($user);
                                                        echo  $fn['full_name'] ?></strong>
                                            <small class="pull-right text-muted">
                                                    <i class="fa fa-clock-o fa-fw"></i><?php echo $row['date'] ?></small>
                                            <p>
                                                <?php echo  $row['content'] ?>
                                            </p>
                                        </div>
                                    </li>
                                    <?php  }
                                } ?>
                            </ul>
                        </div>
                    </div>
                    <?php }?>
                    <!-- Admins Only -->
                </div>
                <div class="col-md-6 col-sm-12 col-xs-12">
                    <di class="row">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                My Clearances
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
                                                    <th>Super Admin Approval Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <form action="" method="POST">
                                                    <?php
                                                    $id = $_SESSION['id'];
                                                    // echo $office;
                                                    $sql = "SELECT * FROM `clearance_list` where clearance_owner = $id";
                                                    $result = mysqli_query($conn, $sql);

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
                                                            <td>
                                                                <?php
                                                                    if ($row['completed'] == 0 || $row['approved'] == 0) {
                                                                        echo "<button class='btn btn-success btn-sm disabled'><i class='fa fa-edit'></i> Incomplete </button>";
                                                                    }
                                                                    ?>
                                                            </td>
                                                        </tr>
                                                        <?php }
                                                    } ?>

                                                </form>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="row shadow" style="background-color: whitesmoke;">
                    <div class="col-md-6 col-sm-12 col-xs-12 shadow" style="margin:20px auto; background-color:whitesmoke;max-height:300px;overflow:scroll;padding:20px auto;">
                        <div class="chat-panel panel panel-default chat-boder chat-panel-head" style="max-height: 300px;">
                            <div class="panel-heading">
                                <i class="fa fa-comments fa-fw"></i> Messages
                            </div>
                            <div class="panel-body" style="background-color: #fff;">
                                <ul class="chat-box">
                                    <?php
                                    $my_of = $_SESSION['id'];
                                    $sql = "SELECT * FROM `message` where to_user = $my_of ";
                                    $resultx = mysqli_query($conn, $sql);
                                    if ($resultx->num_rows) {
                                        while ($rm = mysqli_fetch_assoc($resultx)) {
                                    ?>
                                        <li class="left clearfix">
                                            <span class="chat-img pull-left">
                                                    <img src="../img/3.png" alt="User" class="img-circle" />
                                                </span>
                                            <div class="chat-body clearfix">
                                                <strong><?php
                                                            $of = $rm['sender'];
                                                            $sql = "SELECT * FROM `users` where id = $of";
                                                            $result = mysqli_query($conn, $sql);
                                                            $fn = mysqli_fetch_assoc($result);
                                                            echo  $fn['full_name'] ?></strong>
                                                <small class="pull-right text-muted">
                                                        <i class="fa fa-clock-o fa-fw"></i><?php echo $rm['date'] ?></small>
                                                <p>
                                                    <?php echo  $rm['content'] ?>
                                                </p>
                                            </div>
                                        </li>
                                        <?php  }
                                    } ?>

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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