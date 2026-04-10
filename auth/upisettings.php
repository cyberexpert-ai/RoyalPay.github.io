<?php

// Dene the absolute path to the functions.php file
define('ABSPATH', dirname(__FILE__) . '/'); // Adjust the path as needed
// Include the database connection file
require_once(ABSPATH . 'header.php');


?>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!--favicon-->
  <link rel="icon" href="assets/images/favicon-32x32.png" type="image/png">

  <!--plugins-->
  <link href="assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="assets/plugins/metismenu/metisMenu.min.css">
  <link rel="stylesheet" type="text/css" href="assets/plugins/metismenu/mm-vertical.css">
  <link rel="stylesheet" type="text/css" href="assets/plugins/simplebar/css/simplebar.css">
  <!--bootstrap css-->
  <link href="assets/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/plugins/datatable/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
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

if(isset($_POST['addmerchant'])){
    
    
    $bbbytemerchant = mysqli_real_escape_string($conn, $_POST['merchant_name']);
    
    if ($bbbytemerchant=="hdfc"){
    $no = mysqli_real_escape_string($conn, $_POST['c_mobile']);
    $data = "INSERT INTO hdfc(id, number, seassion, device_id, user_token, pin, upi_hdfc, UPI, tidlist, status, mobile) VALUES ('','$no','','','" . $userdata['user_token'] . "','','','','', 'Deactive','$mobile')";
    $insert = mysqli_query($conn, $data);
    }
    
    elseif ($bbbytemerchant=="phonepe"){
        $no = mysqli_real_escape_string($conn, $_POST['c_mobile']);
        $bbbytetokken=$userdata['user_token'];
        
        $data = "INSERT INTO phonepe_tokens (user_token, phoneNumber, userId, token, refreshToken, name, device_data)
        VALUES ('$bbbytetokken', '$no', '', '', '', '', '')";
$insert = mysqli_query($conn, $data);


    }
    elseif ($bbbytemerchant=="paytm"){
        $no = mysqli_real_escape_string($conn, $_POST['c_mobile']);
        $bbbytetokken=$userdata['user_token'];
        
        $data = "INSERT INTO paytm_tokens (user_token, phoneNumber, MID, Upiid)
        VALUES ('$bbbytetokken', '$no', '','')";
        $insert = mysqli_query($conn, $data);


    }
    
    elseif ($bbbytemerchant=="bharatpe"){
        $no = mysqli_real_escape_string($conn, $_POST['c_mobile']);
        $bbbytetokken=$userdata['user_token'];
        
        $data = "INSERT INTO bharatpe_tokens (user_token, phoneNumber, token, cookie, merchantId)
        VALUES ('$bbbytetokken', '$no', '', '', '')";
$insert = mysqli_query($conn, $data);
     }
     
     elseif ($bbbytemerchant=="googlepay"){
        $no = mysqli_real_escape_string($conn, $_POST['c_mobile']);
        $bbbytetokken=$userdata['user_token'];
        
        $data = "INSERT INTO googlepay_tokens (user_token, phoneNumber, Instance_Id, Upiid)
        VALUES ('$bbbytetokken', '$no', '','')";
        $insert = mysqli_query($conn, $data);


    }
    
    
        
    
    
    if($insert){
        
        
        
        
        // Show SweetAlert2 success message
                            echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18"></script>';
echo '<script>
    Swal.fire({
        icon: "success",
        title: "Congratulations! Your Merchant Hasbeen Added Successfully!",
        showConfirmButton: true, // Show the confirm button
        confirmButtonText: "Ok!", // Set text for the confirm button
        allowOutsideClick: false, // Prevent the user from closing the popup by clicking outside
        allowEscapeKey: false // Prevent the user from closing the popup by pressing Escape key
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "upisettings"; // Redirect to "upisettings" when the user clicks the confirm button
        }
    });
</script>';
 exit;
        
    
        
        
    }else{
        
        
        // Show SweetAlert2 error message
                            echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18"></script>';
echo '<script>
    Swal.fire({
        icon: "error",
        title: "Opps Sorry Merhcant Adding Failure!",
        showConfirmButton: true, // Show the confirm button
        confirmButtonText: "Ok!", // Set text for the confirm button
        allowOutsideClick: false, // Prevent the user from closing the popup by clicking outside
        allowEscapeKey: false // Prevent the user from closing the popup by pressing Escape key
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "dashboard"; // Redirect to "dashboard" when the user clicks the confirm button
        }
    });
