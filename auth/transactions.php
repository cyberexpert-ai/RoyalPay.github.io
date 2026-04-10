<?php

// Define the absolute path to the functions.php file
define('ABSPATH', dirname(__FILE__) . '/'); // Adjust the path as needed

require_once(ABSPATH . 'header.php');


$token = $userdata['user_token'];


$query = "SELECT `id`, `create_date`, `gateway_txn`, `customer_mobile`, `method`, `utr`, `byteTransactionId`, `order_id`, `amount`, `status` FROM `orders` WHERE user_token = '$token' ORDER BY `create_date` DESC";
$query_run = mysqli_query($conn, $query);


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
            <li class="breadcrumb-item active" aria-current="page">Payin History</li>
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
    
    <h6 class="mb-0 text-uppercase">Transactions History</h6>
    <hr>
    <div class="card">
      <div class="card-body">
        <div class="table-responsive">
          <table id="example" class="table table-striped table-bordered" style="width:100%">
            <thead>
              <tr>
                <th>No</th>
                <th>Order ID</th>
                <th>TransactionId</th>
                <th>Amount</th>
                <th>Date</th>
                <th>Time</th>
                <th>Merchant</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody>
              <?php $row_num = 1; ?>
              <?php while ($row = mysqli_fetch_assoc($query_run)): ?>
              <tr>
                <td><?php echo $row_num++; ?></td>
                <td><?php echo htmlspecialchars($row['order_id'], ENT_QUOTES, 'UTF-8'); ?></td>
                <td><?php echo htmlspecialchars($row['byteTransactionId'], ENT_QUOTES, 'UTF-8'); ?></td>
                <td>₹<?php echo htmlspecialchars($row['amount'], ENT_QUOTES, 'UTF-8'); ?></td>
                <td><?php echo htmlspecialchars(date('Y-m-d', strtotime($row['create_date'])), ENT_QUOTES, 'UTF-8'); ?></td>
                <td><?php echo htmlspecialchars(date('h:i:s A', strtotime($row['create_date'])), ENT_QUOTES, 'UTF-8'); ?></td>
                <td>
                  <span class="badge badge-pill" style="width: 80px; padding: 10px; text-align: center; background-color: #ffc107; color: black; font-weight: bold; font-size: 12px;">
                    <?php echo htmlspecialchars($row['method'], ENT_QUOTES, 'UTF-8'); ?>
                  </span>
                </td>
                <td style="color: <?php echo ($row['status'] == 'SUCCESS') ? 'green' : (($row['status'] == 'PENDING') ? 'orange' : 'red'); ?>">
    <?php echo htmlspecialchars($row['status'], ENT_QUOTES, 'UTF-8'); ?>
</td>
              </tr>
              <?php endwhile; ?>
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