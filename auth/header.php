<?php
// Prevent direct access to this file

include "config.php";
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
$themetouse = $_SESSION['theme']; 
?>


<!doctype html>
<html lang="en" data-bs-theme="<?php echo $themetouse; ?>">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <title>Khilaadixpro | User Dashboard</title>
</head>

<body>

  <!--start header-->
  <header class="top-header">
    <nav class="navbar navbar-expand align-items-center gap-4">
      <div class="btn-toggle">
        <a href="javascript:;"><i class="material-icons-outlined">menu</i></a>
      </div>
      <div class="search-bar flex-grow-1">
        <div class="position-relative">
          <input class="form-control rounded-5 px-5 search-control d-lg-block d-none" type="text" placeholder="Search">
          <span class="material-icons-outlined position-absolute d-lg-block d-none ms-3 translate-middle-y start-0 top-50">search</span>
          <span class="material-icons-outlined position-absolute me-3 translate-middle-y end-0 top-50 search-close">close</span>
          
          <div class="search-popup p-3">
            <div class="card rounded-4 overflow-hidden">
              <div class="card-header d-lg-none">
                <div class="position-relative">
                  <input class="form-control rounded-5 px-5 mobile-search-control" type="text" placeholder="Search">
                  <span class="material-icons-outlined position-absolute ms-3 translate-middle-y start-0 top-50">search</span>
                  <span class="material-icons-outlined position-absolute me-3 translate-middle-y end-0 top-50 mobile-search-close">close</span>
                 </div>
              </div>
              <div class="card-body search-content">
                <p class="search-title">Recent Searches</p>
                <div class="d-flex align-items-start flex-wrap gap-2 kewords-wrapper">
                  <a href="javascript:;" class="kewords"><span>Angular Template</span><i
                      class="material-icons-outlined fs-6">search</i></a>
                </div>
                <hr>
                <p class="search-title">Tutorials</p>
                <div class="search-list d-flex flex-column gap-2">
                  <div class="search-list-item d-flex align-items-center gap-3">
                    <div class="list-icon">
                      <i class="material-icons-outlined fs-5">play_circle</i>
                    </div>
                    <div class="">
                      <h5 class="mb-0 search-list-title ">Wordpress Tutorials</h5>
                    </div>
                  </div>
                  <div class="search-list-item d-flex align-items-center gap-3">
                    <div class="list-icon">
                      <i class="material-icons-outlined fs-5">shopping_basket</i>
                    </div>
                    <div class="">
                      <h5 class="mb-0 search-list-title">eCommerce Website Tutorials</h5>
                    </div>
                  </div>
  
                  <div class="search-list-item d-flex align-items-center gap-3">
                    <div class="list-icon">
                      <i class="material-icons-outlined fs-5">laptop</i>
                    </div>
                    <div class="">
                      <h5 class="mb-0 search-list-title">Responsive Design</h5>
                    </div>
                  </div>
                </div>
  
                <hr>
                <p class="search-title">Members</p>
  
                <div class="search-list d-flex flex-column gap-2">
                  <div class="search-list-item d-flex align-items-center gap-3">
                    <div class="memmber-img">
                      <img src="assets/images/avatars/01.png" width="32" height="32" class="rounded-circle" alt="">
                    </div>
                    <div class="">
                      <h5 class="mb-0 search-list-title ">Andrew Stark</h5>
                    </div>
                  </div>
  
                  
  
                </div>
              </div>
              <div class="card-footer text-center bg-transparent">
                <a href="javascript:;" class="btn w-100">See All Search Results</a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <ul class="navbar-nav gap-1 nav-right-links align-items-center">
        <li class="nav-item d-lg-none mobile-search-btn">
          <a class="nav-link" href="javascript:;"><i class="material-icons-outlined">search</i></a>
        </li>
        
             <li class="nav-item dropdown position-static">
             <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="javascript:;">
             <i class="material-icons-outlined">done_all</i>
             </a>
             <div class="dropdown-menu dropdown-menu-end mega-menu shadow-lg p-4 p-lg-5">
             <div class="mega-menu-widgets">
            <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3 g-4 g-lg-5">
                     <!-- Your content here -->
            </div><!--end row-->
                  </div>
                  </div>
                 </li>

        
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" data-bs-auto-close="outside"
            data-bs-toggle="dropdown" href="javascript:;"><i class="material-icons-outlined">apps</i></a>
          <div class="dropdown-menu dropdown-menu-end dropdown-apps shadow-lg p-3">
            <div class="border rounded-4 overflow-hidden">
              <div class="row row-cols-3 g-0 border-bottom">
                <div class="col border-end">
                  <div class="app-wrapper d-flex flex-column gap-2 text-center">
                    <div class="app-icon">
                      <img src="assets/images/apps/01.png" width="36" alt="">
                    </div>
                    <div class="app-name">
                      <p class="mb-0">Gmail</p>
                    </div>
                  </div>
                </div>
                <div class="col border-end">
                  <div class="app-wrapper d-flex flex-column gap-2 text-center">
                    <div class="app-icon">
                      <img src="assets/images/apps/02.png" width="36" alt="">
                    </div>
                    <div class="app-name">
                      <p class="mb-0">Skype</p>
                    </div>
                  </div>
                </div>
                <div class="col">
                  <div class="app-wrapper d-flex flex-column gap-2 text-center">
                    <div class="app-icon">
                      <img src="assets/images/apps/03.png" width="36" alt="">
                    </div>
                    <div class="app-name">
                      <p class="mb-0">Slack</p>
                    </div>
                  </div>
                </div>
              </div><!--end row-->

              <div class="row row-cols-3 g-0 border-bottom">
                <div class="col border-end">
                  <div class="app-wrapper d-flex flex-column gap-2 text-center">
                    <div class="app-icon">
                      <img src="assets/images/apps/04.png" width="36" alt="">
                    </div>
                    <div class="app-name">
                      <p class="mb-0">YouTube</p>
                    </div>
                  </div>
                </div>
                <div class="col border-end">
                  <div class="app-wrapper d-flex flex-column gap-2 text-center">
                    <div class="app-icon">
                      <img src="assets/images/apps/05.png" width="36" alt="">
                    </div>
                    <div class="app-name">
                      <p class="mb-0">Google</p>
                    </div>
                  </div>
                </div>
                <div class="col">
                  <div class="app-wrapper d-flex flex-column gap-2 text-center">
                    <div class="app-icon">
                      <img src="assets/images/apps/06.png" width="36" alt="">
                    </div>
                    <div class="app-name">
                      <p class="mb-0">Instagram</p>
                    </div>
                  </div>
                </div>
              </div><!--end row-->

              <div class="row row-cols-3 g-0 border-bottom">
                <div class="col border-end">
                  <div class="app-wrapper d-flex flex-column gap-2 text-center">
                    <div class="app-icon">
                      <img src="assets/images/apps/07.png" width="36" alt="">
                    </div>
                    <div class="app-name">
                      <p class="mb-0">Spotify</p>
                    </div>
                  </div>
                </div>
                <div class="col border-end">
                  <div class="app-wrapper d-flex flex-column gap-2 text-center">
                    <div class="app-icon">
                      <img src="assets/images/apps/08.png" width="36" alt="">
                    </div>
                    <div class="app-name">
                      <p class="mb-0">Yahoo</p>
                    </div>
                  </div>
                </div>
                <div class="col">
                  <div class="app-wrapper d-flex flex-column gap-2 text-center">
                    <div class="app-icon">
                      <img src="assets/images/apps/09.png" width="36" alt="">
                    </div>
                    <div class="app-name">
                      <p class="mb-0">Facebook</p>
                    </div>
                  </div>
                </div>
              </div><!--end row-->

              <div class="row row-cols-3 g-0">
                <div class="col border-end">
                  <div class="app-wrapper d-flex flex-column gap-2 text-center">
                    <div class="app-icon">
                      <img src="assets/images/apps/10.png" width="36" alt="">
                    </div>
                    <div class="app-name">
                      <p class="mb-0">Figma</p>
                    </div>
                  </div>
                </div>
                <div class="col border-end">
                  <div class="app-wrapper d-flex flex-column gap-2 text-center">
                    <div class="app-icon">
                      <img src="assets/images/apps/11.png" width="36" alt="">
                    </div>
                    <div class="app-name">
                      <p class="mb-0">Paypal</p>
                    </div>
                  </div>
                </div>
                <div class="col">
                  <div class="app-wrapper d-flex flex-column gap-2 text-center">
                    <div class="app-icon">
                      <img src="assets/images/apps/12.png" width="36" alt="">
                    </div>
                    <div class="app-name">
                      <p class="mb-0">Photo</p>
                    </div>
                  </div>
                </div>
              </div><!--end row-->
            </div>
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative" data-bs-auto-close="outside"
            data-bs-toggle="dropdown" href="javascript:;"><i class="material-icons-outlined">notifications</i>
            <span class="badge-notify">5</span>
          </a>
          <div class="dropdown-menu dropdown-notify dropdown-menu-end shadow">
            <div class="px-3 py-1 d-flex align-items-center justify-content-between border-bottom">
              <h5 class="notiy-title mb-0">Notifications</h5>
              <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle dropdown-toggle-nocaret option" type="button"
                  data-bs-toggle="dropdown" aria-expanded="false">
                  <span class="material-icons-outlined">
                    more_vert
                  </span>
                </button>
                <div class="dropdown-menu dropdown-option dropdown-menu-end shadow">
                  <div><a class="dropdown-item d-flex align-items-center gap-2 py-2" href="javascript:;"><i
                        class="material-icons-outlined fs-6">inventory_2</i>Archive All</a></div>
                  <div><a class="dropdown-item d-flex align-items-center gap-2 py-2" href="javascript:;"><i
                        class="material-icons-outlined fs-6">done_all</i>Mark all as read</a></div>
                  <div><a class="dropdown-item d-flex align-items-center gap-2 py-2" href="javascript:;"><i
                        class="material-icons-outlined fs-6">mic_off</i>Disable Notifications</a></div>
                  <div><a class="dropdown-item d-flex align-items-center gap-2 py-2" href="javascript:;"><i
                        class="material-icons-outlined fs-6">grade</i>What's new ?</a></div>
                  <div>
                    <hr class="dropdown-divider">
                  </div>
                  <div><a class="dropdown-item d-flex align-items-center gap-2 py-2" href="javascript:;"><i
                        class="material-icons-outlined fs-6">leaderboard</i>Reports</a></div>
                </div>
              </div>
            </div>
            <div class="notify-list">
              <div>
                <a class="dropdown-item border-bottom py-2" href="javascript:;">
                  <div class="d-flex align-items-center gap-3">
                    <div class="">
                      <img src="assets/images/avatars/01.png" class="rounded-circle" width="45" height="45" alt="">
                    </div>
                    <div class="">
                      <h5 class="notify-title">Congratulations Jhon</h5>
                      <p class="mb-0 notify-desc">Many congtars jhon. You have won the gifts.</p>
                      <p class="mb-0 notify-time">Today</p>
                    </div>
                    <div class="notify-close position-absolute end-0 me-3">
                      <i class="material-icons-outlined fs-6">close</i>
                    </div>
                  </div>
                </a>
              </div>
              <div>
                <a class="dropdown-item border-bottom py-2" href="javascript:;">
                  <div class="d-flex align-items-center gap-3">
                    <div class="user-wrapper bg-primary text-primary bg-opacity-10">
                      <span>RS</span>
                    </div>
                    <div class="">
                      <h5 class="notify-title">New Account Created</h5>
                      <p class="mb-0 notify-desc">From USA an user has registered.</p>
                      <p class="mb-0 notify-time">Yesterday</p>
                    </div>
                    <div class="notify-close position-absolute end-0 me-3">
                      <i class="material-icons-outlined fs-6">close</i>
                    </div>
                  </div>
                </a>
              </div>
              <div>
                <a class="dropdown-item border-bottom py-2" href="javascript:;">
                  <div class="d-flex align-items-center gap-3">
                    <div class="">
                      <img src="assets/images/apps/13.png" class="rounded-circle" width="45" height="45" alt="">
                    </div>
                    <div class="">
                      <h5 class="notify-title">Payment Recived</h5>
                      <p class="mb-0 notify-desc">New payment recived successfully</p>
                      <p class="mb-0 notify-time">1d ago</p>
                    </div>
                    <div class="notify-close position-absolute end-0 me-3">
                      <i class="material-icons-outlined fs-6">close</i>
                    </div>
                  </div>
                </a>
              </div>
              <div>
                <a class="dropdown-item border-bottom py-2" href="javascript:;">
                  <div class="d-flex align-items-center gap-3">
                    <div class="">
                      <img src="assets/images/apps/14.png" class="rounded-circle" width="45" height="45" alt="">
                    </div>
                    <div class="">
                      <h5 class="notify-title">New Order Recived</h5>
                      <p class="mb-0 notify-desc">Recived new order from michle</p>
                      <p class="mb-0 notify-time">2:15 AM</p>
                    </div>
                    <div class="notify-close position-absolute end-0 me-3">
                      <i class="material-icons-outlined fs-6">close</i>
                    </div>
                  </div>
                </a>
              </div>
              <div>
                <a class="dropdown-item border-bottom py-2" href="javascript:;">
                  <div class="d-flex align-items-center gap-3">
                    <div class="">
                      <img src="assets/images/avatars/06.png" class="rounded-circle" width="45" height="45" alt="">
                    </div>
                    <div class="">
                      <h5 class="notify-title">Congratulations Jhon</h5>
                      <p class="mb-0 notify-desc">Many congtars jhon. You have won the gifts.</p>
                      <p class="mb-0 notify-time">Today</p>
                    </div>
                    <div class="notify-close position-absolute end-0 me-3">
                      <i class="material-icons-outlined fs-6">close</i>
                    </div>
                  </div>
                </a>
              </div>
              <div>
                <a class="dropdown-item py-2" href="javascript:;">
                  <div class="d-flex align-items-center gap-3">
                    <div class="user-wrapper bg-danger text-danger bg-opacity-10">
                      <span>PK</span>
                    </div>
                    <div class="">
                      <h5 class="notify-title">New Account Created</h5>
                      <p class="mb-0 notify-desc">From USA an user has registered.</p>
                      <p class="mb-0 notify-time">Yesterday</p>
                    </div>
                    <div class="notify-close position-absolute end-0 me-3">
                      <i class="material-icons-outlined fs-6">close</i>
                    </div>
                  </div>
                </a>
              </div>
            </div>
          </div>
        </li>
        <li class="nav-item dropdown">
          <a href="javascrpt:;" class="dropdown-toggle dropdown-toggle-nocaret" data-bs-toggle="dropdown">
             <img src="assets/images/avatars/01.png" class="rounded-circle p-1 border" width="45" height="45">
          </a>
          <div class="dropdown-menu dropdown-user dropdown-menu-end shadow">
            <a class="dropdown-item  gap-2 py-2" href="javascript:;">
              <div class="text-center">
                <img src="assets/images/avatars/01.png" class="rounded-circle p-1 shadow mb-3" width="90" height="90"
                  alt="">
                <h5 class="user-name mb-0 fw-bold"><?php echo $_SESSION['company_name'];?></h5>
              </div>
            </a>
            <hr class="dropdown-divider">
