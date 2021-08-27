<?php 
    //$identifier = ''; 
    include_once  './../pdo/controller.php';
?>
<nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
            <span class="sr-only"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="./index.php"><?php echo $_SESSION['user_role'] ?></a>
    </div>
    <div style="color: white; padding: 15px 50px 5px 50px; float: right; font-size: 16px;">
        <!-- <a style="margin-right: 25px;">
            <?php echo $_SESSION['office'] . '   '  ?> </a>  -->
            <a href="./logout.php" class="btn btn-danger square-btn-adjust">Logout</a>
    </div>
</nav>
<!-- /. NAV TOP  -->
<nav class="navbar-default navbar-side" role="navigation">
    <div class="sidebar-collapse">
    <ul class="nav" id="main-menu">
            <li class="text-center">
                <img src="../img/avatar.png" class="user-image img-responsive" height="" />
            </li>
            <li>
                <a class="<?php if($identifier == 'is_home') echo "active-menu"; ?>" href="./index.php"><i class="fa fa-dashboard fa-3x"></i>Home  </a>
            </li>
            <!-- Admins Only -->
            <?php if($_SESSION['role'] ==3 || $_SESSION['role'] == 2) {?>

            <li>
                <a class="<?php if($identifier == 'is_addClearance') echo "active-menu" ?>" href="./addClerance.php"><i class="fa fa-desktop fa-3x"></i>Add Clearances</a>
            </li>
            <li>
                <a class="<?php if($_SERVER["REQUEST_URI"] == '/clearance/pages/index.php#remaining-clearance') echo "active-menu" ?>" href="./index.php#remaining-clearance"><i class="fa fa-bar-chart-o fa-3x"></i> View Clearance</a>
            </li>
            <li>
                <!-- <a class="<?php if($_SERVER["REQUEST_URI"] == '/clearance/pages/updateClearance.php?id='.$id) echo "active-menu"; ?>" href="/clearance/pages/updateClearance.php?id=".$id><i class="fa fa-table fa-3x"></i>Update Clearances</a> -->
            </li>
            
            <li>
                <a class="<?php if($identifier == 'is_material') echo "active-menu" ?>" href="./materials.php"><i class="fa fa-square-o fa-3x"></i> Available Materials</a>
            </li><?php }?>
            <!-- Admins Only -->

            <li>
                <a class="<?php if($identifier == 'is_feedback') echo "active-menu" ?>" href="./sendFeedback.php"><i class="fa fa-comment fa-3x"></i>Send Feedback</a>
            </li>
        </ul>
    </div>
</nav>
<!-- /. NAV SIDE  -->