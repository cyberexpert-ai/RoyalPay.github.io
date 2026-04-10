<?php

// Dene the absolute path to the functions.php file
define('ABSPATH', dirname(__FILE__) . '/'); // Adjust the path as needed
// Include the database connection file
require_once(ABSPATH . 'header.php');

// Set the default timezone to Asia/Kolkata
date_default_timezone_set('Asia/Kolkata');
// Fetch cxr_notifications from database
$current_time = date("Y-m-d H:i:s");
$sql = "SELECT * FROM cxr_notifications WHERE expiry_time > '$current_time'";
$result = $conn->query($sql);
$cxrpendingnotificationscount = 0; // Initialize count variable
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo '<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
        // Display cxr_notifications using SweetAlert2
        echo "<script>
                Swal.fire({
                  title: '{$row['message']}',
                  icon: '{$row['type']}'
                });
              </script>";
              $cxrpendingnotificationscount++; // Increment count for each notification
    }
} else {
   // echo "<script>console.log('No active notifications.');</script>";
}


if ($userdata['telegram_subscribed'] == 'off'){
    
  $mid = $userdata['merchant_id'];
  $subscribeLink = "https://t.me/Khilaadixpro_bot?start=" . $mid;
  
  // Add SweetAlert2 subscription prompt
echo '<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
echo "<script>
        $(document).ready(function() {
            Swal.fire({
                title: 'Stay Updated!',
                text: 'Subscribe to our Telegram for instant updates and alerts.',
                icon: 'info',
                showCancelButton: true,
                confirmButtonText: 'Subscribe',
                cancelButtonText: 'Cancel',
                allowOutsideClick: false,
                preConfirm: () => {
                    window.location.href = '$subscribeLink';
                }
            });
        });
    </script>";

}

$userid = $_SESSION['user_id'];

// Get the current date and the date one week ago
$current_date = date('Y-m-d');
$one_week_ago = date('Y-m-d', strtotime('-1 week'));

// Get the date two weeks ago
$two_weeks_ago = date('Y-m-d', strtotime('-2 weeks'));

// Prepare the SQL query for this week
$sql_this_week = "SELECT SUM(amount) as total_this_week 
                  FROM orders 
                  WHERE user_id = ? 
                  AND status = 'SUCCESS'
                  AND create_date BETWEEN ? AND ?";

// Prepare and execute the statement for this week
if ($stmt = $conn->prepare($sql_this_week)) {
    // Bind parameters
    $stmt->bind_param("iss", $userid, $one_week_ago, $current_date);
    // Execute the query
    $stmt->execute();
    // Bind the result to the variable
    $stmt->bind_result($total_this_week);
    // Fetch the result
    $stmt->fetch();
    // Close the statement
    $stmt->close();
} else {
    // Handle query preparation error
    //echo "Error preparing the query for this week: " . $conn->error;
}

// Prepare the SQL query for last week
$sql_last_week = "SELECT SUM(amount) as total_last_week 
                  FROM orders 
                  WHERE user_id = ? 
                  AND status = 'SUCCESS'
                  AND create_date BETWEEN ? AND ?";

// Prepare and execute the statement for last week
if ($stmt = $conn->prepare($sql_last_week)) {
    // Bind parameters
    $stmt->bind_param("iss", $userid, $two_weeks_ago, $one_week_ago);
    // Execute the query
    $stmt->execute();
    // Bind the result to the variable
    $stmt->bind_result($total_last_week);
    // Fetch the result
    $stmt->fetch();
    // Close the statement
    $stmt->close();
} else {
    // Handle query preparation error
   // echo "Error preparing the query for last week: " . $conn->error;
}

// Calculate the weekly transaction ratio
if ($total_last_week > 0) {
    $weekly_transaction_ratio = $total_this_week / $total_last_week;
} else {
    $weekly_transaction_ratio = ($total_this_week > 0) ? 1 : 0; // Avoid division by zero
}

// Save the result in the $cxrweeklypayment variable
$cxrweeklypayment = $total_this_week;

// Get the current date and the date one month ago
$cxr_current_date = date('Y-m-d');
$cxr_one_month_ago = date('Y-m-d', strtotime('-1 month'));

// Prepare the SQL query to count orders for the past month
$cxr_sql = "SELECT COUNT(*) as cxr_total_orders 
            FROM orders 
            WHERE user_id = ? 
            AND create_date BETWEEN ? AND ?";

// Prepare and execute the statement
if ($cxr_stmt = $conn->prepare($cxr_sql)) {
    // Bind parameters
    $cxr_stmt->bind_param("iss", $userid, $cxr_one_month_ago, $cxr_current_date);
    // Execute the query
    $cxr_stmt->execute();
    // Bind the result to the variable
    $cxr_stmt->bind_result($cxr_total_orders);
    // Fetch the result
    $cxr_stmt->fetch();
    // Save the result in the $cxr_monthapiorderscount variable
    $cxr_monthapiorderscount = $cxr_total_orders?? 0;
    // Close the statement
    $cxr_stmt->close();
} else {
    // Handle query preparation error
    // echo "Error preparing the query: " . $conn->error;
}

// Get the current date and time range for today
$cxr_2current_date_start = date('Y-m-d 00:00:00');
$cxr_2current_date_end = date('Y-m-d 23:59:59');

// Prepare the SQL query to sum the amount for today with status 'SUCCESS'
$cxr_2sql = "SELECT SUM(amount) as cxr_2total_amount 
             FROM orders 
             WHERE user_id = ? 
             AND create_date BETWEEN ? AND ? 
             AND status = 'SUCCESS'";

