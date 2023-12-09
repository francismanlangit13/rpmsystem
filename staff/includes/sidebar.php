<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark bg-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">
                    <div class="sb-sidenav-menu-heading">Home</div>
                    <a class="nav-link <?php if (strpos($_SERVER['PHP_SELF'], 'home/index.php') !== false)  { echo 'active'; } ?>" href="../home">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Dashboard
                    </a>
                    <a class="nav-link <?php if (strpos($_SERVER['PHP_SELF'], 'home/notification.php') !== false)  { echo 'active'; } ?>" href="notification">
                        <div class="sb-nav-link-icon"><i class="fas fa-bell"></i></div>
                        Notification
                    </a>
                    <div class="sb-sidenav-menu-heading">Billing</div>
                    <a class="nav-link <?php if (strpos($_SERVER['PHP_SELF'], 'home/payment.php') !== false)  { echo 'active'; } ?>" href="payment">
                        <div class="sb-nav-link-icon"><i class="fas fa-file-invoice"></i></div>
                        Payments
                    </a>
                    <a class="nav-link <?php if (strpos($_SERVER['PHP_SELF'], 'home/utilities.php') !== false)  { echo 'active'; } ?>" href="utilities">
                        <div class="sb-nav-link-icon"><i class="fas fa-receipt"></i></div>
                        Other Bills
                    </a>
                    <div class="sb-sidenav-menu-heading">Reports</div>
                    <a class="nav-link <?php if (strpos($_SERVER['PHP_SELF'], 'home/generate_payments.php') !== false || strpos($_SERVER['PHP_SELF'], 'home/generate_utilities.php') !== false)  {  } else{ echo'collapsed'; } ?>" href="#" data-bs-toggle="collapse" data-bs-target="#collapseReports" aria-expanded="false" aria-controls="collapseReports">
                        <div class="sb-nav-link-icon"><i class="fas fa-print"></i></div>
                        Generate
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse <?php if (strpos($_SERVER['PHP_SELF'], 'home/generate_payments.php') !== false  || strpos($_SERVER['PHP_SELF'], 'home/generate_utilities.php') !== false)  { echo'show'; }?>" id="collapseReports" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link <?php if (strpos($_SERVER['PHP_SELF'], 'home/generate_payments.php') !== false)  { echo 'active'; } ?>" href="generate_payments">Payments</a>
                            <a class="nav-link <?php if (strpos($_SERVER['PHP_SELF'], 'home/generate_utilities.php') !== false)  { echo 'active'; } ?>" href="generate_utilities">Utilities</a>
                        </nav>
                    </div>
                </div>
            </div>
        </nav>
    </div>
    <div id="layoutSidenav_content">