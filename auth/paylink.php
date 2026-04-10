<?php

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
//$cxrvipexpiry = $userdata['vip_expiry'];
//if $userdata['route_2'] == 'on' and && $cxrvipexpiry >= $today 
//then user cannot enter amount less than 100 in input filed ok
//else he can fill any maount

?>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    // Function to prompt user for amount
    function promptAmount() {
        Swal.fire({
            title: 'Enter Amount',
            input: 'number',
            inputAttributes: {
                autocapitalize: 'off'
            },
            showCancelButton: true,
            confirmButtonText: 'Submit',
            showLoaderOnConfirm: true,
            preConfirm: (amount) => {
                // PHP condition for checking amount restriction
                <?php
                $cxrvipexpiry = strtotime($userdata['vip_expiry']);
                $today = strtotime(date("Y-m-d"));
                if ($userdata['route_2'] == 'on' && $cxrvipexpiry >= $today) {
                    echo 'if (amount < 100) {
                        Swal.showValidationMessage("Amount cannot be less than 100 in Route2");
                    } else {
                        return amount;
                    }';
                } else {
                    echo 'return amount;';
                }
                ?>
            },
            allowOutsideClick: false // Disable default outside click behavior
        }).then((result) => {
            if (result.isConfirmed) {
                // Create a form element
                const form = document.createElement('form');
                form.method = 'post';
                form.action = 'paylinkgen.php'; // Adjust the action URL as needed

                // Create an input element for the amount
                const amountInput = document.createElement('input');
                amountInput.type = 'hidden';
                amountInput.name = 'amount';
                amountInput.value = result.value;

                // Append the input element to the form
                form.appendChild(amountInput);

                // Append the form to the document body
                document.body.appendChild(form);

                // Submit the form
                form.submit();
            } else {
                // Redirect to the dashboard if the user cancels or clicks outside the prompt
                window.location.href = 'dashboard.php'; // Adjust the redirect URL as needed
            }
        });
    }

    // Call the function when needed
    promptAmount();
</script>