// Prepare and execute the statement
if ($cxr_2stmt = $conn->prepare($cxr_2sql)) {
    // Bind parameters
    $cxr_2stmt->bind_param("iss", $userid, $cxr_2current_date_start, $cxr_2current_date_end);
    // Execute the query
    $cxr_2stmt->execute();
    // Bind the result to the variable
    $cxr_2stmt->bind_result($cxr_2total_amount);
    // Fetch the result
    $cxr_2stmt->fetch();
    // Save the result in the $cxr_2today_success_amount variable
    $cxr_2today_success_amount = $cxr_2total_amount?? 0;
    // Close the statement
    $cxr_2stmt->close();
} else {
    // Handle query preparation error
    // echo "Error preparing the query: " . $conn->error;
}

// Get the current time and the time 24 hours ago
$cxr_3current_time = date('Y-m-d H:i:s');
$cxr_3time_24_hours_ago = date('Y-m-d H:i:s', strtotime('-24 hours'));

// Prepare the SQL query to sum the amount for the last 24 hours with status 'completed'
$cxr_3sql = "SELECT SUM(amount) as cxr_3total_amount 
             FROM withdrawals 
             WHERE user_id = ? 
             AND created_at BETWEEN ? AND ? 
             AND status = 'completed'";

// Prepare and execute the statement
if ($cxr_3stmt = $conn->prepare($cxr_3sql)) {
    // Bind parameters
    $cxr_3stmt->bind_param("iss", $userid, $cxr_3time_24_hours_ago, $cxr_3current_time);
    // Execute the query
    $cxr_3stmt->execute();
    // Bind the result to the variable
    $cxr_3stmt->bind_result($cxr_3total_amount);
    // Fetch the result
    $cxr_3stmt->fetch();
    // Check if the result is null or zero and assign zero if so
    $cxr_3last24hourpayouttotalamount = $cxr_3total_amount ?? 0;
    // Close the statement
    $cxr_3stmt->close();
} else {
    // Handle query preparation error
    // echo "Error preparing the query: " . $conn->error;
}

// Prepare the SQL query to sum the lifetime payout amount with status 'completed'
$cxr_4sql = "SELECT SUM(amount) as cxr_4total_amount 
             FROM withdrawals 
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
    // Check if the result is null and assign zero if so
    $cxr_4lifetimepayoutamount = $cxr_4total_amount ?? 0;
    // Close the statement
    $cxr_4stmt->close();
} else {
    // Handle query preparation error
    // echo "Error preparing the query: " . $conn->error;
}





// Get the current year and the previous year
$cxr_5current_year = date('Y');
$cxr_5previous_year = $cxr_5current_year - 1;

// Prepare the SQL query to sum the amount for the current year with status 'completed'
$cxr_5sql_current_year = "SELECT SUM(amount) as cxr_5total_amount 
                          FROM withdrawals 
                          WHERE user_id = ? 
                          AND YEAR(created_at) = ? 
                          AND status = 'completed'";

// Prepare and execute the statement for the current year
if ($cxr_5stmt = $conn->prepare($cxr_5sql_current_year)) {
    // Bind parameters
    $cxr_5stmt->bind_param("ii", $userid, $cxr_5current_year);
    // Execute the query
    $cxr_5stmt->execute();
    // Bind the result to the variable
    $cxr_5stmt->bind_result($cxr_5yearly_amount_sum);
    // Fetch the result
    $cxr_5stmt->fetch();
    // Check if the result is null and assign zero if so
    $cxr_5yearly_amount_sum = $cxr_5yearly_amount_sum ?? 0;
    // Close the statement
    $cxr_5stmt->close();
} else {
    // Handle query preparation error
    // echo "Error preparing the query: " . $conn->error;
}

// Prepare the SQL query to sum the amount for the previous year with status 'completed'
$cxr_5sql_previous_year = "SELECT SUM(amount) as cxr_5total_amount 
                           FROM withdrawals 
                           WHERE user_id = ? 
                           AND YEAR(created_at) = ? 
                           AND status = 'completed'";

// Prepare and execute the statement for the previous year
if ($cxr_5stmt = $conn->prepare($cxr_5sql_previous_year)) {
    // Bind parameters
    $cxr_5stmt->bind_param("ii", $userid, $cxr_5previous_year);
    // Execute the query
    $cxr_5stmt->execute();
    // Bind the result to the variable
    $cxr_5stmt->bind_result($cxr_5previous_year_amount_sum);
    // Fetch the result
    $cxr_5stmt->fetch();
    // Check if the result is null and assign zero if so
    $cxr_5previous_year_amount_sum = $cxr_5previous_year_amount_sum ?? 0;
    // Close the statement
    $cxr_5stmt->close();
} else {
    // Handle query preparation error
    // echo "Error preparing the query: " . $conn->error;
}

// Calculate the difference and the yearly percentage change
$cxr_5difference = $cxr_5yearly_amount_sum - $cxr_5previous_year_amount_sum;
if ($cxr_5previous_year_amount_sum != 0) {
    $cxr_5yearlypercentage_change = ($cxr_5difference / $cxr_5previous_year_amount_sum) * 100;
} else {
    $cxr_5yearlypercentage_change = $cxr_5yearly_amount_sum > 0 ? 100 : 0; // Avoid division by zero
}
// Determine the appropriate arrow and CSS class based on the percentage change
$arrow_icon = $cxr_5yearlypercentage_change >= 0 ? 'arrow_upward' : 'arrow_downward';
$arrow_class = $cxr_5yearlypercentage_change >= 0 ? 'bg-success text-success' : 'bg-danger text-danger';




// Get the current month and the previous month
$cxr_6current_month_start = date('Y-m-01');
$cxr_6current_month_end = date('Y-m-t');
$cxr_6previous_month_start = date('Y-m-01', strtotime('first day of last month'));
$cxr_6previous_month_end = date('Y-m-t', strtotime('last day of last month'));

