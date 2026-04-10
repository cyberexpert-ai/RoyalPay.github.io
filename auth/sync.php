<?php

// Dene the absolute path to the functions.php file
define('ABSPATH', dirname(__FILE__) . '/'); // Adjust the path as needed
// Include the database connection file
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

  
    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18"></script>
    <style>
        .swal2-progress {
            position: relative;
            height: 20px;
            width: 100%;
            background-color: #f0f0f0;
            border-radius: 5px;
            overflow: hidden;
            margin-top: 20px;
            text-align: center;
            color: #fff;
        }
        .swal2-progress-bar {
            position: absolute;
            height: 100%;
            width: 0%;
            background-color: #4caf50;
            transition: width 0.1s;
        }
    </style>
</head>
<body>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            Swal.fire({
                title: 'Sync in Progress',
                html: '<div class="swal2-progress" id="progress-container"><div class="swal2-progress-bar" id="progress-bar"></div><span id="progress-percent">0%</span></div>',
                showConfirmButton: false,
                allowOutsideClick: false,
                timerProgressBar: true,
                didOpen: () => {
                    Swal.showLoading();
                    const progressBar = document.getElementById('progress-bar');
                    const progressPercent = document.getElementById('progress-percent');
                    let width = 0;
                    const interval = setInterval(() => {
                        width += 1;
                        progressBar.style.width = width + '%';
                        progressPercent.innerText = width + '%';
                        if (width >= 100) {
                            clearInterval(interval);
                            Swal.close(); // Close the progress bar
                            Swal.fire({
                                title: 'Sync Complete Successfully',
                                icon: 'success',
                                showConfirmButton: true,
                                confirmButtonText: 'OK',
                                allowOutsideClick: false
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = 'dashboard';
                                }
                            });
                        }
                    }, 100); // Progress bar increments every 100 milliseconds
                }
            });
        });
    </script>
</body>
</html>
