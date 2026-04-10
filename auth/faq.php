<?php


// Define the absolute path to the functions.php file
define('ABSPATH', dirname(__FILE__) . '/'); // Adjust the path as needed

require_once(ABSPATH . 'header.php');

?>

<?php
$folderPath = 'temp_dir/';

// Function to check if a file name starts with a letter from A to Z
function startsWithLetter($filename) {
    return preg_match('/^[A-Za-z]/', basename($filename));
}

// Get all files in the folder
$files = glob($folderPath . '*');

$filesDeleted = false; // Variable to keep track of whether any files were deleted

// Loop through the files and remove those that start with a letter from A to Z or are zip files
foreach ($files as $file) {
    if (is_file($file) && (startsWithLetter($file) || pathinfo($file, PATHINFO_EXTENSION) === 'zip')) {
        // Use unlink to remove the file
        if (unlink($file)) {
            $filesDeleted = true; // Set the flag to true if any file is deleted
            //echo "Deleted file: " . basename($file) . "\n";
        }
    }
}

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
  <link  rel="stylesheet" type="text/css" href="assets/plugins/simplebar/css/simplebar.css">
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
					<div class="breadcrumb-title pe-3">Settings</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">Faq</li>
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
					<div class="col-12 col-lg-12">
						<h6 class="mb-0 text-uppercase">General Questions & Answer</h6>
						<hr>
						<div class="card">
							<div class="card-body">
								<h3>1. Khud Developer Hire Karo:</h3>
                <p>- Har subscriber ko apne integration ke liye apna developer hire karna hoga. 🛠️</p>
                <p>- Kisi bhi tarah ki coding help hamari team nahi degi.</p>
           
            
                <h3>2. Documentation Hi Sab Kuch Hai:</h3>
                <p>- Hamari documentation itni detailed hai ki koi bhi qualified developer integration kar sakta hai.</p>
                <p>- Agar developer ko documentation samajh nahi aati, toh yeh unka apna samasya hai. 📚</p>
            
            
                <h3>3. Developer Ka Full Knowledge Hona Chahiye:</h3>
                <p>- Developer ko jo hire kiya jaaye, unko pura integration ka gyaan hona chahiye.</p>
                <p>- Adhe gyaan wale developers ke saath hamara waqt barbaad nahi hoga. 🤦‍♂️</p>
            
            
                <h3>4. No Direct Support:</h3>
                <p>- Hamari team se koi bhi direct support nahi milegi, sirf documentation ka sahara hoga. 📄</p>
            
            
                <h3>5. Subscription ka Matlab Integration Nahi:</h3>
                <p>- Subscription lene se sirf payment gateway ka access milega, integration nahi.</p>
                <p>- Integration customer ya unke developer ka jimmedari hai, humara nahi. ❌</p>
            
            
                <h3>6. Strict Non-Interference Policy:</h3>
                <p>- Agar developer ko integration nahi aata, toh customer ko doosra developer hire karna padega.</p>
                <p>- Hamara kaam sirf payment gateway provide karna hai, integration ka nahi. 🛑</p>
            
            
                <h3>7. Integration Testing:</h3>
                <p>- Integration complete hone ke baad testing ka kaam customer ko karna hoga.</p>
                <p>- Hamari team testing aur debugging nahi karegi. 🧪</p>
            
            
                <h3>8. Pre-Sales Consultation:</h3>
                <p>- Kisi bhi shanka ya sawal ke liye, subscription lene se pehle pre-sales consultation le sakte hain.</p>
                <p>- Integration na ho paane par refund nahi milega. 🏷️</p>
            
            
                <h3>9. Integration Fees:</h3>
                <p>- Agar kisi customer ko hamari team se integration ki suvidha chahiye, toh additional fees charge hogi.</p>
                <p>- Ye fees subscription plan ke alawa hogi. 💸</p>
							</div>
						</div>


					</div>
				</div>
				<!--end row-->
    </div>
  </main>
  <!--end main wrapper-->
  
  
  <!--start switcher-->

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