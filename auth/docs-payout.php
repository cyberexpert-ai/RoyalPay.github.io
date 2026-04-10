<?php
//api docs for payout

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

						<h6 class="mb-0 text-uppercase">Payout Api Gateway Docs</h6>
						<hr>
						<div class="card radius-10">
							<div class="card-body">
								<section>
        <h2 style="color: black; font-weight: bold;">Overview</h2>
        <p style="color: black; font-weight: bold;">This API allows you to create a payout to a UPI ID Or Bank Account using the platform.</p>
    </section>
    <section>
        <h2 style="color: black; font-weight: bold;">Endpoint for Bank Payout</h2>
        <p style="color: black; font-weight: bold;"><strong>POST</strong> <a href="https://khilaadixpro.shop/api/bank/create-order" target="_blank">https://khilaadixpro.shop/api/bank/create-order</a></p>
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
                <td style="color: black; font-weight: bold;">The user's API Key.</td>
            </tr>
            <tr>
                <td style="color: black; font-weight: bold;">amount</td>
                <td style="color: black; font-weight: bold;">float</td>
                <td style="color: black; font-weight: bold;">The amount to be paid.</td>
            </tr>
            <tr>
                <td style="color: black; font-weight: bold;">acc_no</td>
                <td style="color: black; font-weight: bold;">string</td>
                <td style="color: black; font-weight: bold;">The Account Number of the recipient.</td>
            </tr>
            <tr>
                <td style="color: black; font-weight: bold;">ifsc</td>
                <td style="color: black; font-weight: bold;">string</td>
                <td style="color: black; font-weight: bold;">The ifsc of the recipient.</td>
            </tr>
        </table>
    </section>
    <section>
    <h2 style="color: black; font-weight: bold;">Request Headers</h2>
    <table>
        <tr>
            <th style="color: black; font-weight: bold;">Parameter</th>
            <th style="color: black; font-weight: bold;">Type</th>
            <th style="color: black; font-weight: bold;">Description</th>
        </tr>
        <tr>
            <td style="color: black; font-weight: bold;">X-VERIFY</td>
            <td style="color: black; font-weight: bold;">string</td>
            <td style="color: black; font-weight: bold;">To Verify Data Integrity</td>
        </tr>
    </table>
    <h2 style="color: black; font-weight: bold;">Formula for Generating X-VERIFY</h2>
    <p style="color: black; font-weight: bold;">The X-VERIFY header is generated using the following formula:</p>
    <pre style="color: black; font-weight: bold; background-color: #f0f0f0; padding: 10px;">X-VERIFY = hash_hmac('sha256', dataString, secret_key)</pre>
    <p style="color: black; font-weight: bold;">Where:</p>
    <ul>
        <li style="color: black; font-weight: bold;"><strong>dataString</strong> is a string formed by concatenating parameter names and values in the format <code>parameter1=value1|parameter2=value2|...</code>, sorted by parameter names.</li>
        <li style="color: black; font-weight: bold;"><strong>secret_key</strong> is the user's secret key used for generating the HMAC.</li>
    </ul>
</section>

    <section>
    <h2 style="color: black; font-weight: bold;" >Response</h2>
    <table>
        <tr>
            <th style="color: black; font-weight: bold;">Field</th>
            <th style="color: black; font-weight: bold;">Type</th>
            <th style="color: black; font-weight: bold;">Description</th>
        </tr>
        <tr>
            <td style="color: black; font-weight: bold;">status</td>
            <td style="color: black; font-weight: bold;">boolean</td>
            <td style="color: black; font-weight: bold;">Indicates whether the API request was successful or not.</td>
        </tr>
        <tr>
            <td style="color: black; font-weight: bold;">result</td>
            <td style="color: black; font-weight: bold;">object</td>
            <td style="color: black; font-weight: bold;">Contains result related to the successful API request (if status is true).</td>
        </tr>
        <tr>
            <td style="color: black; font-weight: bold;">message</td>
            <td style="color: black; font-weight: bold;">string</td>
            <td style="color: black; font-weight: bold;">Error message describing the reason for API failure.</td>
        </tr>
    </table>
</section>

    <section>
        <h2 style="color: black; font-weight: bold;">Example - Create Bank Payout</h2>
        <h3 style="color: black; font-weight: bold;">Request:</h3>
        <pre>&lt;?php
// API URL
$api_url = 'https://khilaadixpro.shop/api/bank/create-order';

// User input
$user_token = '4b08d135be18fd929fcb254620d6acc5'; // Replace with the user's API Key
$amount = 100; // Replace with the payout amount
$accnumber= 050310101031673; // Replace with acc number
$ifsc="CNRB0000503"; //ifsc code
$secret_key = 'ngOxcT3sR0zSk0uPZfZvihgoM0RIrBE2'; // Your secret key for checksum generation 

