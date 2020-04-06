<?php

function validate($str) {
	return trim(htmlspecialchars($str));
}


function test_input($data)
    {
         $data = trim($data);
         $data = stripslashes($data);
         $data = htmlspecialchars($data);
         return $data;
    }

// Redirect to a new page
function redirect_to($new_location) {
    header("location:".$new_location);
    exit;
}

// return user array from their id
function getUserById($id){
	global $connect;
	$query = "SELECT * FROM users WHERE id='$id'";
	$result = mysqli_query($connect, $query);

	$user = mysqli_fetch_assoc($result);
	return $user;
}

//Error Messages 
$errors   = array(); 
function display_error() {
	global $errors;

	if (count($errors) > 0){
		echo '<div class="error">';
			foreach ($errors as $error){
				echo $error .'<br>';
			}
		echo '</div>';
	}
}

//Error Messages 
$success   = array(); 
function display_success() {
	global $success;

	if (count($success) > 0){
		echo '<div class="success">';
			foreach ($success as $success){
				echo $success .'<br>';
			}
		echo '</div>';
	}
}

// Error Messages 
function errorMessage() {

    if(isset($_SESSION["errorMessage"])) {
        $output = "<div class='alert  m-3 error text-center'>";
        $output .= htmlentities($_SESSION['errorMessage']);
        $output .= "</div>";
        $_SESSION["errorMessage"] = null;
        return $output;
    }
}

//Success Messages

function successMessage() {

    if(isset($_SESSION["successMessage"])) {
        $output = "<div class='alert m-3 success text-center'>";
        $output .= htmlentities($_SESSION['successMessage']);
        $output .= "</div>";
        $_SESSION["successMessage"] = null;
        return $output;
    }
}



//Check Email in Database if it Exists

function CheckEmail($email, $connect) {
    global $connect;

    $user_check_query = "SELECT * FROM users WHERE email='$email' LIMIT 1";
    $result = mysqli_query($connect, $user_check_query);
    $user = mysqli_fetch_assoc($result);
  
    if ($user) { // if user exists
      if ($user['email'] === $email) {
        return true;
      }
      else {
          return false;
      }

    }
}

//Check Username in Database if it Exists

function CheckUsername($username, $connect) {
    global $connect;

    $user_check_query = "SELECT * FROM users WHERE username='$username' LIMIT 1";
    $result = mysqli_query($connect, $user_check_query);
    $user = mysqli_fetch_assoc($result);
  
    if ($user) { // if user exists
      if ($user['username'] === $username) {
        return true;
      }
      else {
          return false;
      }

    }
}
// escape string
// escape string
function e($val){
	global $connect;
	return mysqli_real_escape_string($connect, trim($val));
}

?>