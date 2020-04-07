<?php $page_title = 'PSA Houses - Login'; ?>
<?php include('includes/header.php'); ?>

<?php Login::LoginUser(); ?>




<section class="container card-show">
    <div class="row card-row">


        <div class="card card-spacing">

            <div class="col-12">

                <div class="row text-center">

                    <div class="col-xs-12 col-md-12 col-lg-12">
                        <h3 class="text-center text-uppercase card-heading">Welcome Back</h3>
                        <form class="" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                            <?php echo display_error(); ?>
                            <?php echo display_success(); ?>
                            <div class="form-group">
                                <label class="form-label">Email</label>
                                <div class="input-group mb-3">
                                    <input type="text" name="email" size="30" maxlength="60" class="form-control" placeholder="Enter your email" value="<?php if (isset($trimmed['email'])) echo $trimmed['email']; ?>" title="The domain portion of the email address is invalid (the portion after the @)." pattern="^([^\x00-\x20\x22\x28\x29\x2c\x2e\x3a-\x3c\x3e\x40\x5b-\x5d\x7f-\xff]+|\x22([^\x0d\x22\x5c\x80-\xff]|\x5c[\x00-\x7f])*\x22)(\x2e([^\x00-\x20\x22\x28\x29\x2c\x2e\x3a-\x3c\x3e\x40\x5b-\x5d\x7f-\xff]+|\x22([^\x0d\x22\x5c\x80-\xff]|\x5c[\x00-\x7f])*\x22))*\x40([^\x00-\x20\x22\x28\x29\x2c\x2e\x3a-\x3c\x3e\x40\x5b-\x5d\x7f-\xff]+|\x5b([^\x0d\x5b-\x5d\x80-\xff]|\x5c[\x00-\x7f])*\x5d)(\x2e([^\x00-\x20\x22\x28\x29\x2c\x2e\x3a-\x3c\x3e\x40\x5b-\x5d\x7f-\xff]+|\x5b([^\x0d\x5b-\x5d\x80-\xff]|\x5c[\x00-\x7f])*\x5d))*(\.\w{2,})+$" autocomplete="on" required />

                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Password</label>
                                <input type="password" placeholder="Enter Password" name="password" size="20" maxlength="20" id="psswd" class="input-psswd form-control" value="<?php if (isset($trimmed['password'])) echo $trimmed['password']; ?>" autocomplete="on" psswd-shown="false" pattern="^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?!.*\s).*$" title="Please include at least 1 uppercase character, 1 lowercase character, and 1 number." required />
                                <button type="button" class="button-psswd ">Show Password</button>
                            </div>

                            <input type="submit" name="submit" class="btn btn-block mb-4" value="Login">
                            <center>
                                <p class="form-label">Are You Registered?</p>
                                <a href='register.php' class='login-links'>Sign Up</a><br><br>
                                <a href='forgot-password.php' class='login-links'>Forgot
                                    Password</a><br><br>
                                <a href='index.php' class='login-links'>Back to Home Page</a>
                            </center>
                        </form>
                    </div>


                </div>




            </div>
        </div>
    </div>
</section>

<?php include('includes/footer.php'); ?>