// Prepare the SQL query to sum the amount for the current month with status 'completed'
$cxr_6sql_current_month = "SELECT SUM(amount) as cxr_6total_amount 
                           FROM withdrawals 
                           WHERE user_id = ? 
                           AND created_at BETWEEN ? AND ? 
                           AND status = 'completed'";

// Prepare and execute the statement for the current month
if ($cxr_6stmt = $conn->prepare($cxr_6sql_current_month)) {
    // Bind parameters
    $cxr_6stmt->bind_param("iss", $userid, $cxr_6current_month_start, $cxr_6current_month_end);
    // Execute the query
    $cxr_6stmt->execute();
    // Bind the result to the variable
    $cxr_6stmt->bind_result($cxr_6monthly_amount_sum);
    // Fetch the result
    $cxr_6stmt->fetch();
    // Check if the result is null and assign zero if so
    $cxr_6monthly_amount_sum = $cxr_6monthly_amount_sum ?? 0;
    // Close the statement
    $cxr_6stmt->close();
} else {
    // Handle query preparation error
    // echo "Error preparing the query: " . $conn->error;
}

// Prepare the SQL query to sum the amount for the previous month with status 'completed'
$cxr_6sql_previous_month = "SELECT SUM(amount) as cxr_6total_amount 
                            FROM withdrawals 
                            WHERE user_id = ? 
                            AND created_at BETWEEN ? AND ? 
                            AND status = 'completed'";

// Prepare and execute the statement for the previous month
if ($cxr_6stmt = $conn->prepare($cxr_6sql_previous_month)) {
    // Bind parameters
    $cxr_6stmt->bind_param("iss", $userid, $cxr_6previous_month_start, $cxr_6previous_month_end);
    // Execute the query
    $cxr_6stmt->execute();
    // Bind the result to the variable
    $cxr_6stmt->bind_result($cxr_6previous_month_amount_sum);
    // Fetch the result
    $cxr_6stmt->fetch();
    // Check if the result is null and assign zero if so
    $cxr_6previous_month_amount_sum = $cxr_6previous_month_amount_sum ?? 0;
    // Close the statement
    $cxr_6stmt->close();
} else {
    // Handle query preparation error
    // echo "Error preparing the query: " . $conn->error;
}

// Calculate the difference and the monthly percentage change
$cxr_6difference = $cxr_6monthly_amount_sum - $cxr_6previous_month_amount_sum;
if ($cxr_6previous_month_amount_sum != 0) {
    $cxr_6monthlypercentage_change = ($cxr_6difference / $cxr_6previous_month_amount_sum) * 100;
} else {
    $cxr_6monthlypercentage_change = $cxr_6monthly_amount_sum > 0 ? 100 : 0; // Avoid division by zero
}



////6 month


// Get the current date and calculate the start date of the current 6-month period
$CXR_7current_date = date('Y-m-d');
$CXR_7current_6months_start = date('Y-m-d', strtotime('-6 months', strtotime($CXR_7current_date)));

// Calculate the start date and end date of the previous 6-month period
$CXR_7previous_6months_start = date('Y-m-d', strtotime('-12 months', strtotime($CXR_7current_date)));
$CXR_7previous_6months_end = date('Y-m-d', strtotime('-6 months', strtotime($CXR_7current_date)));

// Prepare the SQL query to sum the amount for the current 6 months with status 'completed'
$CXR_7sql_current_6months = "SELECT SUM(amount) as CXR_7total_amount 
                             FROM withdrawals 
                             WHERE user_id = ? 
                             AND created_at BETWEEN ? AND ? 
                             AND status = 'completed'";

// Prepare and execute the statement for the current 6 months
if ($CXR_7stmt = $conn->prepare($CXR_7sql_current_6months)) {
    // Bind parameters
    $CXR_7stmt->bind_param("iss", $userid, $CXR_7current_6months_start, $CXR_7current_date);
    // Execute the query
    $CXR_7stmt->execute();
    // Bind the result to the variable
    $CXR_7stmt->bind_result($CXR_7semiannual_amount_sum);
    // Fetch the result
    $CXR_7stmt->fetch();
    // Check if the result is null and assign zero if so
    $CXR_7semiannual_amount_sum = $CXR_7semiannual_amount_sum ?? 0;
    // Close the statement
    $CXR_7stmt->close();
} else {
    // Handle query preparation error
    // echo "Error preparing the query: " . $conn->error;
}

// Prepare the SQL query to sum the amount for the previous 6 months with status 'completed'
$CXR_7sql_previous_6months = "SELECT SUM(amount) as CXR_7total_amount 
                              FROM withdrawals 
                              WHERE user_id = ? 
                              AND created_at BETWEEN ? AND ? 
                              AND status = 'completed'";

// Prepare and execute the statement for the previous 6 months
if ($CXR_7stmt = $conn->prepare($CXR_7sql_previous_6months)) {
    // Bind parameters
    $CXR_7stmt->bind_param("iss", $userid, $CXR_7previous_6months_start, $CXR_7previous_6months_end);
    // Execute the query
    $CXR_7stmt->execute();
    // Bind the result to the variable
    $CXR_7stmt->bind_result($CXR_7previous_semiannual_amount_sum);
    // Fetch the result
    $CXR_7stmt->fetch();
    // Check if the result is null and assign zero if so
    $CXR_7previous_semiannual_amount_sum = $CXR_7previous_semiannual_amount_sum ?? 0;
    // Close the statement
    $CXR_7stmt->close();
} else {
    // Handle query preparation error
    // echo "Error preparing the query: " . $conn->error;
}

// Calculate the difference and the semiannual percentage change
$CXR_7difference = $CXR_7semiannual_amount_sum - $CXR_7previous_semiannual_amount_sum;
if ($CXR_7previous_semiannual_amount_sum != 0) {
    $CXR_7semiannualpercentage_change = ($CXR_7difference / $CXR_7previous_semiannual_amount_sum) * 100;
} else {
    $CXR_7semiannualpercentage_change = $CXR_7semiannual_amount_sum > 0 ? 100 : 0; // Avoid division by zero
}