<a class="dropdown-item d-flex align-items-center gap-2 py-2" href="settings"><i class="material-icons-outlined">person_outline</i>Profile</a>
<a class="dropdown-item d-flex align-items-center gap-2 py-2" href="settings"><i class="material-icons-outlined">local_bar</i>Setting</a>
<a class="dropdown-item d-flex align-items-center gap-2 py-2" href="dashboard"><i class="material-icons-outlined">dashboard</i>Dashboard</a>
<a class="dropdown-item d-flex align-items-center gap-2 py-2" href="vip"><i class="material-icons-outlined">account_balance</i>Earning</a>
<a class="dropdown-item d-flex align-items-center gap-2 py-2" href="plugin"><i class="material-icons-outlined">cloud_download</i>Downloads</a>
<hr class="dropdown-divider">

            <a class="dropdown-item d-flex align-items-center gap-2 py-2" href="logout"><i
            class="material-icons-outlined">power_settings_new</i>Logout</a>
          </div>
        </li>
      </ul>

    </nav>
  </header>
  <!--end top header-->


  <!--start sidebar-->
  <aside class="sidebar-wrapper">
    <div class="sidebar-header">
      <div class="logo-icon">
        <img src="assets/images/logo-icon.png" class="logo-img" alt="">
      </div>
      <div class="logo-name flex-grow-1">
        <h5 class="mb-0">Byte Pay</h5>
      </div>
      <div class="sidebar-close">
        <span class="material-icons-outlined">close</span>
      </div>
    </div>
    <div class="sidebar-nav" data-simplebar="true">
      
        <!--navigation-->
        <ul class="metismenu" id="sidenav">
         <li>
    <a href="dashboard">
        <div class="parent-icon"><i class="material-icons-outlined">home</i></div>
        <div class="menu-title">Dashboard</div>
    </a>
