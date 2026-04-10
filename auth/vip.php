<?php
// PHP code

// Define the absolute path to the functions.php file
define('ABSPATH', dirname(__FILE__) . '/'); // Adjust the path as needed

require_once(ABSPATH . 'header.php');

include "../pages/dbFunctions.php";
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

$userid=$_SESSION['user_id'];
// Get the current date and time range for today
// Prepare the SQL query to sum the amount with status 'SUCCESS' for lifetime
$cxr_2sql = "SELECT SUM(amount) as cxr_2total_amount 
             FROM orders 
             WHERE user_id = ? 
             AND status = 'SUCCESS'";

// Prepare and execute the statement
if ($cxr_2stmt = $conn->prepare($cxr_2sql)) {
    // Bind parameters
    $cxr_2stmt->bind_param("i", $userid);
    // Execute the query
    $cxr_2stmt->execute();
    // Bind the result to the variable
    $cxr_2stmt->bind_result($cxr_2total_amount);
    // Fetch the result
    $cxr_2stmt->fetch();
    // Save the result in the $cxr_2today_success_amount variable
    $cxr_2lifetime_success_amount = $cxr_2total_amount ?? 0;
    // Close the statement
    $cxr_2stmt->close();
} else {
    // Handle query preparation error
   // echo "Error preparing the query: " . $conn->error;
}

// Prepare the SQL query to sum the amount with status 'completed' for lifetime
$cxr_3sql = "SELECT SUM(amount) as cxr_3total_amount 
             FROM withdrawals 
             WHERE user_id = ? 
             AND status = 'completed'";

// Prepare and execute the statement
if ($cxr_3stmt = $conn->prepare($cxr_3sql)) {
    // Bind parameters
    $cxr_3stmt->bind_param("i", $userid);
    // Execute the query
    $cxr_3stmt->execute();
    // Bind the result to the variable
    $cxr_3stmt->bind_result($cxr_3total_amount);
    // Fetch the result
    $cxr_3stmt->fetch();
    // Save the result in the $cxr_3today_success_amount variable
    $cxr_3lifetime_success_amount = $cxr_3total_amount ?? 0;
    // Close the statement
    $cxr_3stmt->close();
} else {
    // Handle query preparation error
  //  echo "Error preparing the query: " . $conn->error;
}

// Prepare the SQL query to sum the amount with status 'completed' for lifetime
$cxr_4sql = "SELECT SUM(amount) as cxr_4total_amount 
             FROM withdrawals_upi 
             WHERE user_id = ? 
             AND status = 'completed'";

// Prepare and execute the statement
if ($cxr_4stmt = $conn->prepare($cxr_4sql)) {
    // Bind parameters
    $cxr_4stmt->bind_param("i", $userid);
    // Execute the query
    $cxr_4stmt->execute();
    // Bind the result to the variable
    $cxr_4stmt->bind_result($cxr_4total_amount);
    // Fetch the result
    $cxr_4stmt->fetch();
    // Save the result in the $cxr_4today_success_amount variable
    $cxr_4lifetime_success_amount = $cxr_4total_amount ?? 0;
    // Close the statement
    $cxr_4stmt->close();
} else {
    // Handle query preparation error
  //  echo "Error preparing the query: " . $conn->error;
}


$cxrlifetimepayoutofboth=$cxr_3lifetime_success_amount+$cxr_4lifetime_success_amount;


if ($userdata['route_2'] == 'off') {
    // Show SweetAlert2 error message
    echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18"></script>';
    echo '<script>
        Swal.fire({
            icon: "error",
            title: "Subscribe Vip Plan for Route2",
            showConfirmButton: true,
            confirmButtonText: "Ok!",
            allowOutsideClick: false,
            allowEscapeKey: false
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "subscription";
            }
        });
    </script>';
    exit;
}

if ($userdata['telegram_subscribed'] == 'off') {
    // Show SweetAlert2 error message
    echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18"></script>';
    echo '<script>
        Swal.fire({
            icon: "error",
            title: "Please Subscribe Telegram Notifications!!",
            showConfirmButton: true,
            confirmButtonText: "Ok!",
            allowOutsideClick: false,
            allowEscapeKey: false
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "dashboard";
            }
        });
    </script>';
    exit;
}
?>

