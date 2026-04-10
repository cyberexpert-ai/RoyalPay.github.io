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
    

<div class="container">

<section class="h-100 ">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-xl-10">
        <div class="card rounded-3 text-black">
          <div class="row g-0">
            <div class="col-lg-12">
              <div class="card-body p-md-5 mx-md-4">

                <div class="text-center">
                  <img src="assets/images/cxrlogo/logo.png" style="width: 185px;" alt="logo">
                  <h6 class="mt-1 mb-4 pb-1" style="color: #000; font-weight: bold;" >Start with your free account today</h6>
                </div>
  
  
  <?php
// Define the base directory constant
define('BASE_DIR', realpath(dirname(__FILE__)) . '/');
// Include the config.php file to load configuration settings
include BASE_DIR . 'config.php';
// Securely include other files using the BASE_DIR constant
include BASE_DIR . '../pages/dbFunctions.php';

if (isset($_POST['create'])) {
   
    $mobile = mysqli_real_escape_string($conn, $_POST['mobile']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    
    $checkMobileQuery = "SELECT * FROM `users` WHERE `mobile` = '$mobile'";
    $checkMobileResult = mysqli_query($conn, $checkMobileQuery);

    $checkEmailQuery = "SELECT * FROM `users` WHERE `email` = '$email'";
    $checkEmailResult = mysqli_query($conn, $checkEmailQuery);

    if (mysqli_num_rows($checkMobileResult) > 0) {
        echo '
        <script>
            Swal.fire({
                title: "Opps! Sorry Mobile Number Already Exist. Please use a different number",
                text: "Please Click Ok Button!!",
                confirmButtonText: "Ok",
                icon: "error"
            })
        </script>';
        exit;
    } elseif (mysqli_num_rows($checkEmailResult) > 0) {
        // The email already exists, display an error message
        echo '
        <script>
            Swal.fire({
                title: "Opps! Sorry Email Already Exist. Please use a different email",
                text: "Please Click Ok Button!!",
                confirmButtonText: "Ok",
                icon: "error"
            })
        </script>';
        exit;
    } else {  
        // Proceed with user registration
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $company = mysqli_real_escape_string($conn, $_POST['company']);
        

        $secret_key = generateRandomSecretKey();
        // Generate random instance_id, instance_secret, and merchant_id
        $instanceId = generateRandomInstanceId();
        $instanceSecret = generateRandomInstanceSecret();
        $merchantId = generateMerchantId(12);
        $key = md5(rand(00000000, 99999999));
        $pass = password_hash($password, PASSWORD_BCRYPT);
        $today = date("Y-m-d", strtotime("+3 days"));
        // Generate a random binary secret
$secret = random_bytes(10); // 80 bits
$encodedSecret = base32Encode($secret);
        
        $register = "INSERT INTO `users`(`name`, `mobile`, `password`, `email`, `company`, `user_token`, `expiry`, `instance_id`, `instance_secret`, `merchant_id`, `totp_secret`, `secret_key`) 
    VALUES ('$name', '$mobile', '$pass', '$email', '$company', '$key', '$today', '$instanceId', '$instanceSecret', '$merchantId', '$encodedSecret', '$secret_key')";


        $result = mysqli_query($conn, $register);
      
        if ($result) {
            echo '
            <script>
                Swal.fire({
                    title: "Registration Successful!!",
                    text: "Please Click Ok Button!!",
                    confirmButtonText: "Ok",
                    icon: "success"
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "index"; // Replace with your desired redirect URL
                    }
                });
            </script>';
            exit;
        } else {
            echo '
            <script>
                Swal.fire({
                    title: "Registration Failed!!",
                    text: "Please Click Ok Button!!",
                    confirmButtonText: "Ok",
                    icon: "error"
                })
            </script>';
            exit;
        }
    }
}
?>


  
  
  
                <form class="row mb-4" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
      <div class="col-md-6 mb-2">
  <label class="form-label"  style="color: #000; font-weight: bold;" >Mobile Number</label>
  <input type="text" name="mobile" placeholder="Enter Mobile Number" class="form-control"
         oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 10);" required />
</div>

    <div class="col-md-6 mb-2"><label>Password</label> <input type="password" name="password" placeholder="Enter Password" class="form-control" required="" /></div>
  
    <div class="col-md-6 mb-2">
  <label class="form-label"  style="color: #000; font-weight: bold;" >Email Address</label>
  <input type="email" name="email" placeholder="Enter Email Address" class="form-control" required />
</div>

    <div class="col-md-6 mb-2"><label class="form-label"  style="color: #000; font-weight: bold;" >Name</label> <input type="text" name="name" placeholder="Enter Name" class="form-control" required="" /></div>
    <div class="col-md-6 mb-2"><label class="form-label"  style="color: #000; font-weight: bold;">Company Name</label> <input type="text" name="company" placeholder="Enter Company Name" class="form-control" required="" /></div>
    <div class="col-md-6 mb-2"><label class="form-label"  style="color: #000; font-weight: bold;">Website Url</label> <input type="text" name="weburl" placeholder="Enter Website Url" class="form-control" required="" /></div>
    

  

    <div class="col-md-12 mb-2 mt-2"><button type="submit" name="create" class="btn btn-primary btn-sm btn-block">Register</button>
    </div>
<div class="col-md-12 mb-2">
<div class="d-flex align-items-center justify-content-center mt-2">
  <p class="mb-0 mr-2">Already have an account?</p>
  <a href='index' style="color: #000; font-weight: bold;" class="btn btn-outline-danger btn-sm" >Login</a>
</div>
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



<script src="assets/js/core/jquery.3.2.1.min.js"></script>
<script src="assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
<script src="assets/js/core/popper.min.js"></script>
<script src="assets/js/core/bootstrap.min.js"></script>
<script src="assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>
<script src="assets/js/plugin/bootstrap-toggle/bootstrap-toggle.min.js"></script>
<script src="assets/js/plugin/jquery-mapael/jquery.mapael.min.js"></script>
<script src="assets/js/plugin/jquery-mapael/maps/world_countries.min.js"></script>
<script src="assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>
<script src="assets/js/ready.min.js"></script>


<!-- Mirrored from upigetway.com/auth/register by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 19 Oct 2023 17:52:40 GMT -->
</html>			