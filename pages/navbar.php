<?php //$identifier = ''; ?>
<!-- /. NAV TOP  -->
<nav class="navbar-default navbar-side" role="navigation">
    <div class="sidebar-collapse">
    <ul class="nav" id="main-menu">
            <li class="text-center">
                <img src="../img/find_user.png" class="user-image img-responsive" />
            </li>
            <li>
                <a class="<?php if($identifier == 'is_home') echo "active-menu"; ?>" href="./index.php"><i class="fa fa-dashboard fa-3x"></i>Home</a>
            </li>
            <!-- Admins Only -->
            <?php if($_SESSION['role'] ==3 || $_SESSION['role'] == 2) {?>

            <li>
                <a class="<?php if($identifier == 'is_addClearance') echo "active-menu" ?>" href="./addClerance.php"><i class="fa fa-desktop fa-3x"></i>Add Clearances</a>
            </li>
            <li>
                <a class="<?php if($identifier == '') echo "active-menu" ?>" href="./index.php#remaining-clearance"><i class="fa fa-bar-chart-o fa-3x"></i> View Clearance Details</a>
            </li>
            <li>
                <a class="<?php if($identifier == 'is_updateClearance') echo "active-menu" ?>" href="./index.php"><i class="fa fa-table fa-3x"></i>Update Clearances</a>
            </li>
            
            <li>
                <a class="<?php if($identifier == 'is_material') echo "active-menu" ?>" href="./materials.php"><i class="fa fa-square-o fa-3x"></i> Available Materials</a>
            </li><?php }?>
            <!-- Admins Only -->

            <li>
                <a class="<?php if($identifier == 'is_feedback') echo "active-menu" ?>" href="./sendFeedback.php"><i class="fa fa-qrcode fa-3x"></i>sendFeedback</a>
            </li>
        </ul>
    </div>
</nav>
<!-- /. NAV SIDE  -->