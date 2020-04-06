<?php

class UserClass {

    public $username;
    public $errors = [];
    private $conn;

    public function __construct() {
        $this->conn = new mysqli("localhost", "root", "", "psahouses2");
    }

    public function display_error(){
        global $errors;

	if (count($errors) > 0){
		echo '<div class="error">';
			foreach ($errors as $error){
				echo $error .'<br>';
			}
		echo '</div>';
	}

    }

    public function register($username, $email,$gender,$country, $password) {



        if (empty($username) || empty($email) || empty($password) || empty($gender) || empty($country)) {
            array_push($errors, "all the fields are required");
        } else if ($this->check_user($username, $email) == 1) {
            array_push($errors, "Username & email already exists");
        } else if ($this->valid_email($email) == FALSE) {
            array_push($errors, "Emal address is not valid");
        } else if ($this->check_paasword($password) == false) {
            return FALSE;
        } else {
            //store data in database
            $today_date = $this->current_date();
            $ip = $this->get_ip();
            $password = $this->secure_hash($password);

            //insert query
            $this->conn->query("INSERT INTO `users`( `username`, `email` , `gender`, `country`,`passsword`,`user_type`, `register_date`, `ip` ) VALUES( '$username','$email','$gender','$country','$password','student','$today_date','$ip' )");

            array_push($success, "<h1>Thank you $username Registration Done , Now you can go for login <a href='login.php'>Login</h1>");
        }
    }

    public function check_user($username, $email) {
        $result = $this->conn->query("SELECT COUNT(user_id) as total FROM users WHERE username = '$username' AND email = '$email' LIMIT 1");
        while ($row = $result->fetch_assoc()) {
            return $row['total'];
        }
    }

    public function valid_email($email) {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return TRUE;
        }
    }

    public function check_paasword($password) {
        if (strlen($password) < 8) {
            array_push($errors, "password is too short");
        } else if (!preg_match("#[0-9]+#", $password)) {

            array_push($errors, "password must include at least one number");
        } else if (!preg_match("#[a-zA-Z]+#", $password)) {
            array_push($errors, "Password includes at least one latter");
        } else {
            return TRUE;
        }
    }

    public function get_ip() {
        $ip = $_SERVER['REMOTE_ADDR'];
        if ($this->validate_ip($ip)) {
            return $ip;
        }
    }

    public function validate_ip($ip) {

        if (filter_var($ip, FILTER_VALIDATE_IP) || filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) {
            //FOR Ip VERSON 4 AND IP VERSION 6
            RETURN TRUE;
        }
    }

    public function current_date() {
        $date = new DateTime();
        return $date->format('Y/m/d/H:i:s');
    }

    public function secure_hash($password) {
        $secure = password_hash($password, PASSWORD_DEFAULT);
        return $secure;
    }

    public function login($username, $password) {

        $query = $this->conn->query("SELECT COUNT(id) as total , username, passsword FROM signup WHERE (username = '$username' OR email = '$username') LIMIT 1");
        while ($row = $query->fetch_assoc()) {
            
            //passwrod + input password and second password is from database
           if($row['total']  == 1 && $this->verify_password($password ,$row['passsword']) == TRUE){
               $_SESSION['usernme'] = $row['username'];
               header("Location:dashboard.php");
           }
        }
    }
    
    
    public function verify_password($password, $pass_from_database){
        if(password_verify($password, $pass_from_database)){
            return TRUE;
        }
    }
    

}
