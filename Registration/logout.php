<?php $page_title = 'PSA Houses - Logout '; ?>
<?php include('includes/header.php'); ?>
<?php Login::LogoutUser() ?>

<section class="container card-show">
    <div class="row card-row">
            

                <div class="card card1 card-spacing">

                <div class="col-12" >
                
                <div class="row text-center">

                <div class="col-xs-12 col-md-12 col-lg-12">
                <h3 class="text-center text-uppercase" style="padding: 0">Logout?</h3>
                <p class="text-center">Are you sure you want to Logout?</p>
                    <form class="mt-3" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    
                        <div class="form-group">
                        <div class="input-group mb-3">
                        <input type="checkbox" name="alldevices"class="form-control" value=""> <br>Logout of all devices? 
                        
                        </div>
                        </div>  
                        <input type="submit" name="confirm" value="confirm" class="btn btn-block mb-4" value="Login">
                    </form>
                    </div>
                    

                    </div>

                    

                    
                </div>
            </div>
            </div>
    </section>

    <?php include('includes/footer.php'); ?>
