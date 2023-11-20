<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">
                    <div class="sb-sidenav-menu-heading">Core</div>
                    <a class="nav-link" href="../home">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Dashboard
                    </a>
                    <div class="sb-sidenav-menu-heading">Accounts</div>
                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseAccounts" aria-expanded="false" aria-controls="collapseAccounts">
                        <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                        Accounts
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapseAccounts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="user">Users</a>
                            <a class="nav-link" href="renter">Renters</a>
                        </nav>
                    </div>
                    <div class="sb-sidenav-menu-heading">Properties</div>
                    <a class="nav-link" href="location">
                        <div class="sb-nav-link-icon"><i class="fas fa-map-marker-alt"></i></div>
                        Locations
                    </a>
                    <a class="nav-link" href="properties">
                        <div class="sb-nav-link-icon"><i class="fas fa-house-user"></i></div>
                        Properties
                    </a>
                </div>
            </div>
            <div class="sb-sidenav-footer">
                <div class="small">Logged in as:</div>
                <?php if($userID == 1) { echo 'Admin'; } else{ echo 'Staff'; } ?>
            </div>
        </nav>
    </div>
    <div id="layoutSidenav_content">