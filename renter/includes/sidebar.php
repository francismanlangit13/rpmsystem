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
                    <div class="sb-sidenav-menu-heading">Billing</div>
                    <a class="nav-link <?php if (strpos($_SERVER['PHP_SELF'], 'home/payment.php') !== false || strpos($_SERVER['PHP_SELF'], 'home/payment_add.php') !== false || strpos($_SERVER['PHP_SELF'], 'home/payment_view.php') !== false)  { echo 'active'; } ?>" href="payment">
                        <div class="sb-nav-link-icon"><i class="fas fa-file-invoice"></i></div>
                        Payments
                    </a>
                    <a class="nav-link <?php if (strpos($_SERVER['PHP_SELF'], 'home/utility.php') !== false || strpos($_SERVER['PHP_SELF'], 'home/utility_view.php') !== false)  { echo 'active'; } ?>" href="utility">
                        <div class="sb-nav-link-icon"><i class="fas fa-receipt"></i></div>
                        My Bills
                    </a>
                </div>
            </div>
        </nav>
    </div>
    <div id="layoutSidenav_content">