//cxrharder
/////fetcch number of rows where bank withdraws

// Prepare the SQL query to fetch the number of completed withdrawals for the specified user
$cxr_99query = "SELECT COUNT(*) as count FROM withdrawals WHERE status = 'completed' AND user_id = ?";
$cxr_99stmt = $conn->prepare($cxr_99query);
$cxr_99stmt->bind_param("i", $userid);
$cxr_99stmt->execute();
$cxr_99result = $cxr_99stmt->get_result();

// Fetch the number of rows and assign it to the variable
$cxr_99row = $cxr_99result->fetch_assoc();
$cxr_99completed_withdrawals = $cxr_99row['count'];

$cxr_99stmt->close();


/////fetcch number of rows where upi payout withdraws
// Prepare the SQL query to fetch the number of completed withdrawals for the specified user
$cxr100query = "SELECT COUNT(*) as count FROM withdrawals_upi WHERE status = 'completed' AND user_id = ?";
$cxr100stmt = $conn->prepare($cxr100query);
$cxr100stmt->bind_param("i", $userid);
$cxr100stmt->execute();
$cxr100result = $cxr100stmt->get_result();

// Fetch the number of rows and assign it to the variable
$cxr100row = $cxr100result->fetch_assoc();
$cxr100completed_withdrawals = $cxr100row['count'];

$cxr100stmt->close();


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

 <!--start main wrapper-->
  <main class="main-wrapper">
    <div class="main-content">
      <!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">Dashboard</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">Main Area</li>
							</ol>
						</nav>
					</div>
					<div class="ms-auto">
						<div class="btn-group">
							<button type="button" class="btn btn-primary">Settings</button>
							<button type="button" class="btn btn-primary split-bg-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown">	<span class="visually-hidden">Toggle Dropdown</span>
							</button>
							<div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-end">	<a class="dropdown-item" href="javascript:;">Action</a>
								<div class="dropdown-divider"></div>
                <a class="dropdown-item" href="javascript:;">Separated link</a>
							</div>
						</div>
					</div>
				</div>
				<!--end breadcrumb-->


        <div class="row">
          <div class="col-12 col-xl-4 d-flex">
             <div class="card rounded-4 w-100">
               <div class="card-body">
                 <div class="d-flex align-items-center gap-3 mb-2">
                    <div class="">
                      <h2 class="mb-0">₹<?php echo intval($cxrweeklypayment); ?></h2>
                    </div>
                    <div class="">
                      <p class="dash-lable d-flex align-items-center gap-1 rounded mb-0 <?php echo ($weekly_transaction_ratio < 0) ? 'bg-danger text-danger' : 'bg-success text-success'; ?> bg-opacity-10">
    <span class="material-icons-outlined fs-6">
        <?php echo ($weekly_transaction_ratio < 0) ? 'arrow_downward' : 'arrow_upward'; ?>
    </span>
    <?php echo number_format(abs($weekly_transaction_ratio), 2); ?>%
