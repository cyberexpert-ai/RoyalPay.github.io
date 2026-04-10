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

<?php
// SweetAlert2 code to display gift code input
echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18"></script>';
echo '<script>
    Swal.fire({
        title: "Enter Gift Code",
        html: `<form id="giftForm" action="gift-verify" method="post">
                  <input type="text" id="gift_code" name="gift_code" class="swal2-input" placeholder="Enter Gift Code" required>
            
                 
                  <input type="submit" name="reedem_gift" style="display: none;">
              </form>`,
        showConfirmButton: true,
        confirmButtonText: "Submit",
        showCancelButton: true,
        cancelButtonText: "Cancel",
        focusConfirm: false,
        allowOutsideClick: false, // Disable outside click behavior
        preConfirm: () => {
            var giftCode = document.getElementById("gift_code").value.trim();
            if (giftCode !== "") {
                // If gift code is not empty, submit the form
                document.getElementById("giftForm").submit();
            } else {
                // If gift code is empty, show an error message
                Swal.showValidationMessage("Gift code cannot be empty");
            }
        }
    }).then((result) => {
        if (result.dismiss) {
            // Redirect to the dashboard if the user clicks outside the prompt or cancels
            window.location.href = "dashboard";
        }
    });
</script>';
exit;
?>