</script>';
exit;

    }
}


if (isset($_POST['delete'])) {
    
    
    

 

    $merchant_type = mysqli_real_escape_string($conn, $_POST['merchant_type']);
    $token = $userdata['user_token'];

    // Initialize the delete and update queries
    $del = "";
    $update = "";

    // Construct the delete and update queries based on merchant type
    if ($merchant_type == 'hdfc') {
        $del = "DELETE FROM hdfc WHERE user_token = '$token'";
        $update = "UPDATE users SET hdfc_connected = 'No' WHERE user_token = '$token'";
    } elseif ($merchant_type == 'phonepe') {
        $del = "DELETE FROM phonepe_tokens WHERE user_token = '$token'";
        $update = "UPDATE users SET phonepe_connected = 'No' WHERE user_token = '$token'";
        
        // Add a query to delete from the store_id table as well
        $del_store_id = "DELETE FROM store_id WHERE user_token = '$token'";
        mysqli_query($conn, $del_store_id);
    } elseif ($merchant_type == 'paytm') {
        $del = "DELETE FROM paytm_tokens WHERE user_token = '$token'";
        $update = "UPDATE users SET paytm_connected = 'No' WHERE user_token = '$token'";
    } elseif ($merchant_type == 'bharatpe') {
        $del = "DELETE FROM bharatpe_tokens WHERE user_token = '$token'";
        $update = "UPDATE users SET bharatpe_connected = 'No' WHERE user_token = '$token'";
    }  elseif ($merchant_type == 'googlepay') {
        
        $del = "DELETE FROM googlepay_tokens WHERE user_token = '$token'";
        $update = "UPDATE users SET googlepay_connected = 'No' WHERE user_token = '$token'";
        
    }

    // Execute the delete query
    $res_del = mysqli_query($conn, $del);

    // Execute the update query
    $res_update = mysqli_query($conn, $update);

    if ($res_del && $res_update) {
        // Show SweetAlert2 success message
        echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18"></script>';
        echo '<script>
    Swal.fire({
        icon: "success",
        title: "Congratulations! Your Merchant Has been Deleted Successfully!",
        showConfirmButton: true,
        confirmButtonText: "Ok!",
        allowOutsideClick: false,
        allowEscapeKey: false
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "upisettings";
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
        title: "Merchant Not Deleted! Contact Admin",
        showConfirmButton: true,
        confirmButtonText: "Ok!",
        allowOutsideClick: false,
        allowEscapeKey: false
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "upisettings";
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
      <div class="breadcrumb-title pe-3">Service Area</div>
      <div class="ps-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb mb-0 p-0">
            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Merchant</li>
          </ol>
        </nav>
      </div>
      <div class="ms-auto">
        <div class="btn-group">
          <button type="button" class="btn btn-primary">Settings</button>
          <button type="button" class="btn btn-primary split-bg-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown"> <span class="visually-hidden">Toggle Dropdown</span>
          </button>
          <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-end"> <a class="dropdown-item" href="javascript:;">Action</a>
            <a class="dropdown-item" href="javascript:;">Another action</a>
            <a class="dropdown-item" href="javascript:;">Something else here</a>
            <div class="dropdown-divider"></div> <a class="dropdown-item" href="javascript:;">Separated link</a>
          </div>
        </div>
      </div>
    </div>
    <!--end breadcrumb-->
    
   <div class="card">
    <div class="card-body p-4">
        <h5 class="mb-4">Merchant Add Menu</h5>
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="row mb-3">
                <label for="input50" class="col-sm-3 col-form-label">Cashier Mobile Number</label>
                <div class="col-sm-9">
                    <div class="input-group">
                        <span class="input-group-text"><i class="material-icons-outlined fs-5">smartphone</i></span>
                        <input type="text" class="form-control" id="input50" name="c_mobile" placeholder="Cashier Mobile Number" minlength="10" maxlength="10" oninput="this.value = this.value.replace(/[^0-9]/g, '');" required/>
                        
        				
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <label for="input46" class="col-sm-3 col-form-label">Select Merchant</label>
                <div class="col-sm-9">
                    <select class="form-select" id="input46" name="merchant_name">
                        <option value="hdfc">HDFC Vyapar</option>
                        <option value="phonepe">Phonepe</option>
                        <option value="paytm">Paytm</option>
                        <option value="bharatpe">BharatPe</option>
                        <option value="googlepay">Google Pay</option>
                        <option value="amazonpay">Amazon Pay (Coming Soon)</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <label class="col-sm-3 col-form-label"></label>
                <div class="col-sm-9">
                    <div class="d-md-flex d-grid align-items-center gap-3">
                        <button type="submit" name="addmerchant" class="btn btn-primary px-4">Add Merchant</button>
                        <button type="reset" class="btn btn-light px-4">Reset</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>


    
    <h6 class="mb-0 text-uppercase">My All Merchants</h6>
    <hr>
    <div class="card">
      <div class="card-body">
        <div class="table-responsive">
          <table id="example" class="table table-striped table-bordered" style="width:100%">
            <thead>
              <tr>
                <th>No</th>
                <th>Merchant Type</th>
                <th>Mch Number</th>
                <th>Last Sync</th>
                <th>Status</th>
                <th>Verify</th>
                <th>Delete</th>
              </tr>
            </thead>
            <tbody>
                    <?php
                    $cxrrrrtoken = $userdata['user_token'];
                    $fetchData = "
                        SELECT 'hdfc' AS merchant_type, id, number, date, status FROM hdfc WHERE user_token = '$cxrrrrtoken' 
                        UNION ALL 
                        SELECT 'phonepe' AS merchant_type, sl AS id, phoneNumber AS number, date, status FROM phonepe_tokens WHERE user_token = '$cxrrrrtoken'
                        UNION ALL
                        SELECT 'paytm' AS merchant_type, id, phoneNumber AS number, date, status FROM paytm_tokens WHERE user_token = '$cxrrrrtoken'
                        UNION ALL
                        SELECT 'bharatpe' AS merchant_type, id, phoneNumber AS number, date, status FROM bharatpe_tokens WHERE user_token = '$cxrrrrtoken'
                        UNION ALL
                        SELECT 'googlepay' AS merchant_type, id, phoneNumber AS number, date, status FROM googlepay_tokens WHERE user_token = '$cxrrrrtoken'
                    ";

                    $ssData = mysqli_query($conn, $fetchData);

                    if (mysqli_num_rows($ssData) > 0) {
                        $counter = 1;
                        while ($merchant = mysqli_fetch_array($ssData)) {
                            $class = ($merchant['status'] == 'Active') ? 'badge badge-success' : 'badge badge-danger';
                            ?>
                            <tr>
                                <td><?php echo $counter++; ?></td>
                                <td><?php echo !empty($merchant['merchant_type']) ? strtoupper(htmlspecialchars($merchant['merchant_type'], ENT_QUOTES, 'UTF-8')) : ''; ?></td>
                                <td><?php echo !empty($merchant['number']) ? htmlspecialchars($merchant['number'], ENT_QUOTES, 'UTF-8') : ''; ?></td>
                                <td>
                                    <button type="button" class="btn ripple btn-primary px-2"><?php echo !empty($merchant['date']) ? htmlspecialchars($merchant['date'], ENT_QUOTES, 'UTF-8') : ''; ?></button>
                                    
                                    </td>
                                    </button>
                                <td style="color: <?php echo ($merchant['status'] == 'Active') ? 'green' : (($merchant['status'] != 'Active') ? 'red' : 'yellow'); ?>">
    <?php echo htmlspecialchars($merchant['status'], ENT_QUOTES, 'UTF-8'); ?>
</td>

                                <td>
    <?php
    if ($merchant['merchant_type'] == 'hdfc') {
        // HDFC specific actions
        ?>
        <form action="send_hdfcotp" method="post">
            <input type="hidden" name="hdfc_mobile" value="<?php echo $merchant['number']; ?>">
            
            <button class="btn ripple btn-primary px-2" name="Verify">Verify</button>
        </form>
        <?php
    } elseif ($merchant['merchant_type'] == 'phonepe') {
        // Phonepe specific actions
        ?>
        <form action="send_phonepeotp" method="post">
            <input type="hidden" name="phonepe_mobile" value="<?php echo $merchant['number']; ?>">
            
            <button class="btn ripple btn-primary px-2" name="Verify">Verify</button>
        </form>
        <?php
    } elseif ($merchant['merchant_type'] == 'paytm') {
        // Paytm specific actions
        ?>
        <form action="send_paytmotp" method="post">
            <input type="hidden" name="paytm_mobile" value="<?php echo $merchant['number']; ?>">
            
            <button class="btn ripple btn-primary px-2" name="Verify">Verify</button>
        </form>
        <?php
    } elseif ($merchant['merchant_type'] == 'bharatpe') {
        // Bharatpe specific actions
        ?>
        <form action="send_bharatpeotp" method="post">
            <input type="hidden" name="bharatpe_mobile" value="<?php echo $merchant['number']; ?>">
            
            <button class="btn ripple btn-primary px-2" name="Verify">Verify</button>
        </form>
        <?php
    } elseif ($merchant['merchant_type'] == 'googlepay') {
        ?>
        <form action="send_googlepayotp" method="post">
            <input type="hidden" name="googlepay_mobile" value="<?php echo $merchant['number']; ?>">
            
            <button class="btn ripple btn-primary px-2" name="Verify">Verify</button>
        </form>
        <?php
    }
    ?>
</td>
<td>
    <?php
    if ($merchant['merchant_type'] == 'hdfc') {
        // HDFC specific actions
        ?>
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <input type="hidden" name="hdfc_mobile" value="<?php echo $merchant['number']; ?>">
            <input type="hidden" name="merchant_type" value="hdfc">
            
           
            <button class="btn ripple btn-danger px-2" name="delete">Delete</button>
        </form>
        <?php
    } elseif ($merchant['merchant_type'] == 'phonepe') {
        // Phonepe specific actions
        ?>
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <input type="hidden" name="phonepe_mobile" value="<?php echo $merchant['number']; ?>">
            
          
            <input type="hidden" name="merchant_type" value="phonepe">
            <button class="btn ripple btn-danger px-2" name="delete">Delete</button>
        </form>
        <?php
    } elseif ($merchant['merchant_type'] == 'paytm') {
        // Paytm specific actions
        ?>
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <input type="hidden" name="paytm_mobile" value="<?php echo $merchant['number']; ?>">
            
         
            <input type="hidden" name="merchant_type" value="paytm">
            <button class="btn ripple btn-danger px-2" name="delete">Delete</button>
        </form>
        <?php
    } elseif ($merchant['merchant_type'] == 'bharatpe') {
        // Bharatpe specific actions
        ?>
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <input type="hidden" name="bharatpe_mobile" value="<?php echo $merchant['number']; ?>">
            
           
            <input type="hidden" name="merchant_type" value="bharatpe">
            <button class="btn ripple btn-danger px-2" name="delete">Delete</button>
        </form>
        <?php
    } elseif ($merchant['merchant_type'] == 'googlepay') {
        ?>
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <input type="hidden" name="googlepay_mobile" value="<?php echo $merchant['number']; ?>">
            
           
            <input type="hidden" name="merchant_type" value="googlepay">
            <button class="btn ripple btn-danger px-2" name="delete">Delete</button>
        </form>
        <?php
    }
    ?>
</td>
                            </tr>
                            <?php
                        }
                    }
                    ?>
                </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</main>
<!--end main wrapper-->

  <!--bootstrap js-->
  <script src="assets/js/bootstrap.bundle.min.js"></script>


  <!--plugins-->
  <script src="assets/js/jquery.min.js"></script>
  <script src="assets/js/bootstrap.bundle.min.js"></script>
  <!--plugins-->
  <script src="assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
  <script src="assets/plugins/metismenu/metisMenu.min.js"></script>
  <script src="assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
	<script src="assets/plugins/datatable/js/dataTables.bootstrap5.min.js"></script>
	<script>
		$(document).ready(function() {
			$('#example').DataTable();
		  } );
	</script>
	<script>
		$(document).ready(function() {
			var table = $('#example2').DataTable( {
				lengthChange: false,
				buttons: [ 'copy', 'excel', 'pdf', 'print']
			} );
		 
			table.buttons().container()
				.appendTo( '#example2_wrapper .col-md-6:eq(0)' );
		} );
	</script>
  <script src="assets/plugins/simplebar/js/simplebar.min.js"></script>
  <script src="assets/js/main.js"></script>
  
</body>

</html>