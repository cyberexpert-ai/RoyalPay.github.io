<?php

// Dene the absolute path to the functions.php file
define('ABSPATH', dirname(__FILE__) . '/'); // Adjust the path as needed
// Include the database connection file
require_once(ABSPATH . 'header.php');
?>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!--favicon-->
  <link rel="icon" href="assets/images/favicon-32x32.png" type="image/png">

  <!--plugins-->
  <link href="assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="assets/plugins/metismenu/metisMenu.min.css">
  <link rel="stylesheet" type="text/css" href="assets/plugins/metismenu/mm-vertical.css">
  <link rel="stylesheet" type="text/css" href="assets/plugins/simplebar/css/simplebar.css">
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

<!--start main wrapper-->
  <main class="main-wrapper">
    <div class="main-content">
      <!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">Subscription</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">Pricing</li>
							</ol>
						</nav>
					</div>
					<div class="ms-auto">
						<div class="btn-group">
							<button type="button" class="btn btn-primary">Settings</button>
							<button type="button" class="btn btn-primary split-bg-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown">	<span class="visually-hidden">Toggle Dropdown</span>
							</button>
							<div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-end">	<a class="dropdown-item" href="javascript:;">Action</a>
								<a class="dropdown-item" href="javascript:;">Another action</a>
								<a class="dropdown-item" href="javascript:;">Something else here</a>
								<div class="dropdown-divider"></div>	<a class="dropdown-item" href="javascript:;">Separated link</a>
							</div>
						</div>
					</div>
				</div>
				<!--end breadcrumb-->
      
        <div class="row">
           <div class="col-12 col-xl-4">
             <div class="card border-top border-4 border-primary">
               <div class="card-body p-4">
                    <form method="POST" action="lib/pay">
                
                <input type="hidden" name="planid" value="3">
                <div style="display: inline-block; padding: 0.25rem 0.5rem; font-weight: 500; background-color: rgba(0, 123, 255, 0.1); color: #007bff; text-transform: uppercase; text-align: center; border-radius: 0.25rem;">Starter Plan</div>
                 <div class="my-4">
                    <h3 class="mb-2">Starter Pack </h3>
                    <p class="mb-0">Made for Starters</p>
                 </div>
                 <div class="pricing-content d-flex flex-column gap-3">
                    <div class="d-flex align-items-center justify-content-between">
    <p class="mb-0 fs-6">📌 Merchant is Required</p>
</div>
<div class="d-flex align-items-center justify-content-between">
    <p class="mb-0 fs-6">🔑 Access To Route1</p>
</div>
<div class="d-flex align-items-center justify-content-between">
    <p class="mb-0 fs-6">🔑 Realtime Transaction</p>
</div>
<div class="d-flex align-items-center justify-content-between">
    <p class="mb-0 fs-6">💼 Merchant Settlement</p>
</div>
<div class="d-flex align-items-center justify-content-between">
    <p class="mb-0 fs-6">📲 Accept All UPI Apps</p>
</div>
<div class="d-flex align-items-center justify-content-between">
    <p class="mb-0 fs-6">🥺 Basic Support Only</p>
