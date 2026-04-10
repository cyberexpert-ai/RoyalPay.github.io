<?php
// PHP code
echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';

// Define the absolute path to the functions.php file
define('ABSPATH', dirname(__FILE__) . '/'); // Adjust the path as needed

require_once(ABSPATH . 'header.php');

require_once(ABSPATH . '../pages/dbFunctions.php');

// Initialize variables for API token and secret key
// Initialize variables for API token, secret key, and additional user information
$user_token = '';
$secret_key = '';
$callback_url = '';
$email = '';
$accountStatus = '';
$walletBalance = 0.00;
$totpUser = '';

// Retrieve the current API token, secret key, and additional user information from the database based on id
$userId = $_SESSION['user_id']; // Get the user's ID from the session
$sql = "SELECT user_token,secret_key, callback_url, email, acc_ban, company, totp_user FROM users WHERE id = ?";

// Prepare the SQL statement
$stmt = $conn->prepare($sql);

// Bind the user_id parameter
$stmt->bind_param("i", $userId);

// Execute the query
$stmt->execute();

// Bind the result to variables
$stmt->bind_result($user_token,$secret_key , $callback_url, $email, $accountStatus, $company, $totpUser);

// Fetch the result
$stmt->fetch();


// Close the statement
$stmt->close();
if (empty($callback_url)) {
    $callback_url = "No Webhook URL Is Set";
}

?>
<head>
    <!--favicon-->
    <link rel="icon" href="assets/images/favicon-32x32.png" type="image/png">

    <!--plugins-->
    <link href="assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="assets/plugins/metismenu/metisMenu.min.css">
    <link rel="stylesheet" type="text/css" href="assets/plugins/metismenu/mm-vertical.css">
    <link rel="stylesheet" type="text/css" href="assets/plugins/simplebar/css/simplebar.css">
    <!--bootstrap css-->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Material+Icons+Outlined" rel="stylesheet">
    <!--main css-->
    <link href="assets/css/bootstrap-extended.css" rel="stylesheet">
    <link href="sass/main.css" rel="stylesheet">
    <link href="sass/dark-theme.css" rel="stylesheet">
    <link href="sass/semi-dark.css" rel="stylesheet">
    <link href="sass/bordered-theme.css" rel="stylesheet">
    <link href="sass/responsive.css" rel="stylesheet">
  

</head>

<?php
if(isset($_POST['generate_token'])){
    
    
    $bbbyteuserid=$_SESSION['user_id'];
    // Assuming $mobile is already defined in header.php
    $sanitizedMobile = mysqli_real_escape_string($conn, $mobile);

    $uniqueNumber = mt_rand(1000000000, 9999999999);
    $uniqueNumber = str_pad($uniqueNumber, 10, '0', STR_PAD_LEFT); 

    $key = md5($uniqueNumber);
    $secret_key = generateRandomSecretKey();
    $keyquery = "UPDATE `users` SET user_token='$key', secret_key='$secret_key' WHERE mobile='$sanitizedMobile'";
    $queryres = mysqli_query($conn, $keyquery);
    
    //update token in orders table
    
    $keyqueryorders = "UPDATE `orders` SET user_token='$key' WHERE user_id = $bbbyteuserid";
    $queryorders = mysqli_query($conn, $keyqueryorders);
    
     //update token in reports table
    
    $keyqueryordersreports = "UPDATE `reports` SET user_token='$key' WHERE user_id = $bbbyteuserid";
    $queryordersreports = mysqli_query($conn, $keyqueryordersreports);
    
    
    
    
    //hdfc token update 
    
    $keyqueryhdfc = "UPDATE `hdfc` SET user_token='$key' WHERE user_id = $bbbyteuserid";
    $queryreshdfc = mysqli_query($conn, $keyqueryhdfc);
    
    // Updating user_token in bharatpe_tokens table
    $keyquerybharatpe = "UPDATE `bharatpe_tokens` SET user_token='$key' WHERE user_id = '$bbbyteuserid'";
    $queryresbharatpe = mysqli_query($conn, $keyquerybharatpe);
    
    
    //update for phonepe  Updating user_token in phonepe_tokens  table and store_id table
    
    $keyqueryphonepetoken = "UPDATE `phonepe_tokens` SET user_token='$key' WHERE user_id = '$bbbyteuserid'";
    $queryresphonepetoken = mysqli_query($conn, $keyqueryphonepetoken);
    
    //now to update user_token in table store_id
    
    $keyqueryphonepetoken2 = "UPDATE `store_id` SET user_token='$key' WHERE user_id = '$bbbyteuserid'";
    $queryresphonepetoken2 = mysqli_query($conn, $keyqueryphonepetoken2);
    
    //now to update user_token in table paytm_tokens
    
    $keyquerypaytm2 = "UPDATE `paytm_tokens` SET user_token='$key' WHERE user_id = '$bbbyteuserid'";
    $queryrespaytm = mysqli_query($conn, $keyquerypaytm2);
    
    //now to update user_token in table googlepay_transactions
    
    $keyquerygooglepay = "UPDATE `googlepay_transactions` SET user_token='$key' WHERE user_id = '$bbbyteuserid'";
    $queryresgooglepay = mysqli_query($conn, $keyquerygooglepay);
    
    //now to update user_token in table googlepay_tokens
    
     $keyquerygooglepay1 = "UPDATE `googlepay_tokens` SET user_token='$key' WHERE user_id = '$bbbyteuserid'";
    $queryresgooglepay1 = mysqli_query($conn, $keyquerygooglepay1);
    
    
    if($queryres && $queryreshdfc){
        
        
        
        // Show SweetAlert2 success message
                            echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18"></script>';
echo '<script>
    Swal.fire({
        icon: "success",
        title: "New API Key generated!!",
        showConfirmButton: true, // Show the confirm button
        confirmButtonText: "Ok!", // Set text for the confirm button
        allowOutsideClick: false, // Prevent the user from closing the popup by clicking outside
        allowEscapeKey: false // Prevent the user from closing the popup by pressing Escape key
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "apidetails"; // Redirect to "dashboard" when the user clicks the confirm button
        }
    });
</script>';

    exit;
    
    } else {
        
        
        
        
          // Show SweetAlert2 error message
                            echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18"></script>';
echo '<script>
    Swal.fire({
        icon: "error",
        title: "API Key Generating Failed!!",
        showConfirmButton: true, // Show the confirm button
        confirmButtonText: "Ok!", // Set text for the confirm button
        allowOutsideClick: false, // Prevent the user from closing the popup by clicking outside
        allowEscapeKey: false // Prevent the user from closing the popup by pressing Escape key
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "apidetails"; // Redirect to "dashboard" when the user clicks the confirm button
        }
    });
