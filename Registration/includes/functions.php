
<?php include('class/DB.class.php');?>
<?php include('class/validations.class.php');?>
<?php include('class/redirect.php');?>
<?php include('class/mail.class.php');?>
<?php

        function get_ip() {
        $ip = $_SERVER['REMOTE_ADDR'];
        if (validate_ip($ip)) {
            return $ip;
        }
    }

    function validate_ip($ip) {

        if (filter_var($ip, FILTER_VALIDATE_IP) || filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) {
            //FOR Ip VERSON 4 AND IP VERSION 6
            RETURN TRUE;
        }
    }

    function current_date() {
        $date = new DateTime();
        return $date->format('Y/m/d/H:i:s');
    }

    ?>