<!--start main wrapper-->
<main class="main-wrapper">
    <div class="main-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Vip Area</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">My Vip Profile</li>
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
                        <h5 class="mb-4">My Vip Information</h5>
                        <form class="row g-3" form method="POST">
                            <div class="col-md-12">
                                <label for="input3" class="form-label">Company Name</label>
                                <input type="text" class="form-control" id="input3" value="<?php echo htmlspecialchars($userdata['company'], ENT_QUOTES, 'UTF-8'); ?>" readonly>
                            </div>
                            <div class="col-md-12">
                                <label for="input5" class="form-label">Wallet Balance</label>
                                <input type="text" class="form-control" id="input5" value="₹<?php echo htmlspecialchars($userdata['wallet'], ENT_QUOTES, 'UTF-8'); ?>" readonly >
                            </div>
                            <div class="col-md-12">
                                <label for="input5" class="form-label">Frozen Balance</label>
                                <input type="text" class="form-control" id="input6" value="₹<?php echo htmlspecialchars($userdata['frozenwallet'], ENT_QUOTES, 'UTF-8'); ?>" readonly>
                            </div>
                            <div class="col-md-12">
                                <label for="input4" class="form-label">Device</label>
                                <input type="email" class="form-control" id="input4" value="<?php 
    // Call the getDeviceInformation function and store the result
    $deviceInfo = getDeviceInformation();
    echo htmlspecialchars($deviceInfo, ENT_QUOTES, 'UTF-8'); ?>" readonly>
                            </div>
                            <div class="col-md-12">
                                <label for="input5" class="form-label">Location</label>
                                <input type="text" class="form-control" name="secret_key" id="input7" value="<?php echo "INDIA"; ?>" readonly>
                            </div>
                            
                            
                            
                            <div class="col-md-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="input12">
                                    <label class="form-check-label" for="input12">Check me out</label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="d-md-flex d-grid align-items-center gap-3">
                                    <button type="button" class="btn btn-success px-4" onclick="refreshPage()">ReFresh</button>
                                    <button type="button" class="btn btn-light px-4">Reset</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-12 col-xl-6">
                <div class="card">
                    <div class="card-body p-4">
                        <h5 class="mb-4">Status & Collection Data</h5>
                        <form class="row g-3" form method="POST">
                            <div class="col-md-12">
                                <label for="input15" class="form-label">Vip Account Status</label>
                                <div class="position-relative input-icon">
                                    <input type="text" class="form-control" id="input14" value="<?php echo ($userdata['route_2'] == "on") ? 'Active' : 'Inactive'; ?>" readonly>
                                    <span class="position-absolute top-50 translate-middle-y"><i
                                            class="material-icons-outlined fs-5">person_outline</i></span>
                                </div>
                            </div>
                            
                            <div class="col-md-12">
                                <label for="input15" class="form-label">Vip Plan Expiry</label>
                                <div class="position-relative input-icon">
                                    <input type="text" class="form-control" id="input15" value="<?php echo $userdata['vip_expiry']; ?>" readonly>
                                    <span class="position-absolute top-50 translate-middle-y"><i
                                            class="material-icons-outlined fs-5">calendar_today</i></span>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label for="input17" class="form-label"> Telegram Name</label>
                                <div class="position-relative input-icon">
                                    <input type="text" class="form-control" id="input17" value="<?php echo $userdata['telegram_username']; ?>" readonly>
                                    <span class="position-absolute top-50 translate-middle-y"><i
                                            class="material-icons-outlined fs-5">lock_open</i></span>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label for="input18" class="form-label">Total Lifetime collection</label>
                                <div class="position-relative input-icon">
                                    <input type="text" class="form-control" id="input18" value="₹<?php echo $cxr_2lifetime_success_amount; ?>" readonly>
                                    <span class="position-absolute top-50 translate-middle-y"><i
                                            class="material-icons-outlined fs-5">lock_open</i></span>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label for="input16" class="form-label">Total Lifetime Payout</label>
                                <div class="position-relative input-icon">
                                    <input type="text" class="form-control" id="input16" value="₹<?php echo $cxrlifetimepayoutofboth; ?>" readonly>
                                    
                                    <span class="position-absolute top-50 translate-middle-y"><i
                                            class="material-icons-outlined fs-5">lock_open</i></span>
                                </div>
                            </div>
                            
                            
                            
                            <div class="col-md-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="input24">
                                    <label class="form-check-label" for="input24">Check me out</label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="d-md-flex d-grid align-items-center gap-3">
                                     <button type="button" class="btn btn-success px-4" onclick="refreshPage()">ReFresh</button>
                                    <button type="button" class="btn btn-light px-4">Reset</button>
                                </div>
                            </div>
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
function refreshPage() {
    location.reload();
}
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