</script>';
exit;
    }
}

// Custom function to validate URLs
function isValidUrl($url) {
    $parsed_url = parse_url($url);
    return isset($parsed_url['host']) && preg_match("/\.\w+$/", $parsed_url['host']);
}

if(isset($_POST['update_webhook'])){
    
    

    $bytecallbackurl=mysqli_real_escape_string($conn,$_POST['webhook_url']);
    
    // Validate the webhook URL
    // Check if the URL has a valid TLD
    if (!isValidUrl($bytecallbackurl)) {
        
        // Show SweetAlert2 error message
                            echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18"></script>';
echo '<script>
    Swal.fire({
        icon: "error",
        title: "Invalid webhook url!!",
        showConfirmButton: true, // Show the confirm button
        confirmButtonText: "Ok!", // Set text for the confirm button
        allowOutsideClick: false, // Prevent the user from closing the popup by clicking outside
        allowEscapeKey: false // Prevent the user from closing the popup by pressing Escape key
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "apidetails"; // Redirect to "dashboard" when the user clicks the confirm button
        }
    });
</script>';

        exit(); // Stop processing the request
    }

    
    
    // Assuming $mobile is already defined in header.php
    $sanitizedMobile = mysqli_real_escape_string($conn, $mobile);


    $key = md5($uniqueNumber);
    $keyquery = "UPDATE `users` SET  callback_url='$bytecallbackurl' WHERE mobile = '$sanitizedMobile'";
    $queryres = mysqli_query($conn, $keyquery);
    if($queryres){
        
        
        
        // Show SweetAlert2 success message
                            echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18"></script>';
echo '<script>
    Swal.fire({
        icon: "success",
        title: "Webhook Updated Successfully",
        showConfirmButton: true, // Show the confirm button
        confirmButtonText: "Ok!", // Set text for the confirm button
        allowOutsideClick: false, // Prevent the user from closing the popup by clicking outside
        allowEscapeKey: false // Prevent the user from closing the popup by pressing Escape key
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "apidetails"; // Redirect to "dashboard" when the user clicks the confirm button
        }
    });
</script>';

    exit;
    
    } else {
        
        
        
        
          // Show SweetAlert2 error message
                            echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18"></script>';
echo '<script>
    Swal.fire({
        icon: "error",
        title: "Error Updating Webhook Try again Later!!",
        showConfirmButton: true, // Show the confirm button
        confirmButtonText: "Ok!", // Set text for the confirm button
        allowOutsideClick: false, // Prevent the user from closing the popup by clicking outside
        allowEscapeKey: false // Prevent the user from closing the popup by pressing Escape key
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "apidetails"; // Redirect to "dashboard" when the user clicks the confirm button
        }
    });
