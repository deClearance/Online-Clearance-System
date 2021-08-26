<div class="row">
    <div class="col-md-12">
        <h2>Admin <?php echo $_SESSION['office'] . '   '  ?> Dashboard</h2>
    </div>    
</div>
<?php if (isset($_GET['error'])) { ?>
<div class="message">
    <h5>
        <p class="error"><?php echo $_GET['error']; ?></p>
    </h5>
</div>
<?php } ?>