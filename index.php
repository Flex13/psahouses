<?php $page_title = 'PSA Houses - Home '; ?>
<?php include('includes/indexheader.php'); ?>
<?php
if (!Login::isLoggedIn()) {
  Redirect::redirect_to("registration/login.php");
  array_push($errors, "Please Login First");
}
?>

<a href='registration/logout.php' class='login-links'>Logout</a><br><br>



<?php include('includes/indexfooter.php'); ?>
