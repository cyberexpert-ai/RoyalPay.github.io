<meta name="robots" content="nofollow, noindex">
<?php
date_default_timezone_set("Asia/Kolkata");
// Define the base directory constant
define('SITE_ROOT', realpath(dirname(__FILE__)) . '/../');

// Securely include files using the SITE_ROOT constant
include SITE_ROOT . 'pages/dbFunctions.php';
include SITE_ROOT . 'pages/dbInfo.php';
include SITE_ROOT . 'auth/config.php';

// Security headers
header("Content-Security-Policy: default-src 'self'; script-src 'self' 'https://cdn.jsdelivr.net' 'https://code.jquery.com'; img-src 'self' https://api.qrserver.com; style-src 'self'; object-src 'none'");
header("X-Content-Type-Options: nosniff");
header("X-Frame-Options: SAMEORIGIN");
header("Strict-Transport-Security: max-age=31536000; includeSubDomains");
header("X-XSS-Protection: 1; mode=block");
header("Referrer-Policy: no-referrer-when-downgrade");
header("Permissions-Policy: geolocation='self'; microphone=()");


$link_token = sanitizeInput($_GET["token"]);

// Fetch order_id based on the token from the payment_links table
$sql_fetch_order_id = "SELECT order_id, created_at FROM payment_links WHERE link_token = '$link_token'";
$result = getXbyY($sql_fetch_order_id);

if (count($result) === 0) {
    // Token not found or expired
    echo "Token not found or expired";
    exit;
}

$order_id = $result[0]['order_id'];
$created_at = strtotime($result[0]['created_at']);
$current_time = time();

// Check if the token has expired (more than 5 minutes)
if (($current_time - $created_at) > (5 * 60)) {
    echo "Token has expired";
    exit;
}


$slq_p = "SELECT * FROM orders where order_id='$order_id'";
$res_p = getXbyY($slq_p);    
$amount = $res_p[0]['amount'];
$user_token = $res_p[0]['user_token'];
$redirect_url = $res_p[0]['redirect_url'];
$cxrkalwaremark = $res_p[0]['byteTransactionId'];  //remark


 
 $slq_p = "SELECT * FROM users where user_token='$user_token'";
        $res_p = getXbyY($slq_p);    
 $cxrviproute2 = $res_p[0]['route_2'];


 if ($cxrviproute2=="off"){
    echo "you are not vip member";
    exit;
}

if ($amount<100){
    echo "amount cannot be less than 100";
    exit;
}
 
 
 // Check if payment link already generated for this token and order_id
$sql_check_link = "SELECT is_already_link, bytevip_link FROM payment_links WHERE link_token = '$link_token' AND order_id = '$order_id'";
$result_check_link = $conn->query($sql_check_link);

if ($result_check_link && $result_check_link->num_rows > 0) {
    $row = $result_check_link->fetch_assoc();
    if ($row['is_already_link'] === 'yes') {
        // Payment link already generated for this token and order_id
        $payment_link = $row['bytevip_link'];
        header("Location: $payment_link");
        exit;
    }
}

 function generateSign(array $params, $secretkey)
{
    ksort($params);
    $string = [];
    foreach ($params as $key => $value) {
        if ($key == 'sign') continue;
        $string[] = $key . '=' . $value;
    }
    $signStr = implode('&', $string) . '&key=' . $secretkey;

    return md5($signStr);
}



$user="ecom";
date_default_timezone_set('Asia/Kolkata');
$date = date('Y-m-d H:i:s');

// Get the server name

$callbackurl = "https://{$_SERVER['SERVER_NAME']}/bytevip/callback";

$params = [
    'version' => '1.0',
    'mch_id' => '888169555',
    'mch_order_no' => $order_id,
    'pay_type' => '131',
    'trade_amount' => $amount,
    'order_date' => $date,
    'goods_name' => $user,
    'notify_url' => $callbackurl,
    'page_url' =>$redirect_url,
    'mch_return_msg' => $user,
];

$params['sign'] = generateSign($params, "adcee7d8bd134aec96581751734b684e");
$params['sign_type'] = "MD5";

$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://pay.sunpayonline.xyz/pay/web',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS => http_build_query($params),
    CURLOPT_HTTPHEADER => array(
        'Cookie: PHPSESSID=lbjsnotksadasv5ng91ts4nlsf'
    ),
));

$response = curl_exec($curl);

curl_close($curl);

$cxrdecode=json_decode($response,true);


if ($cxrdecode['tradeResult']=="1" && isset($cxrdecode['payInfo']) && $cxrdecode['respCode']=="SUCCESS"){
    
    // Extract the payment link from the response
    $payment_link = $cxrdecode['payInfo'];
     // Update the payment_links table with the generated link
$update_sql = "UPDATE payment_links SET is_already_link = 'yes', bytevip_link = '$payment_link' WHERE link_token = '$link_token' AND order_id = '$order_id'";
setXbyY($update_sql);

    
    header("Location: " . $cxrdecode['payInfo']);
    // Make sure that code execution stops after the redirection
    exit;
}
else{

echo $response;
exit;
}


 ?>
