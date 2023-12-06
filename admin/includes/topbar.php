<?php
    $user = $user_qry->fetch_assoc();
?>
<nav class="sb-topnav navbar navbar-expand navbar-dark bg-secondary noprint">
    <!-- Navbar Brand-->
    <a class="navbar-brand ps-3" style="font-size:15px" href="index.html">
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
        Rental Properties Management System
    </a>
    
    <!-- Navbar Search-->
    <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
    </form>
    <!-- Navbar-->
    <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i> <?=$user['fname']?> <?=$user['lname']?></a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="myaccount"><i class="fas fa-user fa-fw"></i>  My Account</a></li>
                <li><hr class="dropdown-divider" /></li>
                <li><button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#logoutModal"><i class="fas fa-sign-in fa-fw"></i>  Logout</button></li>
            </ul>
        </li>
    </ul>
</nav>

<!-- Modal for Logout-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="logoutModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                Confirm to logout?
            </div>
            <div class="modal-body"> Are you sure you want to logout?</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cancel</button>
                <form action="../includes/code.php" method="POST">
                    <button type="submit" name="logout_btn" class="btn btn-danger"><div class="dropdown-item-icon"><i data-feather="log-out"></i></div> Logout</button>
                </form>
            </div>
        </div>
    </div>
</div>