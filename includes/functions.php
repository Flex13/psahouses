<?php include('class/DB.class.php');?>
<?php include('class/redirect.php');?>
<?php include('class/login.class.php');?>
<?php include('class/validations.class.php');?>
<?php include('class/status-updates.class.php'); ?>
<?php
function current_date() {
        $date = new DateTime();
        return $date->format('Y/m/d/H:i:s');
    }
?>