</li>

          <li class="menu-label">Services</li>
        
          
          <li>
            <a href="javascript:;" class="has-arrow">
              <div class="parent-icon"><i class="material-icons-outlined">payment</i>
              </div>
              <div class="menu-title">Pay</div>
            </a>
            <ul>
              </li>
              <li><a href="pay-to-bank"><i class="material-icons-outlined">arrow_right</i>Pay To Bank</a>
              </li>
              <li><a href="pay-to-upi"><i class="material-icons-outlined">arrow_right</i>Pay To Upi</a>
              </li>
               <li><a href="pay-to-user"><i class="material-icons-outlined">arrow_right</i>Pay To User</a>
              </li>
            </ul>     
          </li>
          
           <li>
            <a href="javascript:;" class="has-arrow">
              <div class="parent-icon"><i class="material-icons-outlined">inventory_2</i>
              </div>
              <div class="menu-title">Payout History</div>
            </a>
            <ul>
              <li><a href="payouts-upi"><i class="material-icons-outlined">arrow_right</i>Upi Payouts</a>
              </li>
              <li><a href="payouts-bank"><i class="material-icons-outlined">arrow_right</i>Bank Payouts</a>
              </li>
            </ul>     
          </li>
           
          <li>
    <a class="has-arrow" href="javascript:;">
        <div class="parent-icon"><i class="material-icons-outlined">history</i></div>
        <div class="menu-title">History</div>
    </a>
    <ul>
        <li><a href="transactions"><i class="material-icons-outlined">arrow_right</i>Payment History</a></li>
        <li><a href="wallet-transactions"><i class="material-icons-outlined">arrow_right</i>Wallet History</a></li>
    </ul>
