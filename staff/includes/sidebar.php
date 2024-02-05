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
                    <div class="sb-sidenav-menu-heading">Accounts</div>
                    <a class="nav-link <?php if (strpos($_SERVER['PHP_SELF'], 'home/user.php') !== false || strpos($_SERVER['PHP_SELF'], 'home/user_add.php') !== false || strpos($_SERVER['PHP_SELF'], 'home/user_edit.php') !== false || strpos($_SERVER['PHP_SELF'], 'home/user_view.php') !== false)  {  } else{ echo'collapsed'; } ?>" href="#" data-bs-toggle="collapse" data-bs-target="#collapseAccounts" aria-expanded="false" aria-controls="collapseAccounts">
                        <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                        Accounts
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse <?php if (strpos($_SERVER['PHP_SELF'], 'home/user.php') !== false || strpos($_SERVER['PHP_SELF'], 'home/user_add.php') !== false || strpos($_SERVER['PHP_SELF'], 'home/user_edit.php') !== false || strpos($_SERVER['PHP_SELF'], 'home/user_view.php') !== false)  { echo'show'; }?>" id="collapseAccounts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link <?php if (strpos($_SERVER['PHP_SELF'], 'home/user.php') !== false || strpos($_SERVER['PHP_SELF'], 'home/user_add.php') !== false || strpos($_SERVER['PHP_SELF'], 'home/user_edit.php') !== false || strpos($_SERVER['PHP_SELF'], 'home/user_view.php') !== false)  { echo 'active'; } ?>" href="user">Users</a>
                        </nav>
                    </div>
                    <a class="nav-link <?php if (strpos($_SERVER['PHP_SELF'], 'home/rentee.php') !== false)  { echo 'active'; } ?>" href="rentee">
                        <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
                        Rentee
                    </a>
                    <div class="sb-sidenav-menu-heading">Billing</div>
                    <a class="nav-link <?php if (strpos($_SERVER['PHP_SELF'], 'home/payment.php') !== false)  { echo 'active'; } ?>" href="payment">
                        <div class="sb-nav-link-icon"><i class="fas fa-file-invoice"></i></div>
                        Payments
                    </a>
                    <a class="nav-link <?php if (strpos($_SERVER['PHP_SELF'], 'home/utility.php') !== false)  { echo 'active'; } ?>" href="utility">
                        <div class="sb-nav-link-icon"><i class="fas fa-receipt"></i></div>
                        Manage Bills
                    </a>
                    <div class="sb-sidenav-menu-heading">Reports</div>
                    <a class="nav-link <?php if (strpos($_SERVER['PHP_SELF'], 'home/generate_payments.php') !== false || strpos($_SERVER['PHP_SELF'], 'home/generate_users.php') !== false || strpos($_SERVER['PHP_SELF'], 'home/generate_utility.php') !== false  || strpos($_SERVER['PHP_SELF'], 'home/generate_invoice.php') !== false || strpos($_SERVER['PHP_SELF'], 'home/generate_property.php') !== false || strpos($_SERVER['PHP_SELF'], 'home/generate_arrears.php') !== false)  {  } else{ echo'collapsed'; } ?>" href="#" data-bs-toggle="collapse" data-bs-target="#collapseReports" aria-expanded="false" aria-controls="collapseReports">
                        <div class="sb-nav-link-icon"><i class="fas fa-print"></i></div>
                        Generate
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse <?php if (strpos($_SERVER['PHP_SELF'], 'home/generate_payments.php') !== false || strpos($_SERVER['PHP_SELF'], 'home/generate_users.php') !== false || strpos($_SERVER['PHP_SELF'], 'home/generate_utility.php') !== false  || strpos($_SERVER['PHP_SELF'], 'home/generate_invoice.php') !== false || strpos($_SERVER['PHP_SELF'], 'home/generate_property.php') !== false || strpos($_SERVER['PHP_SELF'], 'home/generate_arrears.php') !== false)  { echo'show'; }?>" id="collapseReports" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link <?php if (strpos($_SERVER['PHP_SELF'], 'home/generate_arrears.php') !== false)  { echo 'active'; } ?>" href="generate_arrears">Arrears</a>
                            <a class="nav-link <?php if (strpos($_SERVER['PHP_SELF'], 'home/generate_utility.php') !== false)  { echo 'active'; } ?>" href="generate_utility">Bills</a>
                            <a class="nav-link <?php if (strpos($_SERVER['PHP_SELF'], 'home/generate_invoice.php') !== false)  { echo 'active'; } ?>" href="generate_invoice">Invoice</a>
                            <a class="nav-link <?php if (strpos($_SERVER['PHP_SELF'], 'home/generate_payments.php') !== false)  { echo 'active'; } ?>" href="generate_payments">Payments</a>
                            <a class="nav-link <?php if (strpos($_SERVER['PHP_SELF'], 'home/generate_property.php') !== false)  { echo 'active'; } ?>" href="generate_property">Property</a>
                            <a class="nav-link <?php if (strpos($_SERVER['PHP_SELF'], 'home/generate_users.php') !== false)  { echo 'active'; } ?>" href="generate_users">Users</a>
                        </nav>
                    </div>
                </div>
            </div>
        </nav>
    </div>
    <div id="layoutSidenav_content">