// Create an array with POST data
$post_data = [
    'user_token' => $user_token,
    'amount' => $amount,
    'acc_no' => $accnumber,
    'ifsc' =>$ifsc
];

// Function to generate xverify
function generatexverify($data, $secret_key) {
  // Sort the data by keys to ensure consistent order
  ksort($data);
  $dataString = implode('|', array_map(function ($key, $value) {
      return $key . '=' . $value;
  }, array_keys($data), $data));
  return hash_hmac('sha256', $dataString, $secret_key);
}

// Generate xverify
$xverify = generatexverify($post_data, $secret_key);

// Initialize cURL session
$ch = curl_init($api_url);

// Prepare the headers including the X-Verify custom header
$headers = [
    'Content-Type: application/x-www-form-urlencoded', // Set the content type
    'X-VERIFY: ' . $xverify, // Send the xverify in the headers
];

// Set cURL options
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post_data)); // Use http_build_query to format POST data
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers); // Ensure headers are correctly set

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
    "result": {
        "withdraw_id": "PAYOUT123",
        "time": 1716729846
    }
}
</pre>
<h3 style="color: black; font-weight: bold;">Response (Error):</h3>

<pre>
{
    "status": false,
    "message": "Insufficient Balance",
}
</pre>

    </section>
    
    <section>
        <h2 style="color: black; font-weight: bold;">Error Handling</h2>
        <p style="color: black; font-weight: bold;">If the status in the response is error, check the message field for details on the issue.</p>
    </section>
    
    
    <section>
        <h2 style="color: black; font-weight: bold;">Endpoint for Upi Payout</h2>
        <p style="color: black; font-weight: bold;"><strong>POST</strong> <a href="https://khilaadixpro.shop/api/upi/create-order" target="_blank">https://khilaadixpro.shop/api/upi/create-order</a></p>
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
                <td style="color: black; font-weight: bold;">The user's API Key.</td>
            </tr>
            <tr>
                <td style="color: black; font-weight: bold;">amount</td>
                <td style="color: black; font-weight: bold;">float</td>
                <td style="color: black; font-weight: bold;">The amount to be paid.</td>
            </tr>
            <tr>
                <td style="color: black; font-weight: bold;">upi_id</td>
                <td style="color: black; font-weight: bold;">string</td>
                <td style="color: black; font-weight: bold;">The Upi Id of the recipient.</td>
            </tr>
        </table>
    </section>
    <section>
    <h2 style="color: black; font-weight: bold;">Request Headers</h2>
    <table>
        <tr>
            <th style="color: black; font-weight: bold;">Parameter</th>
            <th style="color: black; font-weight: bold;">Type</th>
            <th style="color: black; font-weight: bold;">Description</th>
        </tr>
        <tr>
            <td style="color: black; font-weight: bold;">X-VERIFY</td>
            <td style="color: black; font-weight: bold;">string</td>
            <td style="color: black; font-weight: bold;">To Verify Data Integrity</td>
        </tr>
    </table>
    <h2 style="color: black; font-weight: bold;">Formula for Generating X-VERIFY</h2>
    <p style="color: black; font-weight: bold;">The X-VERIFY header is generated using the following formula:</p>
    <pre style="color: black; font-weight: bold; background-color: #f0f0f0; padding: 10px;">X-VERIFY = hash_hmac('sha256', dataString, secret_key)</pre>
    <p style="color: black; font-weight: bold;">Where:</p>
    <ul>
        <li style="color: black; font-weight: bold;"><strong>dataString</strong> is a string formed by concatenating parameter names and values in the format <code>parameter1=value1|parameter2=value2|...</code>, sorted by parameter names.</li>
        <li style="color: black; font-weight: bold;"><strong>secret_key</strong> is the user's secret key used for generating the HMAC.</li>
    </ul>
</section>

    <section>
    <h2 style="color: black; font-weight: bold;" >Response</h2>
    <table>
        <tr>
            <th style="color: black; font-weight: bold;">Field</th>
            <th style="color: black; font-weight: bold;">Type</th>
            <th style="color: black; font-weight: bold;">Description</th>
        </tr>
        <tr>
            <td style="color: black; font-weight: bold;">status</td>
            <td style="color: black; font-weight: bold;">boolean</td>
            <td style="color: black; font-weight: bold;">Indicates whether the API request was successful or not.</td>
        </tr>
        <tr>
            <td style="color: black; font-weight: bold;">result</td>
            <td style="color: black; font-weight: bold;">object</td>
            <td style="color: black; font-weight: bold;">Contains result related to the successful API request (if status is true).</td>
        </tr>
        <tr>
            <td style="color: black; font-weight: bold;">message</td>
            <td style="color: black; font-weight: bold;">string</td>
            <td style="color: black; font-weight: bold;">Error message describing the reason for API failure.</td>
        </tr>
    </table>
</section>

    <section>
        <h2 style="color: black; font-weight: bold;">Example - Create UPI Payout</h2>
        <h3 style="color: black; font-weight: bold;">Request:</h3>
        <pre>&lt;?php