</li>

           
          <li>
            <a class="has-arrow" href="javascript:;">
              <div class="parent-icon"><i class="material-icons-outlined">card_giftcard</i>
              </div>
              <div class="menu-title">Gift</div>
            </a>
            <ul>
              <li><a href="gift-claim"><i class="material-icons-outlined">arrow_right</i>Reedem</a>
              </li>
              <li><a href="component-accordions.html"><i class="material-icons-outlined">arrow_right</i>Transfer</a>
              </li>
            </ul>
          </li>
          
          <li>
  <a href="paylink">
    <div class="parent-icon"><i class="material-icons-outlined">receipt</i></div>
    <div class="menu-title">Pay Link</div>
  </a>
</li>

        
          
          
          
        
          
          
          <li class="menu-label">Tools & Materials</li>
          
          <li>
  <a href="subscription">
    <div class="parent-icon"><i class="material-icons-outlined">subscriptions</i></div>
    <div class="menu-title">Subscription</div>
  </a>
</li>

          
          
      
          <li>
            <a href="upisettings">
              <div class="parent-icon"><i class="material-icons-outlined">settings_remote</i>
              </div>
              <div class="menu-title">Upi Settings</div>
            </a>
          </li>
          <li>
          
          
          
           <li>
            <a href="#" class="has-arrow">
              <div class="parent-icon"><i class="material-icons-outlined">description</i>
              </div>
              <div class="menu-title">Documentation</div>
            </a>
            <ul>
              <li><a href="docs-payin"><i class="material-icons-outlined">arrow_right</i>PayIn Docs</a>
              </li>
              <li><a href="docs-payout"><i class="material-icons-outlined">arrow_right</i>Payout Docs</a>
              </li>
            </ul>     
          </li>
          
          
          
          <li>
            <a href="plugin">
              <div class="parent-icon"><i class="material-icons-outlined">code</i>
              </div>
              <div class="menu-title">SDK</div>
            </a>
          </li>
          <li>
            <a href="https://t.me/Khilaadixpro_bot">
              <div class="parent-icon"><i class="material-icons-outlined">support_agent</i>
              </div>
              <div class="menu-title">Support</div>
            </a>
          </li>
          
         
          
        
        
          <li class="menu-label">Settings Area</li>
          
          <li>
            <a href="javascript:;" class="has-arrow">
              <div class="parent-icon"><i class="material-icons-outlined">settings</i>
              </div>
              <div class="menu-title">Settings</div>
            </a>
            <ul>
              <li><a href="settings"><i class="material-icons-outlined">arrow_right</i>My Profile</a>
              </li>
              <li><a href="apidetails"><i class="material-icons-outlined">arrow_right</i>Api Keys</a>
              </li>
            </ul>     
          </li>
          
           <li>
            <a href="vip">
              <div class="parent-icon"><i class="material-icons-outlined">domain</i>
              </div>
              <div class="menu-title">Vip Profile</div>
            </a>
          </li>
          
         
          <li>
            <a href="2fa">
              <div class="parent-icon"><i class="material-icons-outlined">verified_user</i>
              </div>
              <div class="menu-title">2FA</div>
            </a>
          </li>
          
          <li>
            <a href="faq">
              <div class="parent-icon"><i class="material-icons-outlined">help_outline</i>
              </div>
              <div class="menu-title">FAQ</div>
            </a>
          </li>
         
         
          <li class="menu-label">Others</li>
          
           <li>
            <a href="notifications">
              <div class="parent-icon"><i class="material-icons-outlined">notifications</i>
              </div>
              <div class="menu-title">Notifications</div>
            </a>
          </li>
       
       
          <li>
            <a href="sync">
              <div class="parent-icon"><i class="material-icons-outlined">autorenew</i>
              </div>
              <div class="menu-title">Sync Panel</div>
            </a>
          </li>
          
      <!--
