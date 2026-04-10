<?php
//api docs for Payin

// Define the absolute path to the functions.php file
define('ABSPATH', dirname(__FILE__) . '/'); // Adjust the path as needed

require_once(ABSPATH . 'header.php');

?>

<head>
  <!--favicon-->
	<link rel="icon" href="assets/images/favicon-32x32.png" type="image/png">

  <!--plugins-->
  <link href="assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="assets/plugins/metismenu/metisMenu.min.css">
  <link rel="stylesheet" type="text/css" href="assets/plugins/metismenu/mm-vertical.css">
  <link href="assets/plugins/simplebar/css/simplebar.css" rel="stylesheet">
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
  <style>
    body {
        font-family: Arial, sans-serif; /* Use a nice font-family */
        background-color: #f4f4f4; /* Light background for the light theme */
        color: #333; /* Dark text for readability */
        transition: background-color 0.3s, color 0.3s; /* Smooth transition for theme change */
    }
    .dark-theme {
        background-color: #121212; /* Dark background for dark theme */
        color: #ddd; /* Light text for readability in dark theme */
    }
    .main-wrapper {
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0,0,0,0.1); /* Subtle shadow for depth */
    }
    table {
    width: 100%;
    border-collapse: collapse;
    margin: 20px 0;
}

th, td {
    text-align: left;
    padding: 8px;
    border: 1px solid #ccc; /* Add border to each cell */
}

th {
    background-color: #f8f8f8;
}

    .card {
        background: #fff; /* White background for the content cards */
        border-radius: 10px;
        padding: 15px;
        margin-top: 20px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1); /* Shadow for cards */
    }
    .breadcrumb {
        background: transparent; /* No background for breadcrumb for cleaner look */
        margin-bottom: 20px;
    }
    .breadcrumb-item a {
        color: inherit; /* Inherits the color from the body or specified */
        text-decoration: none; /* No underline for cleaner links */
    }
    hr {
        border-color: #eee; /* Light line for separation */
    }
    pre {
        background-color: #f8f8f8; /* Light background for code blocks */
        border-left: 3px solid #00B4CC; /* Thematic blue line for style */
        padding: 15px;
        overflow: auto; /* Allows scrolling within the block */
        line-height: 1.5;
        color: green; /* Set text color to green */
    }
</style>
<!--start main wrapper-->
  <main class="main-wrapper">
    <div class="main-content">
      <!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">Tools Area</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">Documentation</li>
							</ol>
						</nav>
					</div>
					<div class="ms-auto">
						<div class="btn-group">
							<button type="button" class="btn btn-primary">Settings</button>
							<button type="button" class="btn btn-primary split-bg-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown">	<span class="visually-hidden">Toggle Dropdown</span>
							</button>
							<div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-end">	<a class="dropdown-item" href="javascript:;">Action</a>
							</div>
						</div>
					</div>
				</div>
				<!--end breadcrumb-->
      

        <div class="row">
					<div class="col-12">

						<h6 class="mb-0 text-uppercase">Payin Api Gateway Docs</h6>
						<hr>
						<div class="card radius-10">
							<div class="card-body">
								<section>
        <h2 style="color: black; font-weight: bold;">Overview</h2>
        <p style="color: black; font-weight: bold;">This API allows you to create a PayIN Request using the platform.</p>
    </section>
    <section>
        <h2 style="color: black; font-weight: bold;">Endpoint PayIN Api</h2>
        <p style="color: black; font-weight: bold;"><strong>POST</strong> <a href="https://khilaadixpro.shop/api/create-order" target="_blank">https://khilaadixpro.shop/api/create-order</a></p>
    </section>
    <section>
        <h2 style="color: black; font-weight: bold;">Request Parameters</h2>
        <table>
            <tr>
                <th style="color: black; font-weight: bold;">Parameter</th>
                <th style="color: black; font-weight: bold;" >Type</th>
            </tr>
            <tr>
                <td style="color: black; font-weight: bold;">customer_mobile</td>
                <td style="color: black; font-weight: bold;">Integer</td>
            </tr>
            <tr>
                <td style="color: black; font-weight: bold;">user_token</td>
                <td style="color: black; font-weight: bold;">string</td>
            </tr>
            <tr>
                <td style="color: black; font-weight: bold;">amount</td>
                <td style="color: black; font-weight: bold;">float</td>
            </tr>
            <tr>
                <td style="color: black; font-weight: bold;">order_id</td>
                <td style="color: black; font-weight: bold;">string</td>
            </tr>
            <tr>
                <td style="color: black; font-weight: bold;">redirect_url</td>
                <td style="color: black; font-weight: bold;">url</td>
            </tr>
            <tr>
                <td style="color: black; font-weight: bold;">remark1</td>
                <td style="color: black; font-weight: bold;">string</td>
            </tr>
            <tr>
                <td style="color: black; font-weight: bold;">remark2</td>
                <td style="color: black; font-weight: bold;">string</td>
            </tr>
            <tr>
                <td style="color: black; font-weight: bold;">route</td>
                <td style="color: black; font-weight: bold;">integer</td>
            </tr>
        </table>
    </section>
    <section>
    <h2 style="color: black; font-weight: bold;">Request Headers</h2>
    <table>
        <tr>
            <th style="color: black; font-weight: bold;">Parameter</th>
            <th style="color: black; font-weight: bold;">Description</th>
        </tr>
        <tr>
            <td style="color: black; font-weight: bold;">Content-Type</td>
            <td style="color: black; font-weight: bold;">Form-Encoded Payload (application/x-www-form-urlencoded)</td>
        </tr>
    </table>
