<?php
error_reporting(0);
ini_set('display_errors', 1);
session_start();

// Define the base directory constant
define('BASE_DIR', realpath(dirname(__FILE__)) . '/');
// Include the config.php file to load configuration settings
include BASE_DIR . "config.php";

if (isset($_POST['submit'])) {
    echo "Form submitted<br>";
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $query = "SELECT * FROM users WHERE mobile = '$username'";
    $run = mysqli_query($conn, $query);

    if (!$run) {
        die("Query failed: " . mysqli_error($conn));
    }

    $row = mysqli_fetch_array($run);

    if (mysqli_num_rows($run) > 0) {
        
        $hashFromDatabase = $row['password'];
        $acc_lock = $row['acc_lock'];
        $acc_ban = $row['acc_ban'];
        $byteuserid = $row['id'];
        $cxrtotp_user = $row['totp_user'];
        $cxrtotp_secret = $row['totp_secret'];
        $CXrcompanyname = $row['company'];
        $cxrtheme = $row['theme'];

        if ($acc_ban == 'on') {
            echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
            echo '<script>Swal.fire({title: "Account Locked!", text: "Please contact the administrator.", icon: "error", confirmButtonText: "Ok"}).then((result) => { if (result.isConfirmed) { window.location.href = "index"; }});</script>';
            exit;
        }
        if ($acc_lock >= 3) {
            echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
            echo '<script>Swal.fire({title: "Account Locked!", text: "Too many failed login attempts. Please contact the administrator.", icon: "error", confirmButtonText: "Ok"}).then((result) => { if (result.isConfirmed) { window.location.href = "index"; }});</script>';
            exit;
        }

        if (password_verify($password, $hashFromDatabase)) {
            $_SESSION['username'] = $username;
            $_SESSION['user_id'] = $byteuserid;
            $_SESSION['company_name'] = $CXrcompanyname;
            $_SESSION['theme'] = $cxrtheme;

            $query = "UPDATE users SET acc_lock = 0 WHERE mobile = '$username'";
            mysqli_query($conn, $query);

            echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
            echo '<script>
                Swal.fire({
                    icon: "success",
                    title: "Login Successful",
                    text: "You will be redirected shortly.",
                    showConfirmButton: false,
                    timer: 2000
                }).then(() => {
                    window.location.href = "dashboard";
                });
            </script>';
            exit;

        } else {
            $acc_lock++;
            $query = "UPDATE users SET acc_lock = $acc_lock WHERE mobile = '$username'";
            mysqli_query($conn, $query);

            echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
            echo '<script>Swal.fire({title: "Invalid Password!", text: "Please try again.", icon: "error", confirmButtonText: "Ok"}).then((result) => { if (result.isConfirmed) { window.location.href = "index"; }});</script>';
            exit;
        }
    } else {
        echo "User not found<br>";
        echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
        echo '<script>Swal.fire({title: "Username Does not Exist!", text: "Please try again.", icon: "error", confirmButtonText: "Ok"}).then((result) => { if (result.isConfirmed) { window.location.href = "index"; }});</script>';
        exit;
    }
} else {
    
}
?>


<!DOCTYPE html>
<html>
<head>
    <html lang="en" data-bs-theme="dark">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>khilaadixpro</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <link rel="icon" href="assets/img/hdfc.png" type="image/*" />
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="assets/css/ready.css">
    <link rel="stylesheet" href="assets/css/demo.css">
    <link rel="stylesheet" href="../../rsms.me/inter/inter.css">
    <script type="text/javascript">if(window.history.replaceState){window.history.replaceState(null,null,window.location.href);}</script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<style>
body{
    font-family: 'Inter', sans-serif;
    background: linear-gradient(135deg, #1f4037, #99f2c8) !important;
    color: #fff;
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
}

a{
    text-decoration: none !important;
}   
.card {
    border-radius: 20px !important;
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(10px);
}

input.form-control {
    border-radius: 10px;
    background: rgba(255, 255, 255, 0.2);
    border: none;
    color: #fff;
}

input.form-control::placeholder {
    color: #e0e0e0;
}

.btn-primary {
    background: linear-gradient(135deg, #667eea, #764ba2);
    border: none;
    border-radius: 20px;
    padding: 10px 20px;
    font-size: 16px;
    transition: background 0.3s ease;
}

.btn-primary:hover {
    background: linear-gradient(135deg, #764ba2, #667eea);
}

.btn-outline-danger {
    border: 1px solid #f8b4b4;
    color: #f8b4b4;
    border-radius: 20px;
}

.btn-outline-danger:hover {
    background: #f8b4b4;
    color: #fff;
}

.card-body {
    padding: 2rem;
}

.text-muted {
    color: #ccc !important;
}

/* Mobile-specific styles */
@media (max-width: 768px) {
    .btn-primary {
        width: 100%;
        font-size: 14px;
        padding: 10px;
    }
}
</style>
<body>

<audio id="pageAudio" src="file.mp3" preload="auto"></audio>

<div class="container">

<section class="h-100 ">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-xl-6">
        <div class="card rounded-3 text-black">
          <div class="row g-0">
            <div class="col-lg-12">
              <div class="card-body p-md-5 mx-md-4">

                <div class="text-center">
                  <img src="assets/images/cxrlogo/logo.png" style="width: 185px;" alt="logo">
                  <h6 class="mt-4 mb-4 pb-1" style="color: #000; font-weight: bold;">Please login to your account.</h6>
                </div>

                <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                  <div class="form-outline mb-4">
                    <label class="form-label" style="color: #000; font-weight: bold;" for="username">Mobile Number</label>
                    <input type="text" id="username" name="username" class="form-control" placeholder="Enter Mobile Number" minlength="10" maxlength="10" oninput="this.value = this.value.replace(/[^0-9]/g, '');" required/>
                  </div>

                  <div class="form-outline mb-4">
                    <label class="form-label" style="color: #000; font-weight: bold;" for="password">Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Password" required/>
                  </div>

                  <div class="text-center pt-1 mb-2 pb-1">
                    <button class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3" type="submit" name="submit">Login</button>
                    <a class="text-muted" href="forgotpassword" style="color: #000; font-weight: bold;">Forgot password?</a>
                  </div>

                  <div class="d-flex align-items-center justify-content-center pb-4">
                    <p class="mb-0 mr-2" style="color: #000; font-weight: bold;">Don't have an account?</p>
                    <button type="button" class="btn btn-outline-danger btn-sm" onclick="location='register'" style="color: #000; font-weight: bold;">Register</button>
                  </div>
                </form>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

</div>
</body>
<script>
  // JavaScript to play the audio when the page loads
  window.onload = function() {
    var audio = document.getElementById('pageAudio');
    audio.play();
  };
</script>

<!--<script src="assets/js/core/jquery.3.2.1.min.js"></script>-->
<!--<script src="assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>-->
<!--<script src="assets/js/core/popper.min.js"></script>-->
<!--<script src="assets/js/core/bootstrap.min.js"></script>-->
<!--<script src="assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>-->
<!--<script src="assets/js/plugin/bootstrap-toggle/bootstrap-toggle.min.js"></script>-->
<!--<script src="assets/js/plugin/jquery-mapael/jquery.mapael.min.js"></script>-->
<!--<script src="assets/js/plugin/jquery-mapael/maps/world_countries.min.js"></script>-->
<!--<script src="assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>-->
<!--<script src="assets/js/ready.min.js"></script>-->

</html>
