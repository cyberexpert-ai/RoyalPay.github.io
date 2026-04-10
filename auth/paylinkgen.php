<?php

// Define the absolute path to the functions.php file
define('ABSPATH', dirname(__FILE__) . '/'); // Adjust the path as needed

require_once(ABSPATH . 'header.php');
require_once(ABSPATH . '../pages/dbFunctions.php');

date_default_timezone_set("Asia/Kolkata");


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
<?php
if ($userdata['route_2'] == 'off') {
    // Show SweetAlert2 error message
    echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18"></script>';
    echo '<script>
        Swal.fire({
            icon: "error",
            title: "Subscribe Vip Plan for Route2",
            text: "Please subscribe to the VIP plan for Route 2.",
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
            title: "Please Subscribe to Telegram Notifications!!",
            text: "Please subscribe to receive Telegram notifications.",
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

if (isset($_POST['amount']) && $_SERVER["REQUEST_METHOD"] == "POST") {
    
    
$amounttopaylink=filter_var($_POST['amount'], FILTER_VALIDATE_INT);
$cxrvipexpiry = $userdata['vip_expiry'];
$kkktoken=$userdata['user_token'];
$today = date("Y-m-d");
if ($userdata['route_2'] == 'on' && $cxrvipexpiry >= $today) {
    $routetouse = 2;
}

else{
    $routetouse=1;
}



$url = 'https://khilaadixpro.shop/api/create-order';

// Data to be sent in the POST request
$data = array(
    'customer_mobile' => '1234567890',
    'user_token' => $kkktoken,
    'amount' => $amounttopaylink,
    'order_id' => 'WPYLINK'.time().rand(11111,99999),
    'redirect_url' => 'https://khilaadixpro.shop/success',
    'remark1' => 'weblink',
    'remark2' => 'test2',
    'route'=>$routetouse,
);

// Initialize cURL session
$ch = curl_init();

// Set cURL options
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Execute cURL session and store the response
$response = curl_exec($ch);


// Close cURL session
curl_close($ch);


// Decode the JSON response
$jsonResponse = json_decode($response, true);

// Check if decoding was successful
if ($jsonResponse !== null && isset($jsonResponse['result']['payment_url'])) {

    // Get the payment URL
    $paymentUrl = $jsonResponse['result']['payment_url'];
    $shortUrl = generateShortUrl();
    $createdAt = date("Y-m-d H:i:s");
    $linktype="paylink";
    // Prepare the SQL statement with parameter placeholders
// Prepare the SQL statement with parameter placeholders
// Prepare the SQL statement with parameter placeholders
$sql = "INSERT INTO short_urls (short_url, long_url, created_at, link_type) VALUES (?, ?, ?, ?)";

// Prepare the statement
$stmt = $conn->prepare($sql);

// Bind parameters
$stmt->bind_param("ssss", $shortUrl, $paymentUrl, $createdAt, $linktype);

// Execute statement
$stmt->execute();


// Close statement
$stmt->close();

// Close connection
$conn->close();

$paymentUrltoshow = "https://khilaadixpro.shop/shrt/" . $shortUrl;

    
    // Display the payment link using SweetAlert2 with a copy button
    echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
    echo '<style>
        .copy-button {
            display: inline-block;
            padding: 8px 12px;
            background-color: #4caf50;
            color: #ffffff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .copy-button:hover {
            background-color: #45a049;
        }
    </style>';
    echo '<script>
        Swal.fire({
            icon: "success",
            title: "Payment Link Generated!",
            html: `<div><a href="' . $paymentUrltoshow . '" target="_blank" id="paymentLink">' . $paymentUrltoshow . '</a></div><button class="copy-button" onclick="copyToClipboard()">Copy Link</button>`,
            showConfirmButton: true,
            confirmButtonText: "OK",
            allowOutsideClick: false
        }).then((result) => {
            if (result.isConfirmed) {
                // Redirect to dashboard after link is copied
                window.location.href = "dashboard";
            }
        });
        
        // Function to copy the link to clipboard
        function copyToClipboard() {
            const paymentLink = document.getElementById("paymentLink");
            navigator.clipboard.writeText(paymentLink.href);
            Swal.fire({
                icon: "success",
                title: "Link Copied!",
                text: "Payment link copied to clipboard.",
                showConfirmButton: true,
                confirmButtonText: "OK",
                allowOutsideClick: false
            }).then((result) => {
                if (result.isConfirmed) {
                    // Redirect to dashboard after link is copied
                    window.location.href = "dashboard";
                }
            });
        }
    </script>';
}else {
    // Display error message if decoding failed
    echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
    echo '<script>
        Swal.fire({
            icon: "error",
            title: "Error!",
            text: "Payment link generation failed. Please try again later.",
            showConfirmButton: true,
            confirmButtonText: "OK",
            allowOutsideClick: false
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "dashboard";
            }
        });
    </script>';
    exit;
}


}//post brakcet
else {
    // Form not submitted, handle the error or redirect as needed
    echo "Form not submitted";
}