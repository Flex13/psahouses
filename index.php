<?php $page_title = 'PSA Houses - Home '; ?>
<?php include('includes/indexheader.php');   session_reset();?>

    <section class="container login">
    <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <?php echo display_error(); ?>
            <?php echo display_success(); ?>
            <p class="p-0 m-0" style="color:white">Online <span>Student Accommodation</span> Community</p>
            <h1 class="site-title">P<span>S</span>A </h1>
            <p style="color:white">Welcome to Private <span>Student</span> Accommodation Houses Hi <?php echo $_SESSION['user_id']; ?></p>
            <a href="community.php"><button class="land-button">Community</button></a>
            <a href="registration/register.php"><button class="land-button">Register</button></a>
            <a href="indexabout.php"><button class="land-button">About PSA Houses</button></a>
        </div>
    </div>
        
    </section>




<?php include('includes/indexfooter.php'); ?>
