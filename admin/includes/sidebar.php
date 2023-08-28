<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sidenav shadow-right sidenav-light">
            <div class="sidenav-menu">
                <div class="nav accordion" id="accordionSidenav">
                    <!-- Sidenav Menu Heading (Account)-->
                    <!-- * * Note: * * Visible only on and above the sm breakpoint-->
                    <div class="sidenav-menu-heading d-sm-none">Account</div>
                    <!-- Sidenav Link (Alerts)-->
                    <!-- * * Note: * * Visible only on and above the sm breakpoint-->
                    <a class="nav-link d-sm-none" href="#!">
                        <div class="nav-link-icon"><i data-feather="bell"></i></div>
                        Alerts
                        <span class="badge bg-warning-soft text-warning ms-auto">4 New!</span>
                    </a>
                    <!-- Sidenav Link (Messages)-->
                    <!-- * * Note: * * Visible only on and above the sm breakpoint-->
                    <a class="nav-link d-sm-none" href="#!">
                        <div class="nav-link-icon"><i data-feather="mail"></i></div>
                        Messages
                        <span class="badge bg-success-soft text-success ms-auto">2 New!</span>
                    </a>
                    <!-- Sidenav Menu Heading (Home)-->
                    <div class="sidenav-menu-heading">Home</div>
                    <!-- Sidenav Accordion (Dashboard)-->
                    <a class="nav-link <?php if (strpos($_SERVER['PHP_SELF'], 'home/index.php') !== false)  { echo 'active'; } ?>" href="../home">
                        <div class="nav-link-icon"><i data-feather="home"></i></div>
                        Dashboard
                    </a>
                    <!-- Sidenav Heading (Users)-->
                    <div class="sidenav-menu-heading">Users</div>
                    <!-- Sidenav Accordion (Pages)-->
                    <a class="nav-link collapsed" href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                        <div class="nav-link-icon"><i data-feather="users"></i></div>
                        Accounts
                        <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapsePages" data-bs-parent="#accordionSidenav">
                        <nav class="sidenav-menu-nested nav accordion" id="accordionSidenavPagesMenu">
                            <!-- Nested Sidenav Accordion (Accounts -> Users)-->
                            <a class="nav-link" href="users">Users</a>
                            <!-- Nested Sidenav Accordion (Accounts -> Client)-->
                            <a class="nav-link" href="client">Client</a>
                        </nav>
                    </div>
                    <!-- Sidenav Heading (Business Tool)-->
                    <div class="sidenav-menu-heading">Business Tool</div>
                    <!-- Sidenav Accordion (Apartment)-->
                    <a class="nav-link collapsed" href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#collapseApartments" aria-expanded="false" aria-controls="collapseApartments">
                        <div class="nav-link-icon"><i class="fas fa-house-user"></i></div>
                        Apartment
                        <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapseApartments" data-bs-parent="#accordionSidenav">
                        <nav class="sidenav-menu-nested nav accordion" id="accordionSidenavApartment">
                            <!-- Nested Sidenav Accordion (Apartment -> Location)-->
                            <a class="nav-link" href="apartment_location">Location</a>
                            <!-- Nested Sidenav Accordion (Apartment -> Property)-->
                            <a class="nav-link" href="apartment_property">Property</a>
                        </nav>
                    </div>
                    <!-- Sidenav Accordion (Boarding House)-->
                    <a class="nav-link collapsed" href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#collapseBHs" aria-expanded="false" aria-controls="collapseBHs">
                        <div class="nav-link-icon"><i class="fas fa-laptop-house"></i></div>
                        Boarding House
                        <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapseBHs" data-bs-parent="#accordionSidenav">
                        <nav class="sidenav-menu-nested nav accordion" id="accordionSidenavBH">
                            <!-- Nested Sidenav Accordion (Boarding House -> Location)-->
                            <a class="nav-link" href="boarding_location">Location</a>
                            <!-- Nested Sidenav Accordion (Boarding House -> Property)-->
                            <a class="nav-link" href="boarding_property">Property</a>
                        </nav>
                    </div>
                    <!-- Sidenav Accordion (Residential Space)-->
                    <a class="nav-link collapsed" href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#collapseRSs" aria-expanded="false" aria-controls="collapseRSs">
                        <div class="nav-link-icon"><i class="fas fa-landmark"></i></div>
                        Residential Space
                        <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapseRSs" data-bs-parent="#accordionSidenav">
                        <nav class="sidenav-menu-nested nav accordion" id="accordionSidenavRS">
                            <!-- Nested Sidenav Accordion (Residential Space -> Location)-->
                            <a class="nav-link" href="residential_location">Location</a>
                            <!-- Nested Sidenav Accordion (Residential Space -> Property)-->
                            <a class="nav-link" href="residential_property">Property</a>
                        </nav>
                    </div>
                    <!-- Sidenav Heading (Payments)-->
                    <div class="sidenav-menu-heading">Payments</div>
                    <!-- Sidenav Accordion (Payments)-->
                    <a class="nav-link collapsed" href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#collapsePayments" aria-expanded="false" aria-controls="collapsePayments">
                        <div class="nav-link-icon"><i class="far fa-address-card"></i></div>
                        Transactions
                        <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapsePayments" data-bs-parent="#accordionSidenav">
                        <nav class="sidenav-menu-nested nav accordion" id="accordionSidenavPayment">
                            <!-- Nested Sidenav Accordion (Payments -> Location)-->
                            <a class="nav-link" href="payment_platform">Payment Platform</a>
                            <!-- Nested Sidenav Accordion (Payments -> Property)-->
                            <a class="nav-link" href="payments">Payments</a>
                        </nav>
                    </div>
                </div>
            </div>
            <!-- Sidenav Footer-->
            <div class="sidenav-footer">
                <?php $userID = $_SESSION['auth_user'] ['user_id']; ?>
                <div class="sidenav-footer-content">
                    <div class="sidenav-footer-subtitle">Logged in as:</div>
                    <div class="sidenav-footer-title"><?php if($userID == 1) { echo 'Administrator'; } elseif ($userID == 2){  echo 'Staff'; } else {  echo 'Client'; } ?></div>
                </div>
            </div>
        </nav>
    </div>
    <div id="layoutSidenav_content">