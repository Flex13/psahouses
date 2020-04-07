<?php

class Login
{

    public static function isLoggedIn()
    {

        if (isset($_COOKIE['SNID'])) {
            if (DB::query('SELECT user_id FROM login_tokens WHERE token=:token', array(':token' => sha1($_COOKIE['SNID'])))) {
                $user_id = DB::query('SELECT user_id FROM login_tokens WHERE token=:token', array(':token' => sha1($_COOKIE['SNID'])))[0]['user_id'];

                if (isset($_COOKIE['SNID_'])) {
                    return $user_id;
                } else {
                    $cstrong = True;
                    $token = bin2Hex(openssl_random_pseudo_bytes(64, $cstrong));
                    DB::query('INSERT INTO login_tokens VALUES (\'\', :token, :user_id)', array(':token' => sha1($token), ':user_id' => $user_id));
                    DB::query('DELETE FROM login_tokens WHERE token=:token', array(':token' => sha1($_COOKIE['SNID'])));

                    setcookie("SNID", $token, time() + 60 * 60 * 24 * 7, '/', NULL, NULL, TRUE);
                    setcookie("SNID_", '1', time() + 60 * 60 * 24 * 3, '/', NULL, NULL, TRUE);

                    return $user_id;
                }
            }
        }
        return false;
    }

    public static function LoginUser()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            global $success, $errors,  $email;

            $email = $_POST['email'];
            $password = $_POST['password'];

            if (DB::query('SELECT email FROM users WHERE email=:email', array(':email' => $email))) {

                if (password_verify($password, DB::query('SELECT password from users WHERE email=:email', array(':email' => $email))[0]['password'])) {
                    $cstrong = True;
                    $token = bin2Hex(openssl_random_pseudo_bytes(64, $cstrong));
                    $user_id = DB::query('SELECT user_id FROM users WHERE email=:email',  array(':email' => $email))[0]['user_id'];
                    $user_ip = DB::query('SELECT ip FROM users WHERE email=:email',  array(':email' => $email))[0]['ip'];
                    DB::query('INSERT INTO login_tokens VALUES (\'\', :token, :user_id)', array(':token' => sha1($token), ':user_id' => $user_id));
                    setcookie("SNID", $token, time() + 60 * 60 * 24 * 7, '/', NULL, NULL, TRUE);
                    setcookie("SNID_", '1', time() + 60 * 60 * 24 * 3, '/', NULL, NULL, TRUE);
                    array_push($success, "Logged In!");
                    Redirect::redirect_to("../index.php");
                } else {
                    array_push($errors, "Incorrect Password.");
                }
            } else {
                array_push($errors, "User Does not Exist!");
            }
        }
    }

    public static function RegisterUser()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            global $success, $errors,  $email;

            $username           = $_POST['username'];
            $gender           = $_POST['gender'];
            $country           = $_POST['country'];
            $email              = $_POST['email'];
            $password           = $_POST['password'];
            $usertype           = 'student';





            if (!DB::query('SELECT username FROM users WHERE username=:username', array(':username' => $username))) {

                if (!DB::query('SELECT email FROM users WHERE email=:email', array(':email' => $email))) {

                    if (strlen($username) >= 3 && strlen($username) <= 32) {

                        if (preg_match('/[a-zA_Z0-9_]+/', $username)) {

                            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

                                if (strlen($password) >= 6 && strlen($password) <=  60) {

                                    if (!empty($country)) {

                                        if (!empty($country)) {

                                            $ip = get_ip();
                                            $today_date = current_date();



                                            DB::query('INSERT INTO users VALUES (\'\', :username,:email,:gender,:country,:password, :user_type,:ip, :register_date)', array(':username' => $username, ':gender' => $gender, ':country' => $country, ':email' => $email, ':password' => password_hash($password, PASSWORD_BCRYPT), ':user_type' => $usertype, ':ip' => $ip, ':register_date' => $today_date));
                                            Mail::sendMail('Welcome to PSA Community Network!', 'Your account has been created!', $email);
                                            array_push($success, "Success - Account Created. Please login");
                                        } else {
                                            array_push($errors, "Please select province");
                                        }
                                    } else {
                                        array_push($errors, "Invalid Password!");
                                    }
                                } else {
                                    array_push($errors, "invalid email!");
                                }
                            } else {
                                array_push($errors, "Invalid Username");
                            }
                        } else {
                            array_push($errors, "Invalid username");
                        }
                    } else {
                        array_push($errors, "Email already exists");
                    }
                } else {
                    array_push($errors, "User Already exists");
                }
            }
        }
    }

    public static function ChangePasswordUser()
    {

        $tokenIsValid = False;
        if (Login::isLoggedIn()) {

            if (isset($_POST['changepassword'])) {

                $oldpassword = $_POST['oldpassword'];
                $newpassword = $_POST['newpassword'];
                $newpasswordrepeat = $_POST['newpasswordrepeat'];
                $user_id = Login::isLoggedIn();

                if (password_verify($oldpassword, DB::query('SELECT password from users WHERE user_id=:user_id', array(':user_id' => $user_id))[0]['password'])) {

                    if ($newpassword == $newpasswordrepeat) {

                        if (strlen($newpassword) >= 6 && strlen($newpasswordrepeat) <=  60) {

                            DB::query('UPDATE users SET password=:newpassword WHERE user_id=:user_id', array(':newpassword' => password_hash($newpassword, PASSWORD_BCRYPT), ':user_id' => $user_id));
                            array_push($success, "Password Changed Successfully");
                        }
                    } else {
                        array_push($errors, "Passwords don't match");
                    }
                } else {
                    array_push($errors, "Incorrect Old Password");
                }
            }
        } else {

            if (isset($_GET['token'])) {
                $token = $_GET['token'];
                if (DB::query('SELECT user_id FROM password_tokens WHERE token=:token',  array(':token' => sha1($token)))) {
                    $user_id = DB::query('SELECT user_id FROM password_tokens WHERE token=:token',  array(':token' => sha1($token)))[0]['user_id'];
                    $tokenIsValid = True;
                    if (isset($_POST['changepassword'])) {

                        $newpassword = $_POST['newpassword'];
                        $newpasswordrepeat = $_POST['newpasswordrepeat'];


                        if ($newpassword === $newpasswordrepeat) {

                            if (strlen($newpassword) >= 6 && strlen($newpasswordrepeat) <=  60) {

                                DB::query('UPDATE users SET password=:newpassword WHERE user_id=:user_id', array(':newpassword' => password_hash($newpassword, PASSWORD_BCRYPT), ':user_id' => $user_id));
                                array_push($success, "Password Changed Successfully");

                                DB::query('DELETE FROM password_tokens WHERE user_id=:user_id', array('user_id' => $user_id));
                                Redirect::redirect_to("login.php");
                            }
                        } else {
                            array_push($errors, "Passwords don't match");
                        }
                    }
                } else {
                    array_push($errors, "Token Invalid");
                }
            } else {
                array_push($errors, "Please Login");
                Redirect::redirect_to("login.php");
            }
        }
    }

    public static function LogoutUser() {
        if (!self::isLoggedIn()) {
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
    }
}
