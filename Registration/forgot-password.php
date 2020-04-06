<?php $page_title = 'PSA Houses Register '; ?>
<?php include('includes/header.php'); ?>

<?php

if (isset($_POST['resetpassword'])) {

$cstrong = True;
$token = bin2Hex(openssl_random_pseudo_bytes(64, $cstrong));
$email = $_POST['email'];
$user_id = DB::query('SELECT user_id FROM users WHERE email=:email',  array(':email'=>$email))[0]['user_id'];
DB::query('INSERT INTO password_tokens VALUES (\'\', :token, :user_id)', array(':token' => sha1($token), ':user_id' => $user_id));
Mail::sendMail('Forgot Password!', " Click Here to Reset Your Password <br><br><a href='http://localhost:8080/registration/change-password.php?token=$token'>Reset Password</a>", $email);
array_push($success, "Email Sent. Check your Inbox");
}
?>






<section class="container card-show">
    <div class="row card-row">


        <div class="card card-spacing">

            <div class="col-12">

                <div class="row text-center">

                    <div class="col-xs-12 col-md-12 col-lg-12">
                        <h3 class="text-center text-uppercase card-heading">Forgot Your Password?</h3>
                        <form class="" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <?php echo display_error(); ?>
                        <?php echo display_success(); ?>
                            <div class="form-group">
                                <label class="form-label">Email</label>
                                <div class="input-group mb-3">
                                    <input type="email" name="email" size="30" maxlength="60" class="form-control"
                                        placeholder="Enter your email"
                                        value="<?php if (isset($trimmed['email'])) echo $trimmed['email']; ?>"
                                        title="The domain portion of the email address is invalid (the portion after the @)."
                                        pattern="^([^\x00-\x20\x22\x28\x29\x2c\x2e\x3a-\x3c\x3e\x40\x5b-\x5d\x7f-\xff]+|\x22([^\x0d\x22\x5c\x80-\xff]|\x5c[\x00-\x7f])*\x22)(\x2e([^\x00-\x20\x22\x28\x29\x2c\x2e\x3a-\x3c\x3e\x40\x5b-\x5d\x7f-\xff]+|\x22([^\x0d\x22\x5c\x80-\xff]|\x5c[\x00-\x7f])*\x22))*\x40([^\x00-\x20\x22\x28\x29\x2c\x2e\x3a-\x3c\x3e\x40\x5b-\x5d\x7f-\xff]+|\x5b([^\x0d\x5b-\x5d\x80-\xff]|\x5c[\x00-\x7f])*\x5d)(\x2e([^\x00-\x20\x22\x28\x29\x2c\x2e\x3a-\x3c\x3e\x40\x5b-\x5d\x7f-\xff]+|\x5b([^\x0d\x5b-\x5d\x80-\xff]|\x5c[\x00-\x7f])*\x5d))*(\.\w{2,})+$"
                                        autocomplete="on" required />

                                </div>
                            </div>

                            <input type="submit" name="resetpassword" class="btn btn-block mb-4" value="Reset Password">
                            <center>
                                <p class="form-label">Are You Registered?</p>
                                <a href='register.php' class='login-links'>Sign Up</a><br><br>
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