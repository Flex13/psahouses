<?php $page_title = 'PSA Houses - Logout '; ?>
<?php include('includes/header.php'); ?>
<?php
if (!Login::isLoggedIn()) {
    array_push($errors, "Please Login First");
    Redirect::redirect_to("login.php");
}

if (isset($_POST['confirm'])) {

    if (isset($_POST['alldevices'])) {
        DB::query('DELETE FROM login_tokens WHERE user_id=:user_id', array(':user_id'=>Login::isLoggedIn()));
        Redirect::redirect_to("login.php");
    } else {
        if (isset($_COOKIE['SNID'])) {
        DB::query('DELETE FROM login_tokens WHERE token=:token', array(':token' => sha1($_COOKIE['SNID'])));
        Redirect::redirect_to("login.php");
        }
        setCookie('SNID', '1', time()-3600);
        setCookie('SNID_', '1', time()-3600);
        Redirect::redirect_to("login.php");
    }
}
?>

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