</script>';
exit;
    }
}

?>

<!--start main wrapper-->
<main class="main-wrapper">
    <div class="main-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Settings Area</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">My Profile</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <button type="button" class="btn btn-primary">Settings</button>
                    <button type="button" class="btn btn-primary split-bg-primary dropdown-toggle dropdown-toggle-split"
                        data-bs-toggle="dropdown"><span class="visually-hidden">Toggle Dropdown</span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-end"><a class="dropdown-item"
                            href="javascript:;">Action</a>
                    </div>
                </div>
            </div>
        </div>
        <!--end breadcrumb-->

        <div class="row">
            <div class="col-12 col-xl-6">
                <div class="card">
                    <div class="card-body p-4">
                        <h5 class="mb-4">My Api Keys & Webhook</h5>
                        <form class="row g-3" form method="POST">
                             <div class="col-md-12">
                                <label for="input5" class="form-label">Api Key</label>
                                <input type="text" class="form-control" id="input5" value="<?php echo $user_token; ?>" readonly >
                            </div>
                            <div class="col-md-12">
                                <label for="input3" class="form-label">Payout Secret Key</label>
                                <input type="text" class="form-control" id="input3" value="<?php echo $secret_key; ?>" readonly>
                            </div>
                            <div class="col-md-12">
                                <label for="input4" class="form-label">Webhook Url</label>
                                <input type="text" class="form-control" name ="webhook_url" id="input4" value="<?php echo $callback_url; ?>">
                            </div>
                            <div class="col-md-12">
                                <label for="input5" class="form-label">Api Status</label>
                                <input type="text" class="form-control" name="api_token" id="input6" value="<?php echo "Working"; ?>" readonly>
                            </div>
                            <div class="col-md-12">
                                <label for="input5" class="form-label">Current Time</label>
                                
                              
                                
                                <input type="text" class="form-control" id="input52" placeholder="currenttime" readonly>
                            </div>
                            
                            
                            
                            
                            <div class="col-md-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="input12">
                                    <label class="form-check-label" for="input12">Check me out</label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="d-md-flex d-grid align-items-center gap-3">
                                    <button type="submit" name="generate_token" class="btn btn-success px-4">Regenrate Api Keys</button>
                                    <button type="submit" name ="update_webhook" class="btn btn-light px-4">Update Webhook</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            
            
              <div class="col-12 col-xl-6">
    <div class="card">
        <div class="card-body p-4">
            <h5 class="mb-4">Instructions for Api</h5>
            <form class="row g-3">
               <p>👉 Do not share your API key and payout API key with anyone.</p>
<p>👉 We will not be responsible if anyone uses your API to withdraw your funds.</p>
<p>👉 Ensure that your API keys are stored securely.</p>
<p>👉 Regularly check your account for any unauthorized activity.</p>
<p>👉 Contact support immediately if you suspect any security breaches.</p>
<p>👉 Follow best practices for API security to protect your funds.</p>
<p>👉 Always use strong, unique passwords for your account to enhance security.</p>
                <br>
                <br>
                <br>
                
            </form>
        </div>
    </div>
</div>
            
            
        </div><!--end row-->
    </div>
</main>
<!--end main wrapper-->
<!--bootstrap js-->
<script src="assets/js/bootstrap.bundle.min.js"></script>
<script>
    function updateTime() {
        var now = new Date();
        var hour = now.getHours();
        var ampm = hour >= 12 ? 'PM' : 'AM';
        hour = hour % 12;
        hour = hour ? hour : 12; // handle midnight (0 hours)
        var formattedTime = padZero(hour) + ':' + padZero(now.getMinutes()) + ':' + padZero(now.getSeconds()) + ' ' + ampm;
        document.getElementById('input52').value = formattedTime; // Update the second input field
    }

    function padZero(num) {
        return (num < 10 ? '0' : '') + num;
    }

    updateTime(); // Call the function initially to display the current time
    setInterval(updateTime, 1000); // Update the time every second
</script>

<!--plugins-->
<script src="assets/js/jquery.min.js"></script>
<!--plugins-->
<script src="assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
<script src="assets/plugins/metismenu/metisMenu.min.js"></script>
<script src="assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
<script src="assets/plugins/datatable/js/dataTables.bootstrap5.min.js"></script>

<script src="assets/plugins/simplebar/js/simplebar.min.js"></script>
<script src="assets/js/main.js"></script>


</body>

</html>

