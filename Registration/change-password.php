<?php $page_title = 'PSA Houses Register '; ?>
<?php include('includes/header.php'); ?>

<?php Login::ChangePasswordUser() ?>


<section class="container card-show">
    <div class="row card-row">


        <div class="card card-spacing">

            <div class="col-12">

                <div class="row text-center">

                    <div class="col-xs-12 col-md-12 col-lg-12">
                        <h3 class="text-center text-uppercase card-heading">Forgot Your Password?</h3>
                        <form class="" action="<?php if (!$tokenIsValid) {echo 'change-password.php';} else { echo 'change-password.php?token='.$token.'';} ?>" method="post">
                        <?php echo display_error(); ?>
                        <?php echo display_success(); ?>
                        <?php if (!$tokenIsValid) {
                                echo '
                                <div class="form-group">
                                <label class="label">Current Password</label>
                                <input type="password" placeholder="Current Password" name="oldpassword" size="20" maxlength="20" id="psswd" class="input-psswd form-control" psswd-shown="false" pattern="^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?!.*\s).*$" title="Please include at least 1 uppercase character, 1 lowercase character, and 1 number." required />
                            </div> ';
                            } ?>

                            <div class="form-group">
                                <label class="form-label">New Password</label>
                                    <input type="password" placeholder="New Password" name="newpassword" size="20" maxlength="20" id="psswd" class="input-psswd form-control" psswd-shown="false" pattern="^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?!.*\s).*$" title="Please include at least 1 uppercase character, 1 lowercase character, and 1 number." required />
                                <small>Please include at least 1 uppercase character, 1 lowercase character, and 1 number.</small>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Confirm Password</label>
                                <input type="password" placeholder="New Password" name="newpasswordrepeat" size="20" maxlength="20" id="psswd" class="input-psswd form-control" psswd-shown="false" pattern="^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?!.*\s).*$" title="Please include at least 1 uppercase character, 1 lowercase character, and 1 number." required />
                                <button type="button" class="button-psswd ">Show Password</button>
                            </div>

                            <input type="submit" name="changepassword" value="confirm" class="btn btn-block mb-4" value="Login">
                        </form>
                    </div>


                </div>




            </div>
        </div>
    </div>
</section>




<?php include('includes/footer.php'); ?>