<li>
  <a href="control">
    <div class="parent-icon"><i class="material-icons-outlined">build</i></div>
    <div class="menu-title">Control Panel</div>
  </a>
</li>

<li>
  <a href="paygram">
    <div class="parent-icon"><i class="material-icons-outlined">account_tree</i></div>
    <div class="menu-title">PayGram</div>
  </a>
</li>
-->

          
          <li>
            <a href="https://www.youtube.com/channel/UCuTLVCB9nEw9wqQYNClcZ7g">
              <div class="parent-icon"><i class="material-icons-outlined">info</i>
              </div>
              <div class="menu-title">Resource Center</div>
            </a>
          </li>
         </ul>
        <!--end navigation-->
    </div>
    <div class="sidebar-bottom gap-4">
        <div class="dark-mode">
          <a href="javascript:;" class="footer-icon dark-mode-icon">
            <i class="material-icons-outlined">dark_mode</i>  
          </a>
        </div>
        <div class="dropdown dropup-center dropup dropdown-laungauge">
          <a class="dropdown-toggle dropdown-toggle-nocaret footer-icon" href="avascript:;" data-bs-toggle="dropdown"><img src="assets/images/county/08.png" width="22" alt="">
          </a>
          <ul class="dropdown-menu dropdown-menu-end">
            <li><a class="dropdown-item d-flex align-items-center py-2" href="javascript:;"><img src="assets/images/county/08.png" width="20" alt=""><span class="ms-2">English</span></a>
            </li>
          </ul>
        </div>
        <div class="dropdown dropup-center dropup dropdown-help">
          <a class="footer-icon  dropdown-toggle dropdown-toggle-nocaret option" href="javascript:;"
            data-bs-toggle="dropdown" aria-expanded="false">
            <span class="material-icons-outlined">
              info
            </span>
          </a>
          <div class="dropdown-menu dropdown-option dropdown-menu-end shadow">
            <div><a class="dropdown-item d-flex align-items-center gap-2 py-2" href="javascript:;"><i
                  class="material-icons-outlined fs-6">inventory_2</i>Archive All</a></div>
            <div><a class="dropdown-item d-flex align-items-center gap-2 py-2" href="javascript:;"><i
                  class="material-icons-outlined fs-6">mic_off</i>Disable Notifications</a></div>
            <div><a class="dropdown-item d-flex align-items-center gap-2 py-2" href="javascript:;"><i
                  class="material-icons-outlined fs-6">grade</i>What's new ?</a></div>
            <div>
              <hr class="dropdown-divider">
            </div>
            <div><a class="dropdown-item d-flex align-items-center gap-2 py-2" href="javascript:;"><i
                  class="material-icons-outlined fs-6">leaderboard</i>Reports</a></div>
          </div>
        </div>

    </div>
