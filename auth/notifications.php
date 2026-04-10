<?php
// PHP code


// Define the absolute path to the functions.php file
define('ABSPATH', dirname(__FILE__) . '/'); // Adjust the path as needed

require_once(ABSPATH . 'header.php');
require_once(ABSPATH . '../pages/dbFunctions.php');
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
// Retrieve user ID from the session

    $merchant_id= $userdata['merchant_id'];




if ($userdata['telegram_subscribed'] == 'on') {
    // Show SweetAlert2 warning message
    echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18"></script>';
    echo '<script>
        Swal.fire({
            icon: "warning",
            title: "You Have Already Subscribed Telegram Notifications!!",
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
} elseif ($userdata['telegram_subscribed'] == 'off'){
    // Your project, make sure to change this to your actual domain or identifier
    // Your project name or identifier
    $subscribeLink = "https://t.me/Khilaadixpro_bot?start=" . $merchant_id;
    
    // At the bottom of your PHP file or where you want to include the script
    echo '<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
    // Display SweetAlert2 confirmation dialog
// Display SweetAlert2 confirmation dialog
echo '<script>
    Swal.fire({
        icon: "question",
        title: "Subscribe to Notifications?",
        showCancelButton: true,
        confirmButtonText: "Subscribe",
        cancelButtonText: "Cancel",
        allowOutsideClick: false,
        allowEscapeKey: false
    }).then((result) => {
        if (result.isConfirmed) {
            // Redirect to subscribe link
            window.location.href = "' . $subscribeLink . '";
        } else {
            // Handle cancellation or any other action
            // For example, redirect to dashboard
            window.location.href = "dashboard";
        }
    });
</script>';
exit;
    
}

?>