</p>

                    </div>
                  </div>
                  <p class="mb-0">Average Weekly Payments</p>
                   <div id="chart1"></div>
               </div>
             </div>
          </div>
          <div class="col-12 col-xl-8 d-flex">
            <div class="card rounded-4 w-100">
              <div class="card-body">
                <div class="d-flex align-items-center justify-content-around flex-wrap gap-4 p-4">
                  <div class="d-flex flex-column align-items-center justify-content-center gap-2">
                    <a href="javascript:;" class="mb-2 wh-48 bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center">
                      <i class="material-icons-outlined">shopping_cart</i>
                    </a>
                    <h3 class="mb-0"><?php echo $cxr_total_orders?></h3>
                    <p class="mb-0">Api Orders</p>
                  </div>
                  <div class="vr"></div>
                  <div class="d-flex flex-column align-items-center justify-content-center gap-2">
                    <a href="javascript:;" class="mb-2 wh-48 bg-success bg-opacity-10 text-success rounded-circle d-flex align-items-center justify-content-center">
                      <i class="material-icons-outlined">print</i>
                    </a>
                   <h3 class="mb-0">₹<?php echo $cxr_2today_success_amount?></h3>
                    <p class="mb-0">Transactions</p>
                  </div>
                  <div class="vr"></div>
                  <div class="d-flex flex-column align-items-center justify-content-center gap-2">
                    <a href="javascript:;" class="mb-2 wh-48 bg-danger bg-opacity-10 text-danger rounded-circle d-flex align-items-center justify-content-center">
                      <i class="material-icons-outlined">notifications</i>
                    </a>
                    <h3 class="mb-0"><?php echo $cxrpendingnotificationscount?></h3>
                    <p class="mb-0">Notifications</p>
                  </div>
                  <div class="vr"></div>
                  
                  <div class="d-flex flex-column align-items-center justify-content-center gap-2">
                    <a href="javascript:;" class="mb-2 wh-48 bg-info bg-opacity-10 text-info rounded-circle d-flex align-items-center justify-content-center">
                      <i class="material-icons-outlined">payment</i>
                    </a>
                    <h3 class="mb-0">₹<?php echo $cxr_3last24hourpayouttotalamount?></h3>
                    <p class="mb-0">Payouts</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div><!--end row-->
        
        <div class="row">
          <div class="col-12 col-xl-5 col-xxl-4 d-flex">
            <div class="card rounded-4 w-100 shadow-none bg-transparent border-0">
               <div class="card-body p-0">
                 <div class="row g-4">
                    <div class="col-12 col-xl-6 d-flex">
                      <div class="card mb-0 rounded-4 w-100">
                       <div class="card-body">
                         <div class="d-flex align-items-start justify-content-between mb-3">
                           <div class="">
                             <h4 class="mb-0"><?php echo $cxr100completed_withdrawals;?></h4>
                             <p class="mb-0">Upi Payouts</p>
                           </div>
                           <div class="dropdown">
                             <a href="javascript:;" class="dropdown-toggle-nocaret options dropdown-toggle"
                               data-bs-toggle="dropdown">
                               <span class="material-icons-outlined fs-5">more_vert</span>
                             </a>
                             <ul class="dropdown-menu">
                               <li><a class="dropdown-item" href="javascript:;">Action</a></li>
                             </ul>
                           </div>
                         </div>
                         <div class="chart-container2">
                           <div id="chart3"></div>
                         </div>
                         <div class="text-center">
                          <p class="mb-0"><span class="text-success me-1">12.5%</span> from last month</p>
                        </div>
                       </div>
                      </div>
                   </div>
                   <div class="col-12 col-xl-6 d-flex">
                    <div class="card mb-0 rounded-4 w-100">
                     <div class="card-body">
                       <div class="d-flex align-items-start justify-content-between mb-1">
                         <div class="">
                           <h4 class="mb-0"><?php echo $cxr_99completed_withdrawals; ?></h4>
                           <p class="mb-0">Bank Payouts</p>
                         </div>
                         <div class="dropdown">
                           <a href="javascript:;" class="dropdown-toggle-nocaret options dropdown-toggle"
                             data-bs-toggle="dropdown">
                             <span class="material-icons-outlined fs-5">more_vert</span>
                           </a>
                           <ul class="dropdown-menu">
                             <li><a class="dropdown-item" href="javascript:;">Action</a></li>
                           </ul>
                         </div>
                       </div>
                       <div class="chart-container2">
                         <div id="chart2"></div>
                       </div>
                       <div class="text-center">
                         <p class="mb-0">₹<?php echo intval($cxr_4lifetimepayoutamount); ?> Total LifeTime Bank Payout Amount</p>
                       </div>
                     </div>
                    </div>
                 </div>
                   <div class="col-12 col-xl-12">
                    <div class="card rounded-4 mb-0">
                      <div class="card-body">
                        <div class="d-flex align-items-center gap-3 mb-2">
                           <div class="">
                             <h2 class="mb-0">₹<?php echo $cxr_5yearly_amount_sum ?></h2>
                           </div>
                           <div class="">
                             <p class="dash-lable d-flex align-items-center gap-1 rounded mb-0 bg-success text-success bg-opacity-10"><span class="material-icons-outlined fs-6">arrow_upward</span><?php echo number_format($cxr_5yearlypercentage_change, 2) . "%"; ?></p>
                           </div>
                         </div>
                         <p class="mb-0">Payouts This Year</p>
                          <div class="mt-4">
                            <p class="mb-2 d-flex align-items-center justify-content-between">
     <?php  
    echo intval(number_format($cxr_5difference, 2));
?> left to Goal<span class="">
    <?php echo number_format($cxr_5yearlypercentage_change, 2) . "%"; ?>
    </span>
