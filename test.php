<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Hello, world!</title>
  </head>
  <body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Navbar</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Link</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Dropdown
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="#">Another action</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
  </div>
</nav>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>




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