
<?php

include "auth/config.php";

// Fetch the user_token for user with id 632
$id = 632;
$query = "SELECT user_token FROM users WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->bind_result($user_token);
$stmt->fetch();
$stmt->close();




        // Part 4 code
        // Get the server name
// URL of the PHP page
$url = 'https://khilaadixpro.shop/api/create-order';

// Data to be sent in the POST request
$data = array(
    'customer_mobile' => '1234567890',
    'user_token' => $user_token,
    'amount' => 1,
    'order_id' => '123456'.time(),
    'redirect_url' => 'https://khilaadixpro.shop/success',
    'remark1' => 'test1',
    'remark2' => 'test2',
    'route'=>1,
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

// Check for cURL errors
if (curl_errno($ch)) {
    echo 'cURL Error: ' . curl_error($ch);
}

// Close cURL session
curl_close($ch);


// Decode the JSON response
$jsonResponse = json_decode($response, true);

// Check if decoding was successful
if ($jsonResponse !== null) {
    
    
    // Redirect the user to the payment URL
    $paymentUrl = $jsonResponse['result']['payment_url'];
    header('Location: ' . $paymentUrl);
    exit;
    
} else {
    echo $response;
    exit;
}

      