</section>

   <section>
    <h2 style="color: black; font-weight: bold;">Response</h2>
    <table>
        <tr>
            <th style="color: black; font-weight: bold;">Field</th>
            <th style="color: black; font-weight: bold;">Type</th>
            <th style="color: black; font-weight: bold;">Description</th>
        </tr>
        <tr>
            <td style="color: black; font-weight: bold;">status</td>
            <td style="color: black; font-weight: bold;">boolean</td>
            <td style="color: black; font-weight: bold;">API request status.</td>
        </tr>
        <tr>
            <td style="color: black; font-weight: bold;">result</td>
            <td style="color: black; font-weight: bold;">object</td>
            <td style="color: black; font-weight: bold;">Details of successful request.</td>
        </tr>
        <tr>
            <td style="color: black; font-weight: bold;">payment_url</td>
            <td style="color: black; font-weight: bold;">string</td>
            <td style="color: black; font-weight: bold;">URL for processing payment.</td>
        </tr>
        <tr>
            <td style="color: black; font-weight: bold;">message</td>
            <td style="color: black; font-weight: bold;">string</td>
            <td style="color: black; font-weight: bold;">Description of request result.</td>
        </tr>
    </table>
</section>


    <section>
        <h2 style="color: black; font-weight: bold;">Example - Create PayIN Request</h2>
        <h3 style="color: black; font-weight: bold;">Request:</h3>
        <pre>&lt;?php
// API URL
$api_url = 'https://khilaadixpro.shop/api/create-order';

// Form-encoded payload data
$post_data = [
    'customer_mobile' => '8145344963',
    'user_token' => '9856ce42fc26349fe5fab9c6b630e9c6',
    'amount' => '1',
    'order_id' => '8787772321800',
    'redirect_url' => 'https://khilaadixpro.shop',
    'remark1' => 'testremark',
    'remark2' => 'testremark2',
    'route' => '1' // route 2 is for VIP users, route 1 is for normal users
];

// Initialize cURL session
$ch = curl_init($api_url);

// Set cURL options
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post_data)); // to format POST data
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/x-www-form-urlencoded'
]);

// Execute the cURL session and capture the response
$response = curl_exec($ch);

// Check for cURL errors
if (curl_errno($ch)) {
    echo 'cURL Error: ' . curl_error($ch);
} else {
    echo $response;
}

// Close the cURL session
curl_close($ch);
?&gt;</pre>
       <h3 style="color: black; font-weight: bold;">Response (Success):</h3>

<pre>
{
  "status": true,
  "message": "Order Created Successfully",
  "result": {
    "orderId": "1234561705047510",
    "payment_url": "https://khilaadixpro.shop/payment/MTIzNDU2MTc"
  }
}
</pre>
<h3 style="color: black; font-weight: bold;">Response (Error):</h3>

<pre>
{
  "status": false,
  "message": "Your Plan Expired Please Renew"
}
</pre>

    </section>
    
    <section>
        <h2 style="color: black; font-weight: bold;">Error Handling</h2>
        <p style="color: black; font-weight: bold;">If the status in the response is error, check the message field for details on the issue.</p>
    </section>
    
    
    <section>
        <h2 style="color: black; font-weight: bold;">Endpoint for Payin Status</h2>
        <p style="color: black; font-weight: bold;"><strong>POST</strong> <a href="https://khilaadixpro.shop/api/check-order-status" target="_blank">https://khilaadixpro.shop/api/check-order-status</a></p>
    </section>
    <section>
        <h2 style="color: black; font-weight: bold;">Request Parameters</h2>
        <table>
            <tr>
                <th style="color: black; font-weight: bold;">Parameter</th>
                <th style="color: black; font-weight: bold;" >Type</th>
                <th style="color: black; font-weight: bold;">Description</th>
            </tr>
            <tr>
                <td style="color: black; font-weight: bold;">user_token</td>
                <td style="color: black; font-weight: bold;">string</td>
                <td style="color: black; font-weight: bold;">The API Key.</td>
            </tr>
            <tr>
                <td style="color: black; font-weight: bold;">order_id</td>
                <td style="color: black; font-weight: bold;">string</td>
                <td style="color: black; font-weight: bold;">AlphaNumeric.</td>
            </tr>
        </table>
    </section>
   <section>
    <h2 style="color: black; font-weight: bold;">Request Headers</h2>
    <table>
        <tr>
            <th style="color: black; font-weight: bold;">Parameter</th>
            <th style="color: black; font-weight: bold;">Description</th>
        </tr>
        <tr>
            <td style="color: black; font-weight: bold;">Content-Type</td>
            <td style="color: black; font-weight: bold;">Form-Encoded Payload (application/x-www-form-urlencoded)</td>
        </tr>
    </table>