</aside>
<!--end sidebar-->





  <!--start overlay-->
    <div class="overlay btn-toggle"></div>
  <!--end overlay-->

 <!--start footer-->
 <footer class="page-footer">
  <p class="mb-0">Copyright © 2024. All right reserved.</p>
</footer>
<!--top footer-->

 

  <!--start switcher-->
  <button class="btn btn-primary position-fixed bottom-0 end-0 m-3 d-flex align-items-center gap-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#staticBackdrop">
    <i class="material-icons-outlined">tune</i>Customize
  </button>
  
  <div class="offcanvas offcanvas-end" data-bs-scroll="true" tabindex="-1" id="staticBackdrop">
    <div class="offcanvas-header border-bottom h-70">
      <div class="">
        <h5 class="mb-0">Theme Customizer</h5>
        <p class="mb-0">Customize your theme</p>
      </div>
      <a href="javascript:;" class="primaery-menu-close" data-bs-dismiss="offcanvas">
        <i class="material-icons-outlined">close</i>
      </a>
    </div>
    <div class="offcanvas-body">
      <div>
        <p>Theme variation</p>

        <div class="row g-3">
          <div class="col-12 col-xl-6">
            <input type="radio" class="btn-check" name="theme-options" id="LightTheme" checked>
            <label class="btn btn-outline-secondary d-flex flex-column gap-1 align-items-center justify-content-center p-4" for="LightTheme">
              <span class="material-icons-outlined">light_mode</span>
              <span>Light</span>
            </label>
          </div>
          <div class="col-12 col-xl-6">
            <input type="radio" class="btn-check" name="theme-options" id="DarkTheme">
            <label class="btn btn-outline-secondary d-flex flex-column gap-1 align-items-center justify-content-center p-4" for="DarkTheme">
              <span class="material-icons-outlined">dark_mode</span>
              <span>Dark</span>
            </label>
          </div>
          <div class="col-12 col-xl-6">
            <input type="radio" class="btn-check" name="theme-options" id="SemiDarkTheme">
            <label class="btn btn-outline-secondary d-flex flex-column gap-1 align-items-center justify-content-center p-4" for="SemiDarkTheme">
              <span class="material-icons-outlined">contrast</span>
              <span>Semi Dark</span>
            </label>
          </div>
          <div class="col-12 col-xl-6">
            <input type="radio" class="btn-check" name="theme-options" id="BoderedTheme">
            <label class="btn btn-outline-secondary d-flex flex-column gap-1 align-items-center justify-content-center p-4" for="BoderedTheme">
              <span class="material-icons-outlined">border_style</span>
              <span>Bordered</span>
            </label>
          </div>
        </div><!--end row-->

      </div>
    </div>
  </div>
  <!--start switcher-->


  


<!--/body-->

<!--/html-->