// API URL
$api_url = 'https://khilaadixpro.shop/api/bank/create-order';

// User input
$user_token = '4b08d135be18fd929fcb254620d6acc5'; // Replace with the user's API token
$amount = 100; // Replace with the payout amount
$upiid= "test@paytm"; // Replace with upi id
$secret_key = 'ngOxcT3sR0zSk0uPZfZvihgoM0RIrBE2'; // Your secret key for checksum generation 

// Create an array with POST data
$post_data = [
    'user_token' => $user_token,
    'amount' => $amount,
    'upi_id' => $upiid
];

// Function to generate xverify
function generatexverify($data, $secret_key) {
  // Sort the data by keys to ensure consistent order
  ksort($data);
  $dataString = implode('|', array_map(function ($key, $value) {
      return $key . '=' . $value;
  }, array_keys($data), $data));
  return hash_hmac('sha256', $dataString, $secret_key);
}

// Generate xverify
$xverify = generatexverify($post_data, $secret_key);

// Initialize cURL session
$ch = curl_init($api_url);

// Prepare the headers including the X-Verify custom header
$headers = [
    'Content-Type: application/x-www-form-urlencoded', // Set the content type
    'X-VERIFY: ' . $xverify, // Send the xverify in the headers
];

// Set cURL options
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post_data)); // Use http_build_query to format POST data
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers); // Ensure headers are correctly set

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
    "result": {
        "withdraw_id": "PAYOUT123",
        "time": 1716729846
    }
}
</pre>
<h3 style="color: black; font-weight: bold;">Response (Error):</h3>

<pre>
{
    "status": false,
    "message": "Insufficient Balance",
}
</pre>

    </section>
    
    <section>
        <h2 style="color: black; font-weight: bold;">Error Handling</h2>
        <p style="color: black; font-weight: bold;">If the status in the response is error, check the message field for details on the issue.</p>
    </section>
    
      <section>
        <h2 style="color: black; font-weight: bold;">Endpoint for Payout Status</h2>
        <p style="color: black; font-weight: bold;"><strong>POST</strong> <a href="https://khilaadixpro.shop/api/payout-status" target="_blank">https://khilaadixpro.shop/api/payout-status</a></p>
    </section>
    
    <section>
        <h2 style="color: black; font-weight: bold;" >Check Payout Status</h2>
        <p style="color: black; font-weight: bold;">To check the status of a payout, you can use the following API:</p>
        <table>
            <tr>
                <th style="color: black; font-weight: bold;">Parameter</th>
                <th style="color: black; font-weight: bold;">Type</th>
                <th style="color: black; font-weight: bold;">Description</th>
            </tr>
            <tr>
                <td style="color: black; font-weight: bold;">user_token</td>
                <td style="color: black; font-weight: bold;">string</td>
                <td style="color: black; font-weight: bold;">The user's API Key.</td>
            </tr>
            <tr>
                <td style="color: black; font-weight: bold;">withdraw_id</td>
                <td style="color: black; font-weight: bold;">string</td>
                <td style="color: black; font-weight: bold;">The ID of the payout to check.</td>
            </tr>
            <tr>
                <td style="color: black; font-weight: bold;">payout_type</td>
                <td style="color: black; font-weight: bold;">string</td>
                <td style="color: black; font-weight: bold;">The Type of the payout to check.</td>
            </tr>
        </table>
        
        <p style="color: black; font-weight: bold;" >This API allows you to verify the status of a payout by providing the <strong>withdraw_id</strong>.</p>
    </section>
    <section>
        <h2 style="color: black; font-weight: bold;">Example - Check Payout Status</h2>
        <h3 style="color: black; font-weight: bold;">Request:</h3>
        <pre>&lt;?php
// Define the API endpoint URL
$api_url = 'https://khilaadixpro.shop/api/payout-status'; // Replace with the actual API endpoint URL

// User input - Replace 'your_user_token_here' with the actual API token
$user_token = '1234'; // Replace with your API token
$withdraw_id = 'pZcaX1694233009'; // Replace with the Withdraw ID you want to check

// Create an array with POST data
$post_data = [
    'user_token' => $user_token, // Make sure this contains your API token
    'withdraw_id' => $withdraw_id,
    'payout_type' => "upi",  //for bank use "bank" for upi use "upi"
];

// Initialize cURL session
$ch = curl_init($api_url);

// Set cURL options
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post_data)); // Use http_build_query to format as x-www-form-urlencoded
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/x-www-form-urlencoded', // Set the content type here
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
    "message": "Withdraw Successfully", //for Pending Withdraw Pending
    "result": {
        "txnStatus": "SUCCESS", //For Pending PENDING
        "withdraw_id": "WMNJG1715431835",
        "amount": "1",
        "date": "2024-01-12 13:22:08"
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