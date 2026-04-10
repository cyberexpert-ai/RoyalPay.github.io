<?php
include "config.php";
// Set the default timezone to 'Asia/Kolkata' (Kolkata, India)
date_default_timezone_set('Asia/Kolkata');
session_start();
// Regenerate the session ID


if (isset($_SESSION['username'])) {
    $mobile = $_SESSION['username'];
    $user = "SELECT * FROM users WHERE mobile = '$mobile'";
    $uu = mysqli_query($conn, $user);
    $userdata = mysqli_fetch_array($uu);
} else {

   header("location:index");
   exit;
}


if ($userdata['telegram_subscribed'] == 'off') {
    echo "subscribe Telegram Notifications to Download Module";
    exit;
}
 
 

// Retrieve and sanitize the sdk parameter
$sdk = filter_var($_GET['sdk'], FILTER_SANITIZE_STRING);
$sdkMap = [
    'color_v' => 'color_v_module',
    'trovacolor_v' =>'trovamodule',
    'whmcs' => 'whmcs_module',
    'smm' => 'smm_module',
    'alasmart' =>'alasmartkit',
    'android' => 'android',
    'php' => 'php',
    'java' => 'java',
    'python' => 'python',
    'csharp' => 'c#',
    'ruby' => 'ruby',
    'javascript' => 'javascript',
    'cpp' => 'c++',
    'kotlin' => 'kotlin',
    'typescript' => 'typescript',
    'wordpress' => 'upi-gateway-woocommerce',
    'swift' => 'swift',
];

 
 $sourceFile = 'cxrfiles/' . $sdkMap[$sdk] . '.zip';  // Original ZIP file
    $tempDirectory = 'temp_dir'; // Temporary directory where the file will be stored

    // Generate a random name for the temporary ZIP file
    $randomName = bin2hex(random_bytes(16));
    $tempFilename = $randomName . '_a.zip';
    $tempFilePath = $tempDirectory . '/' . $tempFilename;

    // Copy the original ZIP file to the temporary directory with the unique filename
    if (copy($sourceFile, $tempFilePath)) {
        // Create a temporary download URL
        $downloadUrl = generateTemporaryDownloadUrl($tempFilename,$cxrapiKey);

        // Redirect the user to the temporary download URL
        header('Location: ' . $downloadUrl);
        exit;
    } else {
        // Failed to copy the file, display an error message
        echo 'Failed to create temporary file.';
        // Additional error handling or redirection
        exit;
    }

/// Function to generate temporary download URL
function generateTemporaryDownloadUrl($tempFilename,$cxrapiKey) {
    $secretKey = '92e32db150c9d96f9bbcd17b4e0848f5'; // Secret key used for generating the URL
    $timestamp = time();
    $hash = hash('sha256', $tempFilename . $timestamp . $secretKey);

    // Append the API key to the URL
    $apiKey = $cxrapiKey; // Assuming the API key is sent as a query parameter
    $downloadUrl = 'https://khilaadixpro.shop/auth/cxrdownload?file=' . urlencode($tempFilename) . '&timestamp=' . $timestamp . '&hash=' . $hash . '&api_key=' . urlencode($apiKey);
    return $downloadUrl;
}    
    
    