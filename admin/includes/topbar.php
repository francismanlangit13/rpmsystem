<?php
    $user = $user_qry->fetch_assoc();
?>
<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark noprint">
    <!-- Navbar Brand-->
    <a class="navbar-brand ps-3" style="font-size:15px" href="../home">
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
        Rental Properties Management System
    </a>
    
    <!-- Navbar Search-->
    <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
    </form>
    <!-- Navbar-->
    <ul class="navbar-nav ms-auto">
        <!-- User Dropdown-->
        <li class="dropdown-user avatar-lg me-1 no-caret">
            <?php
                $userID = $_SESSION['auth_user'] ['user_id'];
                $query = "SELECT * FROM user where user_id = $userID";
                $query_run = mysqli_query($con, $query);
                $user = mysqli_num_rows($query_run) > 0;

                if($user){
                    while($row = mysqli_fetch_assoc($query_run)){
            ?>
            <a class="btn-icon btn-transparent-dark dropdown-toggle text-decoration-none text-white" id="navbarDropdownUserImage" href="javascript:void(0);" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <img class="img-fluid" id="profile-image1" src="<?php
                        if(!empty($row['profile'])) {
                            echo base_url . 'assets/files/user/' . $row['profile'];
                        } else { if($row['gender'] == 'Male') {echo base_url . 'assets/files/system/profile-male.png'; } else { echo base_url . 'assets/files/system/profile-female.png'; } }
                    ?>" style="height: 2.5rem; width: 2.5rem; margin-right: 1rem; border-radius: 100%;"/>
                <?=$row['fname'] .' '. $row['lname']?>
            </a>
            <div class="dropdown-menu dropdown-menu-end border-0 shadow animated--fade-in-up mr-3" aria-labelledby="navbarDropdownUserImage">
                <h6 class="dropdown-header d-flex align-items-center">
                    <img class="dropdown-user-img" id="profile-image2" src="<?php
                        if(!empty($row['profile'])) {
                            echo base_url . 'assets/files/user/' . $row['profile'];
                        } else { if($row['gender'] == 'Male') {echo base_url . 'assets/files/system/profile-male.png'; } else { echo base_url . 'assets/files/system/profile-female.png'; } }
                    ?>" style="height: 2.5rem; width: 2.5rem; margin-right: 1rem; border-radius: 100%;" />
                    <div class="dropdown-user-details">
                        <div class="dropdown-user-details-name"><?= $row['fname'] . ' ' . $row['mname'] . ' ' . $row['lname'] ?></div>
                        <div class="dropdown-user-details-email"><?= $row['email']; ?></div>
                        <div class="dropdown-user-details-phone"><?= $row['phone']; ?></div>
                    </div>
                </h6>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item <?php if (strpos($_SERVER['PHP_SELF'], 'home/myaccount.php') !== false)  { echo'active'; } ?>" href="myaccount">
                    <div class="dropdown-item-icon"><i data-feather="user"></i></div>
                    My Account
                </a>
                <button class="dropdown-item" type="button" data-bs-toggle="modal" data-bs-target="#logoutModal">
                    <div class="dropdown-item-icon"><i data-feather="log-out"></i></div>
                    Logout
                </button>
            </div>
            <?php } } ?>
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