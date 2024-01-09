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
                    <div class="sb-sidenav-menu-heading">Categories</div>
                    <a class="nav-link <?php if (strpos($_SERVER['PHP_SELF'], 'home/payment_type.php') !== false || strpos($_SERVER['PHP_SELF'], 'home/payment_type_add.php') !== false || strpos($_SERVER['PHP_SELF'], 'home/payment_type_edit.php') !== false || strpos($_SERVER['PHP_SELF'], 'home/property_type.php') !== false || strpos($_SERVER['PHP_SELF'], 'home/property_type_add.php') !== false || strpos($_SERVER['PHP_SELF'], 'home/property_type_edit.php') !== false || strpos($_SERVER['PHP_SELF'], 'home/utility_type.php') !== false || strpos($_SERVER['PHP_SELF'], 'home/utility_type_add.php') !== false || strpos($_SERVER['PHP_SELF'], 'home/utility_type_edit.php') !== false)  {  } else{ echo'collapsed'; } ?>" href="#" data-bs-toggle="collapse" data-bs-target="#collapseCategory" aria-expanded="false" aria-controls="collapseAccounts">
                        <div class="sb-nav-link-icon"><i class="fas fa-list"></i></div>
                        Manage Category
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse <?php if (strpos($_SERVER['PHP_SELF'], 'home/payment_type.php') !== false || strpos($_SERVER['PHP_SELF'], 'home/payment_type_add.php') !== false || strpos($_SERVER['PHP_SELF'], 'home/payment_type_edit.php') !== false || strpos($_SERVER['PHP_SELF'], 'home/property_type.php') !== false || strpos($_SERVER['PHP_SELF'], 'home/property_type_add.php') !== false || strpos($_SERVER['PHP_SELF'], 'home/property_type_edit.php') !== false || strpos($_SERVER['PHP_SELF'], 'home/utility_type.php') !== false || strpos($_SERVER['PHP_SELF'], 'home/utility_type_add.php') !== false || strpos($_SERVER['PHP_SELF'], 'home/utility_type_edit.php') !== false)  { echo'show'; }?>" id="collapseCategory" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link <?php if (strpos($_SERVER['PHP_SELF'], 'home/payment_type.php') !== false || strpos($_SERVER['PHP_SELF'], 'home/payment_type_add.php') !== false || strpos($_SERVER['PHP_SELF'], 'home/payment_type_edit.php') !== false)  { echo 'active'; } ?>" href="payment_type">Payment Type</a>
                            <a class="nav-link <?php if (strpos($_SERVER['PHP_SELF'], 'home/property_type.php') !== false || strpos($_SERVER['PHP_SELF'], 'home/property_type_add.php') !== false || strpos($_SERVER['PHP_SELF'], 'home/property_type_edit.php') !== false)  { echo 'active'; } ?>" href="property_type">Property Type</a>
                            <a class="nav-link <?php if (strpos($_SERVER['PHP_SELF'], 'home/utility_type.php') !== false || strpos($_SERVER['PHP_SELF'], 'home/utility_type_add.php') !== false || strpos($_SERVER['PHP_SELF'], 'home/utility_type_edit.php') !== false)  { echo 'active'; } ?>" href="utility_type">Utility Type</a>
                        </nav>
                    </div>
                    <div class="sb-sidenav-menu-heading">Properties</div>
                    <a class="nav-link <?php if (strpos($_SERVER['PHP_SELF'], 'home/property.php') !== false)  { echo 'active'; } ?>" href="property">
                        <div class="sb-nav-link-icon"><i class="fas fa-house-user"></i></div>
                        Property
                    </a>
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
                    <div class="sb-sidenav-menu-heading">Maintenance</div>
                    <a class="nav-link <?php if (strpos($_SERVER['PHP_SELF'], 'home/database.php') !== false)  { echo 'active'; } ?>" href="database">
                        <div class="sb-nav-link-icon"><i class="fas fa-database"></i></div>
                        Database Management
                    </a>
                    <div class="sb-sidenav-menu-heading">Reports</div>
                    <a class="nav-link <?php if (strpos($_SERVER['PHP_SELF'], 'home/generate_payments.php') !== false || strpos($_SERVER['PHP_SELF'], 'home/generate_utility.php') !== false)  {  } else{ echo'collapsed'; } ?>" href="#" data-bs-toggle="collapse" data-bs-target="#collapseReports" aria-expanded="false" aria-controls="collapseReports">
                        <div class="sb-nav-link-icon"><i class="fas fa-print"></i></div>
                        Generate
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse <?php if (strpos($_SERVER['PHP_SELF'], 'home/generate_payments.php') !== false  || strpos($_SERVER['PHP_SELF'], 'home/generate_utility.php') !== false)  { echo'show'; }?>" id="collapseReports" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link <?php if (strpos($_SERVER['PHP_SELF'], 'home/generate_payments.php') !== false)  { echo 'active'; } ?>" href="generate_payments">Payments</a>
                            <!-- <a class="nav-link <?php if (strpos($_SERVER['PHP_SELF'], 'home/generate_utility.php') !== false)  { echo 'active'; } ?>" href="generate_utility">Utility</a> -->
                        </nav>
                    </div>
                </div>
            </div>
        </nav>
    </div>
    <div id="layoutSidenav_content">