</div>

                 </div>
                 <div class="price-tag d-flex align-items-center justify-content-center gap-2 my-5">
                   <h5 class="mb-0 align-self-end text-primary">₹</h5>
                   <h1 class="mb-0 lh-1 price-amount text-primary">499</h1>
                   <h5 class="mb-0 align-self-end text-primary">/3Month</h5>
                 </div>
                 <div class="d-grid">
                   <button type="submit" name ="buyplan" class="btn btn-lg btn-success">Get Started</button>
                 </div>
                 </form>
               </div>
             </div>
           </div>
           
           
           <div class="col-12 col-xl-4">
            <div class="card border-top border-4 border-success">
              <div class="card-body p-4">
                <form method="POST" action="lib/pay">
                
                <input type="hidden" name="planid" value="3">
                <div style="display: inline-block; padding: 0.25rem 0.5rem; font-weight: 500; background-color: rgba(0, 123, 255, 0.1); color: #28a745; text-transform: uppercase; text-align: center; border-radius: 0.25rem;">Business Plan</div>
                <div class="my-4">
                   <h3 class="mb-2">Business Pack </h3>
                   <p class="mb-0">Made for Starters</p>
                </div>
                <div class="pricing-content d-flex flex-column gap-3">
                   <div class="d-flex align-items-center justify-content-between">
                    <p class="mb-0 fs-6">📌 No Merchant Required</p>
                   </div>
                   <div class="d-flex align-items-center justify-content-between">
                       <p class="mb-0 fs-6">🔑 Access To Route2 (VIP)</p>
                   </div>
                   <div class="d-flex align-items-center justify-content-between">
                       <p class="mb-0 fs-6">🔑 Realtime Fast Transaction</p>
                   </div>
                   <div class="d-flex align-items-center justify-content-between">
                       <p class="mb-0 fs-6">💼 Automatic Settlement</p>
                   </div>
                   <div class="d-flex align-items-center justify-content-between">
                       <p class="mb-0 fs-6">📲 Accept All UPI Apps</p>
                   </div>
                   <div class="d-flex align-items-center justify-content-between">
                       <p class="mb-0 fs-6">😊 24*7 WhatsApp Support</p>
                   </div>
                </div>
                <div class="price-tag d-flex align-items-center justify-content-center gap-2 my-5">
                  <h5 class="mb-0 align-self-end text-success">₹</h5>
                  <h1 class="mb-0 lh-1 price-amount text-success">899</h1>
                  <h5 class="mb-0 align-self-end text-success">/month</h5>
                </div>
                <div class="d-grid">
                  <button type="submit" name ="buyplan" class="btn btn-lg btn-success">Get Started</button>
                </div>
                </form>
              </div>
            </div>
          </div>
          
          
          
          
          
          
          
          
          <div class="col-12 col-xl-4">
            <div class="card border-top border-4 border-danger">
              <div class="card-body p-4">
                 <form method="POST" action="lib/pay">
                
                <input type="hidden" name="planid" value="4">
                 <div style="display: inline-block; padding: 0.25rem 0.5rem; font-weight: 500; background-color: rgba(255, 0, 123, 0.1); color: #ff007b; text-transform: uppercase; text-align: center; border-radius: 0.25rem;">Premium Plan</div>
                <div class="my-4">
                   <h3 class="mb-2">Enterprise Pack</h3>
                   <p class="mb-0">Made for starters</p>
                </div>
                <div class="pricing-content d-flex flex-column gap-3">
                  <div class="d-flex align-items-center justify-content-between">
                    <p class="mb-0 fs-6">📌 No Merchant Required</p>
                   </div>
                   <div class="d-flex align-items-center justify-content-between">
                       <p class="mb-0 fs-6">🔑 Access To Route2 (VIP)</p>
                   </div>
                   <div class="d-flex align-items-center justify-content-between">
                       <p class="mb-0 fs-6">🔑 Realtime Fast Transaction</p>
                   </div>
                   <div class="d-flex align-items-center justify-content-between">
                       <p class="mb-0 fs-6">💼 Automatic Settlement</p>
                   </div>
                   <div class="d-flex align-items-center justify-content-between">
                       <p class="mb-0 fs-6">📲 Accept All UPI Apps</p>
                   </div>
                   <div class="d-flex align-items-center justify-content-between">
                       <p class="mb-0 fs-6">😊 24*7 WhatsApp Support</p>
                   </div>
                </div>
                <div class="price-tag d-flex align-items-center justify-content-center gap-2 my-5">
                  <h5 class="mb-0 align-self-end text-danger">₹</h5>
                  <h1 class="mb-0 lh-1 price-amount text-danger">1299</h1>
                  <h5 class="mb-0 align-self-end text-danger">/3 Month</h5>
                </div>
                <div class="d-grid">
                <button type="submit" name ="buyplan" class="btn btn-lg btn-success">Get Started</button>
                </div>
                </form>
              </div>
            </div>
          </div>
        </div><!--end row-->
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