</section>

    <section>
    <h2 style="color: black; font-weight: bold;">Response</h2>
    <table>
        <tr>
            <th style="color: black; font-weight: bold;">Field</th>
            <th style="color: black; font-weight: bold;">Type</th>
            <th style="color: black; font-weight: bold;">Description</th>
        </tr>
        <tr>
            <td style="color: black; font-weight: bold;">status</td>
            <td style="color: black; font-weight: bold;">boolean</td>
            <td style="color: black; font-weight: bold;">API request success status.</td>
        </tr>
        <tr>
            <td style="color: black; font-weight: bold;">message</td>
            <td style="color: black; font-weight: bold;">string</td>
            <td style="color: black; font-weight: bold;">API result message.</td>
        </tr>
        <tr>
            <td style="color: black; font-weight: bold;">result</td>
            <td style="color: black; font-weight: bold;">object</td>
            <td style="color: black; font-weight: bold;">Details of transaction.</td>
        </tr>
        <tr>
            <td style="color: black; font-weight: bold;">txnStatus</td>
            <td style="color: black; font-weight: bold;">string</td>
            <td style="color: black; font-weight: bold;">Transaction status.</td>
        </tr>
        <tr>
            <td style="color: black; font-weight: bold;">orderId</td>
            <td style="color: black; font-weight: bold;">string</td>
            <td style="color: black; font-weight: bold;">Order ID.</td>
        </tr>
        <tr>
            <td style="color: black; font-weight: bold;">amount</td>
            <td style="color: black; font-weight: bold;">string</td>
            <td style="color: black; font-weight: bold;">Transaction amount.</td>
        </tr>
        <tr>
            <td style="color: black; font-weight: bold;">date</td>
            <td style="color: black; font-weight: bold;">string</td>
            <td style="color: black; font-weight: bold;">Transaction time.</td>
        </tr>
        <tr>
            <td style="color: black; font-weight: bold;">utr</td>
            <td style="color: black; font-weight: bold;">string</td>
            <td style="color: black; font-weight: bold;">UTR Number.</td>
        </tr>
    </table>
</section>


    <section>
        <h2 style="color: black; font-weight: bold;">Example - Check PayIN Status</h2>
        <h3 style="color: black; font-weight: bold;">Request:</h3>
        <pre>&lt;?php
// API URL
$api_url = 'https://khilaadixpro.shop/api/check-order-status';

// Form-encoded payload data
$post_data = [
    'user_token' => '9856ce42fc26349fe5fab9c6b630e9c6',
    'order_id' => '8787772321800'
];

// Initialize cURL session
$ch = curl_init($api_url);

// Set cURL options
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post_data)); // to format POST data
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/x-www-form-urlencoded'
]);

// Execute the cURL session and capture the response
$response = curl_exec($ch);

// Check for cURL errors
if (curl_errno($ch)) {
    echo 'cURL Error: ' . curl_error($ch);
} else {
    echo $response;
}

// Close the cURL session
curl_close($ch);
?&gt;</pre>
       <h3 style="color: black; font-weight: bold;">Response (Success):</h3>

<pre>
{
    "status": true,
    "message": "Transaction Successfully",
    "result": {
        "txnStatus": "SUCCESS", //For Pending PENDING
        "orderId": "784525sdD",
        "amount": "1",
        "date": "2024-01-12 13:22:08",
        "utr": "454525454245" //only when success
    }
}
</pre>
<h3 style="color: black; font-weight: bold;">Response (Error):</h3>

<pre>
{
    "status": false,
    "message": "Error Message",
}
</pre>

    </section>
    
    
    
    <section>
        <h2 style="color: black; font-weight: bold;">Example - Webhook Response</h2>
        <h3 style="color: black; font-weight: bold;">POST:</h3>
        <pre>&lt;?php
// Check if the POST request has been made
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve data from POST request
    $status = $_POST['status'];
    $order_id = $_POST['order_id'];
    $customer_mobile = $_POST['customer_mobile'];
    $amount = $_POST['amount'];
    $remark1 = $_POST['remark1'];
    $remark2 = $_POST['remark2'];

    // Process the received data
    // For example, you can save it to a database, log it, or perform other actions
   
} else {
    // Handle other request methods if necessary
    http_response_code(405); // Method Not Allowed
    echo 'Only POST requests are allowed';
}
?&gt;</pre>
    

    </section>
    

							
							</div>
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
  <script src="assets/plugins/simplebar/js/simplebar.min.js"></script>
  <script src="assets/js/main.js"></script>


</body>

</html>