</p>

                            <div class="progress w-100" style="height: 7px;">
                             <!-- <div class="progress-bar bg-primary" style="width: 65%"></div>-->
                             <div class="progress-bar bg-primary" style="width: <?php echo $cxr_5yearlypercentage_change; ?>%;"></div>
                            </div>
                          </div>
                          
                      </div>
                    </div>
                  </div>

                 </div><!--end row-->
               </div>
            </div>  
          </div> 
          <div class="col-12 col-xl-7 col-xxl-8 d-flex">
            <div class="card w-100 rounded-4">
               <div class="card-body">
                <div class="d-flex align-items-start justify-content-between mb-3">
                  <div class="">
                    <h5 class="mb-0 fw-bold">Sales & Views</h5>
                  </div>
                  <div class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle-nocaret options dropdown-toggle"
                      data-bs-toggle="dropdown">
                      <span class="material-icons-outlined fs-5">more_vert</span>
                    </a>
                    <ul class="dropdown-menu">
                      <li><a class="dropdown-item" href="javascript:;">Action</a></li>
                    </ul>
                  </div>
                 </div>
                  <div id="chart4"></div>
                  <div class="d-flex flex-column flex-lg-row align-items-start justify-content-around border p-3 rounded-4 mt-3 gap-3">
                    <div class="d-flex align-items-center gap-4">
                      <div class="">
                        <p class="mb-0 data-attributes">
                          <span
                            data-peity='{ "fill": ["#0d6efd", "rgb(0 0 0 / 10%)"], "innerRadius": 32, "radius": 40 }'>5/7</span>
                        </p>
                      </div>
                      <diiv class="">
                        <p class="mb-1 fs-6 fw-bold">Monthly Payouts</p>
                        <h2 class="mb-0">₹<?php echo $cxr_6monthly_amount_sum?></h2>
                        <p class="mb-0"><span class="text-success me-2 fw-medium"><?php echo $cxr_6monthlypercentage_change?>%</span><span><?php echo number_format($cxr_6monthly_amount_sum/83, 2); ?> USD</span></p>
                      </diiv>
                    </div>
                    <div class="vr"></div>
                    <div class="d-flex align-items-center gap-4">
                      <div class="">
                        <p class="mb-0 data-attributes">
                          <span
                            data-peity='{ "fill": ["#6f42c1", "rgb(0 0 0 / 10%)"], "innerRadius": 32, "radius": 40 }'>5/7</span>
                        </p>
                      </div>
                      <div class="">
                        <p class="mb-1 fs-6 fw-bold">Semi-Annual</p>
                        <h2 class="mb-0">₹<?php echo $CXR_7semiannual_amount_sum?></h2>
                        <p class="mb-0">
    <span class="text-success me-2 fw-medium"><?php echo $CXR_7semiannualpercentage_change; ?>%</span>
    <span><?php echo number_format($CXR_7semiannual_amount_sum / 83, 2); ?> USD</span>
                      </div>
                    </div>
                  </div>
               </div>
            </div>  
          </div> 
        </div><!--end row-->

        <div class="row">
           <div class="col-12 col-xl-4 d-flex">
            <div class="card w-100 rounded-4">
               <div class="card-body">
                <div class="d-flex align-items-start justify-content-between mb-3">
                  <div class="">
                    <h5 class="mb-0 fw-bold">Ongoing Projects</h5>
                  </div>
                  <div class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle-nocaret options dropdown-toggle"
                      data-bs-toggle="dropdown">
                      <span class="material-icons-outlined fs-5">more_vert</span>
                    </a>
                    <ul class="dropdown-menu">
                      <li><a class="dropdown-item" href="javascript:;">Action</a></li>
                    </ul>
                  </div>
                 </div>
                  <div class="d-flex flex-column gap-4">
                     <div class="d-flex align-items-center gap-4">
                       <div class="d-flex align-items-center gap-3 flex-grow-1 flex-shrink-0">
                        <div class="wh-48 d-flex align-items-center justify-content-center rounded-3 border">
                          <img src="assets/images/projects/angular.png" width="30" alt="">
                        </div>
                          <div class="">
                            <h6 class="mb-0 fw-bold">Angular 12</h6>
                            <p class="mb-0">Admin Template</p>
                          </div>
                       </div>
                       <div class="progress w-25" style="height: 5px;">
                          <div class="progress-bar bg-danger" style="width: 95%"></div>
                       </div>
                       <div class="">
                        <p class="mb-0 fs-6">95%</p>
                       </div>
                     </div>
                     <div class="d-flex align-items-center gap-4">
                      <div class="d-flex align-items-center gap-3 flex-grow-1 flex-shrink-0">
                       <div class="wh-48 d-flex align-items-center justify-content-center rounded-3 border">
                         <img src="assets/images/projects/react.png" width="30" alt="">
                       </div>
                         <div class="">
                           <h6 class="mb-0 fw-bold">React Js</h6>
                           <p class="mb-0">eCommerce Admin</p>
                         </div>
                      </div>
                      <div class="progress w-25" style="height: 5px;">
                         <div class="progress-bar bg-info" style="width: 90%"></div>
                      </div>
                      <div class="">
                       <p class="mb-0 fs-6">90%</p>
                      </div>
                    </div>
                    <div class="d-flex align-items-center gap-4">
                      <div class="d-flex align-items-center gap-3 flex-grow-1 flex-shrink-0">
                       <div class="wh-48 d-flex align-items-center justify-content-center rounded-3 border">
                         <img src="assets/images/projects/vue.png" width="30" alt="">
                       </div>
                         <div class="">
                           <h6 class="mb-0 fw-bold">Vue Js</h6>
                           <p class="mb-0">Dashboard Template</p>
                         </div>
                      </div>
                      <div class="progress w-25" style="height: 5px;">
                         <div class="progress-bar bg-success" style="width: 85%"></div>
                      </div>
                      <div class="">
                       <p class="mb-0 fs-6">85%</p>
                      </div>
                    </div>
                    <div class="d-flex align-items-center gap-4">
                      <div class="d-flex align-items-center gap-3 flex-grow-1 flex-shrink-0">
                       <div class="wh-48 d-flex align-items-center justify-content-center rounded-3 border">
                         <img src="assets/images/projects/bootstrap.png" width="30" alt="">
                       </div>
                         <div class="">
                           <h6 class="mb-0 fw-bold">Bootstrap 5</h6>
                           <p class="mb-0">Corporate Website</p>
                         </div>
                      </div>
                      <div class="progress w-25" style="height: 5px;">
                         <div class="progress-bar bg-voilet" style="width: 75%"></div>
                      </div>
                      <div class="">
                       <p class="mb-0 fs-6">75%</p>
                      </div>
                    </div>
                    <div class="d-flex align-items-center gap-4">
                      <div class="d-flex align-items-center gap-3 flex-grow-1 flex-shrink-0">
                       <div class="wh-48 d-flex align-items-center justify-content-center rounded-3 border">
                         <img src="assets/images/projects/magento.png" width="30" alt="">
                       </div>
                         <div class="">
                           <h6 class="mb-0 fw-bold">Magento</h6>
                           <p class="mb-0">Shoping Portal</p>
                         </div>
                      </div>
                      <div class="progress w-25" style="height: 5px;">
                         <div class="progress-bar bg-orange" style="width: 65%"></div>
                      </div>
                      <div class="">
                       <p class="mb-0 fs-6">65%</p>
                      </div>
                    </div>
                    <div class="d-flex align-items-center gap-4">
                      <div class="d-flex align-items-center gap-3 flex-grow-1 flex-shrink-0">
                       <div class="wh-48 d-flex align-items-center justify-content-center rounded-3 border">
                         <img src="assets/images/projects/django.png" width="30" alt="">
                       </div>
                         <div class="">
                           <h6 class="mb-0 fw-bold">Django</h6>
                           <p class="mb-0">Backend Admin</p>
                         </div>
                      </div>
                      <div class="progress w-25" style="height: 5px;">
                         <div class="progress-bar bg-cyne" style="width: 55%"></div>
                      </div>
                      <div class="">
                       <p class="mb-0 fs-6">55%</p>
                      </div>
                    </div>
                    <div class="d-flex align-items-center gap-4">
                      <div class="d-flex align-items-center gap-3 flex-grow-1 flex-shrink-0">
                       <div class="wh-48 d-flex align-items-center justify-content-center rounded-3 border">
                         <img src="assets/images/projects/python.png" width="30" alt="">
                       </div>
                         <div class="">
                           <h6 class="mb-0 fw-bold">Python</h6>
                           <p class="mb-0">User Panel</p>
                         </div>
                      </div>
                      <div class="progress w-25" style="height: 5px;">
                         <div class="progress-bar" style="width: 45%"></div>
                      </div>
                      <div class="">
                       <p class="mb-0 fs-6">45%</p>
                      </div>
                    </div>
                  </div>
               </div>
             </div>
           </div>

           <div class="col-12 col-xl-4 d-flex">
            <div class="card w-100 rounded-4">
              <div class="card-body">
                <div class="d-flex align-items-start justify-content-between mb-3">
                  <div class="">
                    <h5 class="mb-0 fw-bold">Campaign</h5>
                  </div>
                  <div class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle-nocaret options dropdown-toggle"
                      data-bs-toggle="dropdown">
                      <span class="material-icons-outlined fs-5">more_vert</span>
                    </a>
                    <ul class="dropdown-menu">
                      <li><a class="dropdown-item" href="javascript:;">Action</a></li>
                    </ul>
                  </div>
                 </div>
                <div class="d-flex flex-column justify-content-between gap-4">
                  <div class="d-flex align-items-center gap-4">
                    <div class="d-flex align-items-center gap-3 flex-grow-1">
                      <img src="assets/images/apps/17.png" width="32" alt="">
                      <p class="mb-0">Facebook</p>
                    </div>
                    <div class="">
                      <p class="mb-0 fs-6">55%</p>
                    </div>
                    <div class="">
                      <p class="mb-0 data-attributes">
                        <span
                          data-peity='{ "fill": ["#0d6efd", "rgb(0 0 0 / 10%)"], "innerRadius": 14, "radius": 18 }'>5/7</span>
                      </p>
                    </div>
                  </div>
                  <div class="d-flex align-items-center gap-4">
                    <div class="d-flex align-items-center gap-3 flex-grow-1">
                      <img src="assets/images/apps/18.png" width="32" alt="">
                      <p class="mb-0">LinkedIn</p>
                    </div>
                    <div class="">
                      <p class="mb-0 fs-6">67%</p>
                    </div>
                    <div class="">
                      <p class="mb-0 data-attributes">
                        <span
                          data-peity='{ "fill": ["#fc185a", "rgb(0 0 0 / 10%)"], "innerRadius": 14, "radius": 18 }'>5/7</span>
                      </p>
                    </div>
                  </div>
                  <div class="d-flex align-items-center gap-4">
                    <div class="d-flex align-items-center gap-3 flex-grow-1">
                      <img src="assets/images/apps/19.png" width="32" alt="">
                      <p class="mb-0">Instagram</p>
                    </div>
                    <div class="">
                      <p class="mb-0 fs-6">78%</p>
                    </div>
                    <div class="">
                      <p class="mb-0 data-attributes">
                        <span
                          data-peity='{ "fill": ["#02c27a", "rgb(0 0 0 / 10%)"], "innerRadius": 14, "radius": 18 }'>5/7</span>
                      </p>
                    </div>
                  </div>
                  <div class="d-flex align-items-center gap-4">
                    <div class="d-flex align-items-center gap-3 flex-grow-1">
                      <img src="assets/images/apps/20.png" width="32" alt="">
                      <p class="mb-0">Snapchat</p>
                    </div>
                    <div class="">
                      <p class="mb-0 fs-6">46%</p>
                    </div>
                    <div class="">
                      <p class="mb-0 data-attributes">
                        <span
                          data-peity='{ "fill": ["#fd7e14", "rgb(0 0 0 / 10%)"], "innerRadius": 14, "radius": 18 }'>5/7</span>
                      </p>
                    </div>
                  </div>
                  <div class="d-flex align-items-center gap-4">
                    <div class="d-flex align-items-center gap-3 flex-grow-1">
                      <img src="assets/images/apps/05.png" width="32" alt="">
                      <p class="mb-0">Google</p>
                    </div>
                    <div class="">
                      <p class="mb-0 fs-6">38%</p>
                    </div>
                    <div class="">
                      <p class="mb-0 data-attributes">
                        <span
                          data-peity='{ "fill": ["#0dcaf0", "rgb(0 0 0 / 10%)"], "innerRadius": 14, "radius": 18 }'>5/7</span>
                      </p>
                    </div>
                  </div>
                  <div class="d-flex align-items-center gap-4">
                    <div class="d-flex align-items-center gap-3 flex-grow-1">
                      <img src="assets/images/apps/08.png" width="32" alt="">
                      <p class="mb-0">Altaba</p>
                    </div>
                    <div class="">
                      <p class="mb-0 fs-6">15%</p>
                    </div>
                    <div class="">
                      <p class="mb-0 data-attributes">
                        <span
                          data-peity='{ "fill": ["#6f42c1", "rgb(0 0 0 / 10%)"], "innerRadius": 14, "radius": 18 }'>5/7</span>
                      </p>
                    </div>
                  </div>
                  <div class="d-flex align-items-center gap-4">
                    <div class="d-flex align-items-center gap-3 flex-grow-1">
                      <img src="assets/images/apps/07.png" width="32" alt="">
                      <p class="mb-0">Spotify</p>
                    </div>
                    <div class="">
                      <p class="mb-0 fs-6">12%</p>
                    </div>
                    <div class="">
                      <p class="mb-0 data-attributes">
                        <span
                          data-peity='{ "fill": ["#ff00b3", "rgb(0 0 0 / 10%)"], "innerRadius": 14, "radius": 18 }'>5/7</span>
                      </p>
                    </div>
                  </div>
                  <div class="d-flex align-items-center gap-4">
                    <div class="d-flex align-items-center gap-3 flex-grow-1">
                      <img src="assets/images/apps/12.png" width="32" alt="">
                      <p class="mb-0">Photoes</p>
                    </div>
                    <div class="">
                      <p class="mb-0 fs-6">24%</p>
                    </div>
                    <div class="">
                      <p class="mb-0 data-attributes">
                        <span
                          data-peity='{ "fill": ["#22e3aa", "rgb(0 0 0 / 10%)"], "innerRadius": 14, "radius": 18 }'>5/7</span>
                      </p>
                    </div>
                  </div>
                  
                </div>
              </div>
            </div>  
          </div>

           <div class="col-12 col-xl-4 d-flex">
            <div class="card rounded-4 w-100">
              <div class="card-body">
                <div class="d-flex align-items-start justify-content-between mb-3">
                  <div class="">
                    <h5 class="mb-0 fw-bold">Recent Transactions</h5>
                  </div>
                  <div class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle-nocaret options dropdown-toggle"
                      data-bs-toggle="dropdown">
                      <span class="material-icons-outlined fs-5">more_vert</span>
                    </a>
                    <ul class="dropdown-menu">
                      <li><a class="dropdown-item" href="javascript:;">Action</a></li>
                    </ul>
                  </div>
                 </div>
                <div class="payments-list">
                  <div class="d-flex flex-column gap-4">
                    <div class="d-flex align-items-center gap-3">
                      <div class="wh-48 d-flex align-items-center justify-content-center bg-danger rounded-circle">
                        <span class="material-icons-outlined text-white">shopping_cart</span>
                      </div>
                      <div class="flex-grow-1">
                        <h6 class="mb-0 fw-bold">Online Purchase</h6>
                        <p class="mb-0">03/10/2022</p>
                      </div>
                      <div class="d-flex align-items-center">
                        <h6 class="mb-0 fw-bold">$97,896</h6>
                      </div>
                    </div>
                    <div class="d-flex align-items-center gap-3">
                      <div class="wh-48 d-flex align-items-center justify-content-center rounded-circle bg-primary">
                        <span class="material-icons-outlined text-white">monetization_on</span>
                      </div>
                      <div class="flex-grow-1">
                        <h6 class="mb-0">Bank Transfer</h6>
                        <p class="mb-0">03/10/2022</p>
                      </div>
                      <div class="d-flex align-items-center gap-1">
                        <h6 class="mb-0 fw-bold">$86,469</h6>
                      </div>
                    </div>
                    <div class="d-flex align-items-center gap-3">
                      <div class="wh-48 d-flex align-items-center justify-content-center rounded-circle bg-success">
                        <span class="material-icons-outlined text-white">credit_card</span>
                      </div>
                      <div class="flex-grow-1">
                        <h6 class="mb-0">Credit Card</h6>
                        <p class="mb-0">03/10/2022</p>
                      </div>
                      <div class="d-flex align-items-center gap-1">
                        <h6 class="mb-0 fw-bold">$45,259</h6>
                      </div>
                    </div>
                    <div class="d-flex align-items-center gap-3">
                      <div class="wh-48 d-flex align-items-center justify-content-center rounded-circle bg-purple">
                        <span class="material-icons-outlined text-white">account_balance</span>
                      </div>
                      <div class="flex-grow-1">
                        <h6 class="mb-0">Laptop Payment</h6>
                        <p class="mb-0">03/10/2022</p>
                      </div>
                      <div class="d-flex align-items-center gap-1">
                        <h6 class="mb-0 fw-bold">$35,249</h6>
                      </div>
                    </div>
                    <div class="d-flex align-items-center gap-3">
                      <div class="wh-48 d-flex align-items-center justify-content-center rounded-circle bg-orange">
                        <span class="material-icons-outlined text-white">savings</span>
                      </div>
                      <div class="flex-grow-1">
                        <h6 class="mb-0">Template Payment</h6>
                        <p class="mb-0">03/10/2022</p>
                      </div>
                      <div class="d-flex align-items-center gap-1">
                        <h6 class="mb-0 fw-bold">$68,478</h6>
                      </div>
                    </div>
                    <div class="d-flex align-items-center gap-3">
                      <div class="wh-48 d-flex align-items-center justify-content-center rounded-circle bg-info">
                        <span class="material-icons-outlined text-white">paid</span>
                      </div>
                      <div class="flex-grow-1">
                        <h6 class="mb-0">iPhone Purchase</h6>
                        <p class="mb-0">03/10/2022</p>
                      </div>
                      <div class="d-flex align-items-center gap-1">
                        <h6 class="mb-0 fw-bold">$55,128</h6>
                      </div>
                    </div>
                    <div class="d-flex align-items-center gap-3">
                      <div class="wh-48 d-flex align-items-center justify-content-center rounded-circle bg-pink">
                        <span class="material-icons-outlined text-white">card_giftcard</span>
                      </div>
                      <div class="flex-grow-1">
                        <h6 class="mb-0">Account Credit</h6>
                        <p class="mb-0">03/10/2022</p>
                      </div>
                      <div class="d-flex align-items-center gap-1">
                        <h6 class="mb-0 fw-bold">$24,568</h6>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
         </div>

         
        
      </div><!--end row-->

    </div>
  </main>
  
  
  <!--end main wrapper-->

<!--bootstrap js-->
  <script src="assets/js/bootstrap.bundle.min.js"></script>

  <!--plugins-->
  <script src="assets/js/jquery.min.js"></script>
  <!--plugins-->
  <script src="assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
  <script src="assets/plugins/metismenu/metisMenu.min.js"></script>
  <script src="assets/plugins/apexchart/apexcharts.min.js"></script>
  <script src="assets/js/index.js"></script>
  <script src="assets/plugins/peity/jquery.peity.min.js"></script>
  <script>
    $(".data-attributes span").peity("donut")
  </script>
  <script src="assets/plugins/simplebar/js/simplebar.min.js"></script>
  <script src="assets/js/main.js"></script>


</body>

</html>